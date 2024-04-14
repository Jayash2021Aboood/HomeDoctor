<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/issue.php');
  include_once('../../includes/book.php');
  include_once('../../includes/student.php');
  checkAdminSession();

  $pageTitle = lang("Edit Issue");
  //$row = new Issue(null);
   $id =  $book_id =  $student_id =  $issue_date =  $due_date =  $return_date =  $fine_per_day =  $total_fine = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getIssueById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $book_id = $row['book_id'];
        $student_id = $row['student_id'];
        $issue_date = $row['issue_date'];
        $due_date = $row['due_date'];
        $return_date = $row['return_date'];
        $fine_per_day = $row['fine_per_day'];
        $total_fine = $row['total_fine'];
      }
      else
      {
        $_SESSION["message"] = lang('There is No data for this id');
        $_SESSION["fail"] = lang('There is No data for this id');
      }

    }
    else
    {
      $_SESSION["message"] = lang('No data for display');
      $_SESSION["fail"] = lang('No data for display');
      
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateIssue']))
    {
        $id = $_POST['id'];
        $book_id = $_POST['book_id'];
        $student_id = $_POST['student_id'];
        $issue_date = $_POST['issue_date'];
        $due_date = $_POST['due_date'];
        $return_date = $_POST['return_date'];
        $fine_per_day = $_POST['fine_per_day'];
        $total_fine = $_POST['total_fine'];
      if( empty($book_id)){
        $errors[] = "<li>" . lang("Book is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Book is requierd") . "</li>";
        }
      if( empty($student_id)){
        $errors[] = "<li>" . lang("Student is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Student is requierd") . "</li>";
        }
      if( empty($issue_date)){
        $errors[] = "<li>" . lang("Issue Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Issue Date is requierd") . "</li>";
        }
      if( empty($due_date)){
        $errors[] = "<li>" . lang("Due Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Due Date is requierd") . "</li>";
        }
      if( empty($fine_per_day)){
        $errors[] = "<li>" . lang("Fine Per Day is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Fine Per Day is requierd") . "</li>";
        }
      if( empty($total_fine)){
        $errors[] = "<li>" . lang("Total Fine is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Total Fine is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getIssueById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateIssue( $id,  $book_id,  $student_id,  $issue_date,  $due_date,  $return_date,  $fine_per_day,  $total_fine, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Issue Updated successfuly!");
          $_SESSION["success"] = lang("Issue Updated successfuly!");
          header('Location:'. $PATH_ADMIN_ISSUE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Update Data");
          $_SESSION["fail"] = lang("Error when Update Data");
          $errors[] = lang("Error when Update Data");
        }
        
      }
      else
      {
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            <?php echo lang("Edit Issue"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Issues List"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Issue details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Issue Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (book_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="book_id"><?php echo lang("Book"); ?></label>
                                    <select class="form-select" name="book_id" id="book_id" required>
                                        <option disabled value=""><?php echo lang("Select a Book"); ?>:</option>
                                        <?php foreach(getAllBooks() as $Book) { ?>
                                        <option <?php if($book_id == $Book['id']) echo "selected" ?> value="<?php echo $Book['id']; ?>"> <?php echo $Book['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (student_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_id"><?php echo lang("Student"); ?></label>
                                    <select class="form-select" name="student_id" id="student_id" required>
                                        <option disabled value=""><?php echo lang("Select a Student"); ?>:</option>
                                        <?php foreach(getAllStudents() as $Student) { ?>
                                        <option <?php if($student_id == $Student['id']) echo "selected" ?> value="<?php echo $Student['id']; ?>"> <?php echo $Student['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (issue_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="issue_date"><?php echo lang("Issue Date"); ?></label>
                                    <input class="form-control" id="issue_date" name="issue_date" type="date" placeholder="<?php echo lang("Issue Date"); ?>"
                                        value="<?php echo $issue_date;?>" required />
                                </div>
                                <!-- Form Group (due_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="due_date"><?php echo lang("Due Date"); ?></label>
                                    <input class="form-control" id="due_date" name="due_date" type="date" placeholder="<?php echo lang("Due Date"); ?>"
                                        value="<?php echo $due_date;?>" required />
                                </div>
                                <!-- Form Group (return_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="return_date"><?php echo lang("Return Date"); ?></label>
                                    <input class="form-control" id="return_date" name="return_date" type="date" placeholder="<?php echo lang("Return Date"); ?>"
                                        value="<?php echo $return_date;?>"  />
                                </div>
                                <!-- Form Group (fine_per_day)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="fine_per_day"><?php echo lang("Fine Per Day"); ?></label>
                                    <input class="form-control" id="fine_per_day" name="fine_per_day" type="text" placeholder="<?php echo lang("Fine Per Day"); ?>"
                                        value="<?php echo $fine_per_day;?>" required />
                                </div>
                                <!-- Form Group (total_fine)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="total_fine"><?php echo lang("Total Fine"); ?></label>
                                    <input class="form-control" id="total_fine" name="total_fine" type="text" placeholder="<?php echo lang("Total Fine"); ?>"
                                        value="<?php echo $total_fine;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateIssue" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

