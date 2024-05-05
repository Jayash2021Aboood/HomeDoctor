<?php
  session_start();

  include('../includes/lib.php');
  include_once('../includes/doctor.php');
  checkDoctorSession();

  $pageTitle = "My Profile";
  
  $id =  $first_name =  $last_name =  $phone =  $email =  $password =  $location =  $specialty =  $date_of_graduate =  $experience_years =  $cv = $cv_old =  $state = "";
  
  include('../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    
      $_SESSION["message"] = '';
      $id = $_SESSION['userID'];
      $result = getDoctorById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $password = $row['password'];
        $location = $row['location'];
        $specialty = $row['specialty'];
        $date_of_graduate = $row['date_of_graduate'];
        $experience_years = $row['experience_years'];
        $cv = $row['cv'];
        $state = $row['state'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateDoctor']))
    {
      $id = $_POST['id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $location = $_POST['location'];
      $specialty = $_POST['specialty'];
      $date_of_graduate = $_POST['date_of_graduate'];
      $experience_years = $_POST['experience_years'];
    $cv_old = $_POST['cv_old'];
    $cv = uploadImage('cv', DIR_PHOTOES, $cv_old);
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
      $errors[] = "<li>" . lang("Experience Years is requierd") . "</li>";
      $_SESSION["fail"] .= "<li>" . lang("Experience Years is requierd") . "</li>";
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

        $result = getDoctorById($id);
        if( count( $result ) > 0)
          $row = $result[0];
          $email = $row['email'];
        
        $update = updateDoctor($id,  $first_name,  $last_name,  $phone,  $email,  $password,  $location,  $specialty,  $date_of_graduate,  $experience_years,  $cv,  $state,);
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Data Updated successfuly!";
          $_SESSION["success"] = "Data Updated successfuly!";
          header('Location:index.php');
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
        redirectToReferer();
      }
  
    }
  }
?>

<?php include('../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            My Profile
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Home
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
                <!-- Doctor details card-->
                <div class="card mb-4">
                    <div class="card-header">My Profile Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name"><?php echo lang("First Name"); ?></label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="<?php echo lang("First Name"); ?>"
                                        value="<?php echo $first_name;?>" required />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name"><?php echo lang("Last Name"); ?></label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="<?php echo lang("Last Name"); ?>"
                                        value="<?php echo $last_name;?>" required />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value="<?php echo $phone;?>" required />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="<?php echo $email;?>" required readonly/>
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo lang("Password"); ?>"
                                        value="<?php echo $password;?>" required />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="<?php echo $location;?>" required />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty"><?php echo lang("Specialty"); ?></label>
                                    <input class="form-control" id="specialty" name="specialty" type="text" placeholder="<?php echo lang("Specialty"); ?>"
                                        value="<?php echo $specialty;?>" required />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate"><?php echo lang("Date of Graduate"); ?></label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate" type="date" placeholder="<?php echo lang("Date of Graduate"); ?>"
                                        value="<?php echo $date_of_graduate;?>" required />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years"><?php echo lang("Experience Years"); ?></label>
                                    <input class="form-control" id="experience_years" name="experience_years" type="text" placeholder="<?php echo lang("Experience Years"); ?>"
                                        value="<?php echo $experience_years;?>" required />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv"><?php echo lang("CV"); ?></label>
                                    <input id="cv_old" name="cv_old" type="hidden" value="<?php echo $cv;?>" />
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="<?php echo lang("CV"); ?>"
                                        value="<?php echo $cv;?>" <?php if( !isset($cv) || empty($cv)) echo 'required';?> />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="<?php echo lang("State"); ?>"
                                        value="<?php echo $state;?>" required />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="updateDoctor" class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../template/footer.php'); ?>