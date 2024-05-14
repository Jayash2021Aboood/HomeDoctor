<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/nurse.php');

  checkAdminSession();

  $pageTitle = lang("Nurse Details");
  $row = new Nurse(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getNurseById($id);

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
    if(isset($_POST['deleteNurse']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteNurse($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Nurse Deleted successfuly!");          
          $_SESSION["success"] = lang("Nurse Deleted successfuly!");          
          header('Location:'. $PATH_ADMIN_NURSE .'index.php');
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
                            <?php echo lang("Nurse Details"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Nurses List"); ?>
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
                <!-- Nurse details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Nurse Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name"><?php echo lang("First Name"); ?></label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="<?php echo lang("First Name"); ?>"
                                        value="<?php echo $row['first_name'];?>" readonly />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name"><?php echo lang("Last Name"); ?></label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="<?php echo lang("Last Name"); ?>"
                                        value="<?php echo $row['last_name'];?>" readonly />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value="<?php echo $row['phone'];?>" readonly />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="<?php echo $row['email'];?>" readonly />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo lang("Password"); ?>"
                                        value="<?php echo $row['password'];?>" readonly />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="<?php echo $row['location'];?>" readonly />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty"><?php echo lang("Specialty"); ?></label>
                                    <input class="form-control" id="specialty" name="specialty" type="text" placeholder="<?php echo lang("Specialty"); ?>"
                                        value="<?php echo $row['specialty'];?>" readonly />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate"><?php echo lang("Date of Graduate"); ?></label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate" type="date" placeholder="<?php echo lang("Date of Graduate"); ?>"
                                        value="<?php echo $row['date_of_graduate'];?>" readonly />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years"><?php echo lang("Joined Date"); ?></label>
                                    <input class="form-control" id="experience_years" name="experience_years" type="text" placeholder="<?php echo lang("Joined Date"); ?>"
                                        value="<?php echo $row['experience_years'];?>" readonly />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv"><?php echo lang("CV"); ?></label>
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="<?php echo lang("CV"); ?>"
                                        value="<?php echo $row['cv'];?>" readonly />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="<?php echo lang("State"); ?>"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" type="button"><?php echo lang("Edit"); ?></a>
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
