<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/student.php');

  checkEmployeeSession();

  $pageTitle = lang("Delete Student");
  $row = new Student(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = lang('Are You Sure Want to Delete?');
      $id = $_GET['id'];
      $result = getStudentById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
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
    if(isset($_POST['deleteStudent']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteStudent($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Student Deleted successfuly!");          
          $_SESSION["success"] = lang("Student Deleted successfuly!");          
          header('Location:'. $PATH_EMPLOYEE_STUDENT .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Delete Data");
          $_SESSION["fail"] = lang("Error when Delete Data");

          $errors[] = lang("Error when Delete Data");
        }
      }
      else
      {
        $_SESSION["message"] = lang('No data for Delete');
        $_SESSION["fail"] = lang('No data for Delete');
      }
    }
    else
    {
      $_SESSION["message"] = lang('No data for Delete');
      $_SESSION["fail"] = lang('No data for Delete');
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
                            <?php echo lang("Delete Student"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Students List"); ?>
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
                <!-- Student details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Student Details"); ?> <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="<?php echo $row['name'];?>" readonly />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="text" placeholder="<?php echo lang("Phone"); ?>"
                                        value="<?php echo $row['phone'];?>" readonly />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="text" placeholder="<?php echo lang("Email"); ?>"
                                        value="<?php echo $row['email'];?>" readonly />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="text" placeholder="<?php echo lang("Password"); ?>"
                                        value="<?php echo $row['password'];?>" readonly />
                                </div>
                                <!-- Form Group (department_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="department_id"><?php echo lang("Department"); ?></label>
                                    <input class="form-control" id="department_id" name="department_id" type="text" placeholder="<?php echo lang("Department"); ?>"
                                        value="<?php echo $row['department_id'];?>" readonly />
                                </div>
                                <!-- Form Group (level_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="level_id"><?php echo lang("Level"); ?></label>
                                    <input class="form-control" id="level_id" name="level_id" type="text" placeholder="<?php echo lang("Level"); ?>"
                                        value="<?php echo $row['level_id'];?>" readonly />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="<?php echo lang("State"); ?>"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="active" name="active"
                                        type="checkbox" disabled
                                        <?php if($row['active'] == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="active"><?php echo lang("Active"); ?></label>
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="deleteStudent" class="btn btn-danger" type="submit"><?php echo lang("Delete"); ?></button>
                            <a href="index.php" class="btn btn-primary" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
