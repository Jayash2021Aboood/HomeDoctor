<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/nurse.php');
  checkAdminSession();


  
  $pageTitle = lang("Add Nurse");
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addNurse']))
    {


      $first_name = $_POST['first_name'];

      $last_name = $_POST['last_name'];

      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $password = $_POST['password'];

      $location = $_POST['location'];

      $specialty = $_POST['specialty'];

      $date_of_graduate = $_POST['date_of_graduate'];

      $experience_years = $_POST['experience_years'];

      $cv = uploadImage('cv',DIR_PHOTOES);

      $state = $_POST['state'];

      if( empty($first_name)){
        $errors[] = "<li>" . lang("First Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("First Name is requierd") . "</li>";
        }
      if( empty($last_name)){
        $errors[] = "<li>" . lang("Last Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Last Name is requierd") . "</li>";
        }
      if( empty($phone)){
        $errors[] = "<li>" . lang("Phone is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Phone is requierd") . "</li>";
        }
      if( empty($email)){
        $errors[] = "<li>" . lang("Email is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Email is requierd") . "</li>";
        }
      if( empty($password)){
        $errors[] = "<li>" . lang("Password is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Password is requierd") . "</li>";
        }
      if( empty($location)){
        $errors[] = "<li>" . lang("Location is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Location is requierd") . "</li>";
        }
      if( empty($specialty)){
        $errors[] = "<li>" . lang("Specialty is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Specialty is requierd") . "</li>";
        }
      if( empty($date_of_graduate)){
        $errors[] = "<li>" . lang("Date of Graduate is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Date of Graduate is requierd") . "</li>";
        }
      if( empty($experience_years)){
        $errors[] = "<li>" . lang("Joined Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Joined Date is requierd") . "</li>";
        }
      if( empty($cv)){
        $errors[] = "<li>" . lang("CV is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("CV is requierd") . "</li>";
        }
      if( empty($state)){
        $errors[] = "<li>" . lang("State is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("State is requierd") . "</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addNurse(
                                    $first_name,
                                    $last_name,
                                    $phone,
                                    $email,
                                    $password,
                                    $location,
                                    $specialty,
                                    $date_of_graduate,
                                    $experience_years,
                                    $cv,
                                    $state,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = lang("Nurse Added successfuly!");
          $_SESSION["success"] = lang("Nurse Added successfuly!");
          header('Location:'. $PATH_ADMIN_NURSE .'index.php');
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
                           <?php echo lang("Add Nurse"); ?>
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
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name"><?php echo lang("First Name"); ?></label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="<?php echo lang("First Name"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name"><?php echo lang("Last Name"); ?></label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="<?php echo lang("Last Name"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo lang("Password"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty"><?php echo lang("Specialty"); ?></label>
                                    <input class="form-control" id="specialty" name="specialty" type="text" placeholder="<?php echo lang("Specialty"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate"><?php echo lang("Date of Graduate"); ?></label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate" type="date" placeholder="<?php echo lang("Date of Graduate"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years"><?php echo lang("Joined Date"); ?></label>
                                    <input class="form-control" id="experience_years" name="experience_years" type="text" placeholder="<?php echo lang("Joined Date"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv"><?php echo lang("CV"); ?></label>
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="<?php echo lang("CV"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="<?php echo lang("State"); ?>"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addNurse" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



