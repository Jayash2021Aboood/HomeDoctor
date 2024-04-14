<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/setting.php');
  checkAdminSession();

  $pageTitle = "Edit Setting";
  //$row = new Setting(null);
   $id =  $return_days =  $fine_amount =  $student_max_issue = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getSettingById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $return_days = $row['return_days'];
        $fine_amount = $row['fine_amount'];
        $student_max_issue = $row['student_max_issue'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
      }

    }
    else
    {
      $_SESSION["message"] = 'No data for display';
      $_SESSION["fail"] = 'No data for display';
      
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateSetting']))
    {
        $id = $_POST['id'];
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

        $result = getSettingById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateSetting( $id,  $return_days,  $fine_amount,  $student_max_issue, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Setting Updated successfuly!";
          $_SESSION["success"] = "Setting Updated successfuly!";
          header('Location:'. $PATH_ADMIN_SETTING .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Update Data";
          $_SESSION["fail"] = "Error when Update Data";
          $errors[] = "Error when Update Data";
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
                            Edit Setting
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
                    <div class="card-header">Setting Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (return_days)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="return_days">Return Days</label>
                                    <input class="form-control" id="return_days" name="return_days" type="text" placeholder="Return Days"
                                        value="<?php echo $return_days;?>" required />
                                </div>
                                <!-- Form Group (fine_amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="fine_amount">Fine Amount</label>
                                    <input class="form-control" id="fine_amount" name="fine_amount" type="text" placeholder="Fine Amount"
                                        value="<?php echo $fine_amount;?>" required />
                                </div>
                                <!-- Form Group (student_max_issue)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_max_issue">Student Max Issues</label>
                                    <input class="form-control" id="student_max_issue" name="student_max_issue" type="text" placeholder="Student Max Issues"
                                        value="<?php echo $student_max_issue;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateSetting" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

