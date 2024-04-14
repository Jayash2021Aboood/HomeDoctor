<?php
  session_start();
  include('../../includes/lib.php');
  include('../../includes/book.php');
  include('../../includes/issue.php');
  include('../../includes/fine.php');
  include('../../includes/setting.php');
  include_once('../../includes/issue_manager.php');
  
  checkEmployeeSession();


  
  //$pageTitle = "Add Booking";
  //include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    


    // =======================================================================
    // =========================== Adding New Issue ==========================
    // =======================================================================
    if(isset($_POST['addIssue']))
    {

      try{

      $book_id = $_POST['book_id'];

      $student_id = $_POST['student_id'];

      if( empty($book_id)){
        $errors[] = "<li>" . lang("Book is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Book is requierd") . "</li>";
        }
      if( empty($student_id)){
        $errors[] = "<li>" . lang("Student is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Student is requierd") . "</li>";
        }
  
      if(count($errors) == 0)
      {

        $add = AddNewIssue($book_id, $student_id);
        
        if($add ==  true)
        {
          $_SESSION["message"] = lang("Issue Added successfuly!");
          $_SESSION["success"] = lang("Issue Added successfuly!");
          header('Location:'. $PATH_EMPLOYEE_ISSUE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Adding Data");
          $_SESSION["fail"] = lang("Error when Adding Data");
          $errors[] = lang("Error when Adding Data");
        }
        
      }

      }
       catch (Exception $e) {
        // Handle error
        redirectToReferer($e->getMessage());
      }


    }


    // =======================================================================
    // =========================== Return Issue ==========================
    // =======================================================================
    if(isset($_POST['returnIssue']))
    {

      try{

        // var_dump($_POST);
        // exit();
        $id = $_POST['id'];
        
        // $book_id = $_POST['book_id'];
        // $student_id = $_POST['student_id'];

        // if( empty($id)){
        //   $errors[] = "<li>" . lang("Book is requierd") . "</li>";
        //   $_SESSION["fail"] .= "<li>" . lang("Book is requierd") . "</li>";
        //   }

        // if( empty($book_id)){
        //   $errors[] = "<li>" . lang("Book is requierd") . "</li>";
        //   $_SESSION["fail"] .= "<li>" . lang("Book is requierd") . "</li>";
        //   }
        // if( empty($student_id)){
        //   $errors[] = "<li>" . lang("Student is requierd") . "</li>";
        //   $_SESSION["fail"] .= "<li>" . lang("Student is requierd") . "</li>";
        //   }
    
        if(count($errors) == 0)
        {

          $returned = ReturnIssue($id);
          
          if($returned ==  true)
          {
            $_SESSION["message"] = lang("Issue Returned successfuly!");
            $_SESSION["success"] = lang("Issue Returned successfuly!");
            header('Location:'. $PATH_EMPLOYEE_ISSUE .'index.php');
            exit();
          }
          else
          {
            $_SESSION["message"] = lang("Error when Returned Issue");
            $_SESSION["fail"] = lang("Error when Returned Issue");
            $errors[] = lang("Error when Returned Issue");
          }
          
        }

      }
       catch (Exception $e) {
        // Handle error
        redirectToReferer($e->getMessage());
      }
    }

    // =======================================================================
    // =========================== Change Fine To Deported ===================
    // =======================================================================
    if(isset($_POST['deportFine']))
    {

      try{

        $id = $_POST['id'];
        
        if( empty($id)){
          $errors[] = "<li>" . lang("Fine is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Fine is requierd") . "</li>";
          }

        if(count($errors) == 0)
        {

          $deported = ChangeFineToDeported($id);
          
          if($deported ==  true)
          {
            $_SESSION["message"] = lang("Fine Deported successfuly!");
            $_SESSION["success"] = lang("Fine Deported successfuly!");
            header('Location:'. $PATH_EMPLOYEE_FINE .'index.php');
            exit();
          }
          else
          {
            $_SESSION["message"] = lang("Error when Deported Fine");
            $_SESSION["fail"] = lang("Error when Deported Fine");
            $errors[] = lang("Error when Deported Fine");
          }
          
        }

      }
       catch (Exception $e) {
        // Handle error
        redirectToReferer($e->getMessage());
      }
    }

    // =======================================================================
    // =========================== Change Fine To Canceled ===================
    // =======================================================================
    if(isset($_POST['cancelFine']))
    {

      try{

        $id = $_POST['id'];
        
        if( empty($id)){
          $errors[] = "<li>" . lang("Fine is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Fine is requierd") . "</li>";
          }

        if(count($errors) == 0)
        {

          $canceled = ChangeFineToCanceled($id);
          
          if($canceled ==  true)
          {
            $_SESSION["message"] = lang("Fine Canceled successfuly!");
            $_SESSION["success"] = lang("Fine Canceled successfuly!");
            header('Location:'. $PATH_EMPLOYEE_FINE .'index.php');
            exit();
          }
          else
          {
            $_SESSION["message"] = lang("Error when Canceled Fine");
            $_SESSION["fail"] = lang("Error when Canceled Fine");
            $errors[] = lang("Error when Canceled Fine");
          }
          
        }

      }
       catch (Exception $e) {
        // Handle error
        redirectToReferer($e->getMessage());
      }
    }


    redirectToReferer();
  }
  redirectToReferer();
?>