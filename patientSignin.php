<?php
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $pageTitle = "Signin as Patient";
  include('includes/lib.php');
  include('includes/webuser.php');
  include('includes/patient.php');
   
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['createAccount']))
    {

      $first_name = $_POST['first_name'];

      $last_name = $_POST['last_name'];

      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $password = $_POST['password'];

      $confirm_password = $_POST['confirm_password'];

      $location = $_POST['location'];

      $date_of_birth = $_POST['date_of_birth'];

      $height = $_POST['height'];

      $weight = $_POST['weight'];

      $has_chronic_disease = ( isset( $_POST['has_chronic_disease']))? 1:0;

      $what_are_diseases = $_POST['what_are_diseases'];

      $has_allergic_to_anything = ( isset( $_POST['has_allergic_to_anything']))? 1:0;

      $what_are_things = $_POST['what_are_things'];

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
          $errors[] = "<li>Email is requierd.</li>";
          $_SESSION["fail"] .= "<li>Email is requierd.</li>";
          }
          else
          {
              if(isUserExist($email))
              {
                  $errors[] = "<li>try again with another email.</li>";
                  $_SESSION["fail"] .= "<li>try again with another email.</li>";
              }
          }
      if( empty($password)){
        $errors[] = "<li>" . lang("Password is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Password is requierd") . "</li>";
        }
        if( empty($location)){
          $errors[] = "<li>" . lang("Location is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Location is requierd") . "</li>";
          }
        if( empty($date_of_birth)){
          $errors[] = "<li>" . lang("Date of Birth is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Date of Birth is requierd") . "</li>";
          }
        if( empty($height)){
          $errors[] = "<li>" . lang("Height is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Height is requierd") . "</li>";
          }
        if( empty($weight)){
          $errors[] = "<li>" . lang("Weight is requierd") . "</li>";
          $_SESSION["fail"] .= "<li>" . lang("Weight is requierd") . "</li>";
          }
    
        // ============================  Custom Validation
        
        if( empty($confirm_password)){
          $errors[] = "<li>confirm_password is requierd.</li>";
          $_SESSION["fail"] .= "<li>confirm_password is requierd.</li>";
          }
  
        if( $password != $confirm_password ){
          $errors[] = "<li>passwords must be matched </li>";
          $_SESSION["fail"] .= "<li>passwords must be matched </li>";
          }


      if(count($errors) == 0)
      {
        
        $webUser = addWebUser($email,'p');
        if($webUser == true)
        {
            $add = addPatient(    $first_name,
                                  $last_name,
                                  $phone,
                                  $email,
                                  $password,
                                  $location,
                                  $date_of_birth,
                                  $height,
                                  $weight,
                                  $has_chronic_disease,
                                  $what_are_diseases,
                                  $has_allergic_to_anything,
                                  $what_are_things,
                                    'request');
            if($add ==  true)
            {
                $patients = select("select * from patient where email like '$email' and password like '$password';");
                if(count($patients) > 0)
                {

                    if($patients[0]['state'] != 'accept'){
                        $_SESSION["message"] = "create account successfuly your account will accept in next 24 hours";
                        $_SESSION["success"] = "create account successfuly your account will accept in next 24 hours";
                        header('Location: index.php');
                        exit();
                    }

                    $_SESSION["userID"] = $patients[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'e';
                    $_SESSION['success'] = "Welcome ".$patients[0]['first_name'] ." ". $patients[0]['last_name'] ;
                    
                    header('Location: patient/index.php');
                    exit();
                }
            }
            else
            {
                $_SESSION["message"] = "Error when Adding Data";
                $_SESSION["fail"] = "Error when Adding Data";
                $errors[] = "Error when Adding Data";
            }
        }
        else
        {
            redirectToReferer("error When Create New Users ... contact administrator");
        }
        
      }
      else
      {
        redirectToReferer($errors);
      }
  
    }
  }
  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <!-- Basic registration form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4">Create Patient Account</h3>
                    </div>
                    <div class="card-body">
                        <!-- Registration form-->
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

                                <!-- Form Group (confirm_password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="confirm_password">Confirm Password</label>
                                    <input class="form-control" id="confirm_password" name="confirm_password"
                                        type="password" placeholder="Confirm Password" value="" required />
                                </div>

                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (date_of_birth)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_birth"><?php echo lang("Date of Birth"); ?></label>
                                    <input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="<?php echo lang("Date of Birth"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (height)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="height"><?php echo lang("Height"); ?></label>
                                    <input class="form-control" id="height" name="height" type="text" placeholder="<?php echo lang("Height"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (weight)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="weight"><?php echo lang("Weight"); ?></label>
                                    <input class="form-control" id="weight" name="weight" type="text" placeholder="<?php echo lang("Weight"); ?>"
                                        value="" required  />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="has_chronic_disease" name="has_chronic_disease"
                                        type="checkbox" />
                                    <label class="form-check-label" for="has_chronic_disease"><?php echo lang("Has Chronic Disease"); ?></label>
                                </div>
                                <!-- Form Group (what_are_diseases)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="what_are_diseases"><?php echo lang("What Are Diseases"); ?></label>
                                    <input class="form-control" id="what_are_diseases" name="what_are_diseases" type="text" placeholder="<?php echo lang("What Are Diseases"); ?>"
                                        value=""   />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="has_allergic_to_anything" name="has_allergic_to_anything"
                                        type="checkbox" />
                                    <label class="form-check-label" for="has_allergic_to_anything"><?php echo lang("Has Allergic To Anything"); ?></label>
                                </div>
                                <!-- Form Group (what_are_things)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="what_are_things"><?php echo lang("What Are Things"); ?></label>
                                    <input class="form-control" id="what_are_things" name="what_are_things" type="text" placeholder="<?php echo lang("What Are Things"); ?>"
                                        value=""   />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="createAccount" class="btn btn-success" type="submit">Create Account</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>