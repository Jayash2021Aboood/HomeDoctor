<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/setting.php');

  checkAdminSession();

  $pageTitle = "Delete Setting";
  $row = new Setting(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = ' Are You Sure Want to Delete? ';
      $id = $_GET['id'];
      $result = getSettingById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = 'There is No data for this id';
          $_SESSION["fail"] = 'There is No data for this id';
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
    if(isset($_POST['deleteSetting']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteSetting($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Setting Deleted successfuly!";          
          $_SESSION["success"] = "Setting Deleted successfuly!";          
          header('Location:'. $PATH_ADMIN_SETTING .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Delete Data";
          $_SESSION["fail"] = "Error when Delete Data";

          $errors[] = "Error when Delete Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Delete';
        $_SESSION["fail"] = 'No data for Delete';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Delete';
      $_SESSION["fail"] = 'No data for Delete';
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
                            Delete Setting
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
                    <div class="card-header">Setting Details <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (return_days)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="return_days">Return Days</label>
                                    <input class="form-control" id="return_days" name="return_days" type="text" placeholder="Return Days"
                                        value="<?php echo $row['return_days'];?>" readonly />
                                </div>
                                <!-- Form Group (fine_amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="fine_amount">Fine Amount</label>
                                    <input class="form-control" id="fine_amount" name="fine_amount" type="text" placeholder="Fine Amount"
                                        value="<?php echo $row['fine_amount'];?>" readonly />
                                </div>
                                <!-- Form Group (student_max_issue)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_max_issue">Student Max Issues</label>
                                    <input class="form-control" id="student_max_issue" name="student_max_issue" type="text" placeholder="Student Max Issues"
                                        value="<?php echo $row['student_max_issue'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="deleteSetting" class="btn btn-danger" type="submit">Delete</button>
                            <a href="index.php" class="btn btn-primary" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
