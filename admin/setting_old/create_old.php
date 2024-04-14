<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/setting.php');
  checkAdminSession();


  
  $pageTitle = "Add Setting";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addSetting']))
    {

      // Not Allow To Adding Two Rows Setting and Setting Table 
      $exsitRowInTable = select("select count(id) as result from setting;")[0]['result'];
      if($exsitRowInTable > 0){
        redirectToReferer(lang("not allowed to add setting many Times"));
      }
      
      $return_days = $_POST['return_days'];

      $fine_amount = $_POST['fine_amount'];

      $student_max_issue = $_POST['student_max_issue'];

      if( empty($return_days)){
        $errors[] = "<li>Return Days is requierd.</li>";
        $_SESSION["fail"] .= "<li>Return Days is requierd.</li>";
        }
      if( empty($fine_amount)){
        $errors[] = "<li>Fine Amount is requierd.</li>";
        $_SESSION["fail"] .= "<li>Fine Amount is requierd.</li>";
        }
      if( empty($student_max_issue)){
        $errors[] = "<li>Student Max Issues is requierd.</li>";
        $_SESSION["fail"] .= "<li>Student Max Issues is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addSetting(
                                    $return_days,
                                    $fine_amount,
                                    $student_max_issue,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Setting Added successfuly!";
          $_SESSION["success"] = "Setting Added successfuly!";
          header('Location:'. $PATH_ADMIN_SETTING .'index.php');
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
                            Add Setting
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Settings List
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
                <!-- Setting details card-->
                <div class="card mb-4">
                    <div class="card-header">Setting Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (return_days)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="return_days">Return Days</label>
                                    <input class="form-control" id="return_days" name="return_days" type="text"
                                        placeholder="Return Days" value="" required />
                                </div>
                                <!-- Form Group (fine_amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="fine_amount">Fine Amount</label>
                                    <input class="form-control" id="fine_amount" name="fine_amount" type="text"
                                        placeholder="Fine Amount" value="" required />
                                </div>
                                <!-- Form Group (student_max_issue)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_max_issue">Student Max Issues</label>
                                    <input class="form-control" id="student_max_issue" name="student_max_issue"
                                        type="text" placeholder="Student Max Issues" value="" required />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addSetting" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>