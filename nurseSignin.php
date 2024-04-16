<?php
  session_start();
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  $pageTitle = "Signin as Nurse";
  include('includes/lib.php');
  include('includes/webuser.php');
  include('includes/nurse.php');
   
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

      $specialty = $_POST['specialty'];

      $date_of_graduate = $_POST['date_of_graduate'];

      $experience_years = $_POST['experience_years'];

      $cv = uploadImage('cv',DIR_PHOTOES);

      if( empty($first_name)){
        $errors[] = "<li>First Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>First Name is requierd.</li>";
        }
      if( empty($last_name)){
        $errors[] = "<li>Last Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Last Name is requierd.</li>";
        }
      if( empty($phone)){
        $errors[] = "<li>Phone is requierd.</li>";
        $_SESSION["fail"] .= "<li>Phone is requierd.</li>";
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
        $errors[] = "<li>Password is requierd.</li>";
        $_SESSION["fail"] .= "<li>Password is requierd.</li>";
        }
      if( empty($specialty)){
        $errors[] = "<li>Specialty is requierd.</li>";
        $_SESSION["fail"] .= "<li>Specialty is requierd.</li>";
        }
      if( empty($date_of_graduate)){
        $errors[] = "<li>Date of Graduate is requierd.</li>";
        $_SESSION["fail"] .= "<li>Date of Graduate is requierd.</li>";
        }
      if( empty($experience_years)){
        $errors[] = "<li>Experience Years is requierd.</li>";
        $_SESSION["fail"] .= "<li>Experience Years is requierd.</li>";
        }
      if( empty($cv)){
        $errors[] = "<li>CV is requierd.</li>";
        $_SESSION["fail"] .= "<li>CV is requierd.</li>";
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
        
        $webUser = addWebUser($email,'n');
        if($webUser == true)
        {
            $add = addNurse(     $first_name,
                                    $last_name,
                                    $phone,
                                    $email,
                                    $password,
                                    $location,
                                    $specialty,
                                    $date_of_graduate,
                                    $experience_years,
                                    $cv,
                                    'request');
            if($add ==  true)
            {
                $nurses = select("select * from nurse where email like '$email' and password like '$password';");
                if(count($nurses) > 0)
                {

                    if($nurses[0]['state'] != 'accept'){
                        $_SESSION["message"] = "create account successfuly your account will accept in next 24 hours";
                        $_SESSION["success"] = "create account successfuly your account will accept in next 24 hours";
                        header('Location: index.php');
                        exit();
                    }

                    $_SESSION["userID"] = $nurses[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'e';
                    $_SESSION['success'] = "Welcome ".$nurses[0]['first_name'] ." ". $nurses[0]['last_name'] ;
                    
                    header('Location: nurse/index.php');
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
                        <h3 class="fw-light my-4">Create Nurse Account</h3>
                    </div>
                    <div class="card-body">
                        <!-- Registration form-->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text"
                                        placeholder="First Name" value="" required />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text"
                                        placeholder="Last Name" value="" required />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="" required />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="" required />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Password" value="" required />
                                </div>
                                <!-- Form Group (confirm_password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="confirm_password">Confirm Password</label>
                                    <input class="form-control" id="confirm_password" name="confirm_password"
                                        type="password" placeholder="Confirm Password" value="" required />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location">Location</label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="Location"
                                        value="" />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty">Specialty</label>
                                    <input class="form-control" id="specialty" name="specialty" type="text"
                                        placeholder="Specialty" value="" required />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate">Date of Graduate</label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate"
                                        type="date" placeholder="Date of Graduate" value="" required />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years">Experience Years</label>
                                    <input class="form-control" id="experience_years" name="experience_years"
                                        type="text" placeholder="Experience Years" value="" required />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv">CV</label>
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="CV" value=""
                                        required />
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