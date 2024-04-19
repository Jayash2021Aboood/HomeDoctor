<?php
  session_start();
  $pageTitle = "Signin as Receiver";

  include('includes/lib.php');
  include('includes/webuser.php');
  include('includes/receiver.php');
   
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['createAccount']))
    {

      $name = $_POST['name'];

      $location = $_POST['location'];

      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $password = $_POST['password'];

      $active = ( isset( $_POST['active']))? 1:0;

      $confirm_password = $_POST['confirm_password'];



      if( empty($name)){
        $errors[] = "<li>" . lang("Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
        }
      if( empty($location)){
        $errors[] = "<li>" . lang("Location is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Location is requierd") . "</li>";
        }
      if( empty($phone)){
        $errors[] = "<li>" . lang("Phone is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Phone is requierd") . "</li>";
        }
      if( empty($email)){
        $errors[] = "<li>" . lang("Email is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Email is requierd") . "</li>";
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
        
        $webUser = addWebUser($email,'r');
        if($webUser == true)
        {
            $add = addReceiver( $name, $location, $phone, $email, $password, 0);
            if($add ==  true)
            {
                $receivers = select("select * from receiver where email like '$email' and password like '$password';");
                if(count($receivers) > 0)
                {

                    if($receivers[0]['active'] != true){
                        $_SESSION["message"] = "create account successfuly your account will accept in next 24 hours";
                        $_SESSION["success"] = "create account successfuly your account will accept in next 24 hours";
                        header('Location: index.php');
                        exit();
                    }


                    $_SESSION["userID"] = $receivers[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'r';
                    $_SESSION['success'] = "Welcome ".$receivers[0]['first_name'] ." ". $receivers[0]['last_name'] ;
                    header('Location: receiver/index.php');
                    exit();                    
                }
                else
                {
                    redirectToReferer("we can't find receiver with this data .!!");
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
            <div class="col-lg-7">
                <!-- Basic registration form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4">Create Account</h3>
                    </div>
                    <div class="card-body">
                        <!-- Registration form-->
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (name)-->
                                <div class="col-6 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-6 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-6 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo lang("Password"); ?>"
                                        value="" required  />
                                </div>
                                <div class="col-md-6">
                                    <!-- Form Group (confirm password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="inputConfirmPassword">Confirm
                                            Password</label>
                                        <input class="form-control" id="inputConfirmPassword" type="password"
                                            placeholder="Confirm password" name="confirm_password" required />
                                    </div>
                                </div>

                            </div>
                            <!-- Form Group (create account submit)-->
                            <button name="createAccount" class="btn btn-success" type="submit"><?php echo lang("Create Account"); ?>
                                </button>
                            <!-- Submit button-->
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