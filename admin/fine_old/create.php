<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/fine.php');
  include_once('../../includes/issue.php');
  include_once('../../includes/student.php');
  checkAdminSession();


  
  $pageTitle = "Add Fine";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addFine']))
    {


      $issue_id = $_POST['issue_id'];

      $student_id = $_POST['student_id'];

      $amount = $_POST['amount'];

      $state = $_POST['state'];

      if( empty($issue_id)){
        $errors[] = "<li>Issue is requierd.</li>";
        $_SESSION["fail"] .= "<li>Issue is requierd.</li>";
        }
      if( empty($student_id)){
        $errors[] = "<li>Student is requierd.</li>";
        $_SESSION["fail"] .= "<li>Student is requierd.</li>";
        }
      if( empty($amount)){
        $errors[] = "<li>TotalAmount is requierd.</li>";
        $_SESSION["fail"] .= "<li>TotalAmount is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addFine(
                                    $issue_id,
                                    $student_id,
                                    $amount,
                                    $state,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Fine Added successfuly!";
          $_SESSION["success"] = "Fine Added successfuly!";
          header('Location:'. $PATH_ADMIN_FINE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Adding Data";
          $_SESSION["fail"] = "Error when Adding Data";
          $errors[] = "Error when Adding Data";
        }
        
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>



<!-- Content -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            Add Fine
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Fines List
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
                <!-- Fine details card-->
                <div class="card mb-4">
                    <div class="card-header">Fine Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (issue_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="issue_id">Issue</label>
                                    <select class="form-select" name="issue_id" id="issue_id" required>
                                        <option selected disabled value="">Select a Issue:</option>
                                        <?php foreach(getAllIssues() as $Issue) { ?>
                                        <option value="<?php echo $Issue['id']; ?>"> <?php echo $Issue['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (student_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_id">Student</label>
                                    <select class="form-select" name="student_id" id="student_id" required>
                                        <option selected disabled value="">Select a Student:</option>
                                        <?php foreach(getAllStudents() as $Student) { ?>
                                        <option value="<?php echo $Student['id']; ?>"> <?php echo $Student['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="amount">TotalAmount</label>
                                    <input class="form-control" id="amount" name="amount" type="text" placeholder="TotalAmount"
                                        value="" required  />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addFine" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



