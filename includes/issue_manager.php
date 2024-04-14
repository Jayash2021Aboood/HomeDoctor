<?php

//include('lib.php');

function AddNewIssue($book_id, $student_id) {
        // Check if setting is found
        $setting = GetSetting();
        if(is_null($setting) || count($setting) == 0){
            throw new Exception(lang("You shloud to do setting for library fisrt"));
        }
        $setting = $setting[0];

        // Check if book is available for issue
        if( CheckIfBookIsAvailableForIssue($book_id) == false){
            throw new Exception(lang("you can not issue this book its not available"));
        }

        // Check if student can issue
        if(CheckIfStudentCanIssue($student_id, $setting) == false ){
            throw new Exception(lang("this student can not make issue he should return previous books"));
        }

        // Assign issue date, return date, and fine amount per day from setting
        $issue_date = date('Y-m-d');
        $due_date = date('Y-m-d', strtotime($issue_date. $setting['return_days']. ' days'));
        $return_date = "NULL" ;
        $fine_per_day = $setting['fine_amount'];

        // Insert issue into database
        return addIssue($book_id, $student_id, $issue_date, $due_date, $return_date, $fine_per_day, 0);
        
}


function ReturnIssue($issue_id, $return_date = null) {

    $result = getIssueById($issue_id);
    if(count($result) == 0){
        throw new Exception(lang("no issue found Please choose issue first"));
    }


    $issue = $result[0];
    // Check if issue is closed
    if (CheckIfIssueIsReturned($issue)) 
    {
        throw new Exception(lang("this issue already returned"));
    }

    if(is_null($return_date)){
        $return_date = date("Y-m-d");
    }
    // Calculate fine days
    $fine_days = CalculateFineDays($issue, $return_date);


    /**
     * Start Transaction
     **/

    // Connect to the database

	global $localhost;
	global $DBusername;
	global $dbname ;
	global $pwd;

    $servername = $localhost;
    $username = $DBusername;
    $password = $pwd;
    $dbname = $dbname;

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
    }

    // Start the transaction
    $conn->begin_transaction();

    try {

     $fine_amount = 0;
    // Add fine to database
    if ($fine_days > 0) {
        // AddNewFine($issue_id, $fine_days);
        $student_id = $issue['student_id'];
        $fine_amount = $fine_days * $issue['fine_per_day'];
        // Insert data into the fine table
        $sql = "INSERT INTO fine (issue_id, student_id, amount) 
                VALUES ($issue_id, $student_id, $fine_amount)";
        if ($conn->query($sql)!== TRUE) {
            throw new Exception("Error inserting data into fine table: ". $conn->error);
        }
    }

    
    // Update issue in database
    $sql = "UPDATE issue SET return_date = '$return_date', total_fine = $fine_amount
            WHERE id = '$issue_id'";
    if ($conn->query($sql)!== TRUE) {
        throw new Exception("Error inserting data into issue table: ". $conn->error);
    }



    // Commit the transaction
    return $conn->commit();

    } catch (Exception $e) {
    // Rollback the transaction if an error occurs
    $conn->rollback();

    die($e->getMessage());
    }

    // Close the connection
    $conn->close();
    

    /**
     * End Transaction
     **/
    
}

function CheckIfIssueIsReturned($issue) {

    if ($issue['return_date'] == null || $issue['return_date'] == '0000-00-00') {
        return false;
    } else {
        return true;
    }
}

// function CheckIfAllowUpdateClosedIssue($issue_id) {
//     if (CheckIfIssueIsReturned($issue_id)) {
//         return false;
//     } else {
//         return true;
//     }
// }

// function CheckIfIssueHasNotPaidFine($issue_id) {
//     $sql = "SELECT total_fine FROM issue WHERE id = '$issue_id'";
//     $result = mysqli_query($conn, $sql);
//     $row = mysqli_fetch_assoc($result);
//     if ($row['total_fine'] == 0) {
//         return true;
//     } else {
//         return false;
//     }
// }


function CheckIfBookIsAvailableForIssue($book_id) {
    // Code to check if book is available for issue
    try{
        return getAvailableBooksToIssue($book_id) > 0;
    } catch (Exception $e) {
    // Handle error
        echo "Error: ". $e->getMessage();
    }
}

function CheckIfStudentCanIssue($student_id, $setting) {
    // Code to check if student can issue
    try{
        return !(getStudentIssuesTimes($student_id) >= $setting['student_max_issue']);

    } catch (Exception $e) {
    // Handle error
        echo "Error: ". $e->getMessage();
    }
}

function CalculateFineDays($issue, $return_date = null) {
    // Code to calculate fine days
    if(is_null($return_date)){
        $return_date = date("Y-m-d");
    }


    // Convert the dates to timestamps
    $timestamp1 = strtotime($issue['due_date']);
    $timestamp2 = strtotime($return_date);

    // Compare the timestamps
    if ($timestamp1 > $timestamp2) {
        return 0;
    } 
    else{
        
        $date1 = new DateTime($issue['due_date']);
        $date2 = new DateTime($return_date);
        
        $diff = $date2->diff($date1);
        return $diff->format('%a'); // Output: 9
    }
}

function ChangeFineToDeported($fine_id){
    $fine = getFineById($fine_id);
    if(count($fine) == 0)
    {
        throw new Exception(lang("no data found for this id"));
    }

    $fine = $fine[0];

    if($fine == 'deported'){
        throw new Exception(lang("this fine already paid"));
    }

    if($fine == 'canceled'){
        throw new Exception(lang("you cannot pay canceled fine"));
    }
    
    return query("UPDATE fine SET state = 'deported' WHERE id = $fine_id;");
}

function ChangeFineToCanceled($fine_id){
    $fine = getFineById($fine_id);
    if(count($fine) == 0)
    {
        throw new Exception(lang("no data found for this id"));
    }

    if($fine == 'deported'){
        throw new Exception(lang("you cannot pay deported fine"));
    }

    if($fine == 'canceled'){
        throw new Exception(lang("this fine already canceled"));
    }

    $fine = $fine[0];
    
    return query("UPDATE fine SET state = 'canceled' WHERE id = $fine_id;");
}


?>