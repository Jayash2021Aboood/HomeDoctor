<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/fine.php');
  include_once('../../includes/issue.php');
  include_once('../../includes/student.php');

  checkAdminSession();

  $pageTitle = "Detail Fine";
  $row = new Fine(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getFineById($id);

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
    if(isset($_POST['deleteFine']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteFine($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Fine Detaild successfuly!";          
          $_SESSION["success"] = "Fine Detaild successfuly!";          
          header('Location:'. $PATH_ADMIN_FINE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Detail Data";
          $_SESSION["fail"] = "Error when Detail Data";

          $errors[] = "Error when Detail Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Detail';
        $_SESSION["fail"] = 'No data for Detail';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Detail';
      $_SESSION["fail"] = 'No data for Detail';
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
                            Detail Fine
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
                    <div class="card-header">Fine Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (issue_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="issue_id">Issue</label>
                                    <select disabled class="form-select" name="issue_id" id="issue_id" required>
                                        <option disabled value="">Select a Issue:</option>
                                        <?php foreach(getAllIssues() as $Issue) { ?>
                                        <option <?php if($row['issue_id'] == $Issue['id']) echo "selected" ?> value="<?php echo $Issue['id']; ?>"> <?php echo $Issue['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (student_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_id">Student</label>
                                    <select disabled class="form-select" name="student_id" id="student_id" required>
                                        <option disabled value="">Select a Student:</option>
                                        <?php foreach(getAllStudents() as $Student) { ?>
                                        <option <?php if($row['student_id'] == $Student['id']) echo "selected" ?> value="<?php echo $Student['id']; ?>"> <?php echo $Student['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="amount">TotalAmount</label>
                                    <input class="form-control" id="amount" name="amount" type="text" placeholder="TotalAmount"
                                        value="<?php echo $row['amount'];?>" readonly />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" type="button">Edit</a>
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
