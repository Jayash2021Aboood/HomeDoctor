<?php
  session_start();
  include('includes/lib.php');
  $pageTitle =  lang("Login");

if (isset($_SESSION['user'])) 
  {
    if(isset($_SESSION['userType']))
    {
        if($_SESSION['userType'] == 'a')
        {
            header('Location: admin/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'p')
        {
            header('Location: patient/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'd')
        {
            header('Location: doctor/index.php');
            exit();
        }
        else if($_SESSION['userType'] == 'n')
        {
            header('Location: nurse/index.php');
            exit();
        }
    }
    header('Location: index.php');
    exit();
  }
  
  $errors = array();

  $email = "";
  $password = "";
  if(isset($_POST['login']))
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if( !(isset($_POST['email']) && !empty($_POST['email']) )){
        $errors[] = lang("Email is requierd");
        //$_SESSION["fail"] = "Email is requierd.";
    }

    if( !(isset($_POST['password']) && !empty($_POST['password']) )){
        $errors[] = lang("Passowrd is requierd");
        //$_SESSION["fail"] = "Passowrd is requierd.";
    }
    
    if(count($errors) == 0)
    {
      //$logins = loginAdmin($username, $password);
      $logins = select("select * from webuser where email like '$email';");
      if(count($logins) > 0)
      {
        $userType = $logins[0]['usertype'];
        if($userType == 'a')
        {
            $admins = select("select * from admin where email like '$email' and password like '$password';");
            if(count($admins) > 0)
            {
                $_SESSION["userID"] = $admins[0]['id'];
                $_SESSION["user"] = $email;
                $_SESSION["userType"] = 'a';
                $_SESSION['success'] = "Welcome ".$admins[0]['email'];
                header('Location: admin/index.php');
                exit();
            }
            else
            {
                $_SESSION["message"] = lang("No Admin found with this data");
                $_SESSION["fail"] = lang("No Admin found with this data");
                $errors[] = lang("No Admin found with this data");
            }
        }
        else if($userType == 'p')
        {
            $patients = select("select * from patient where email like '$email' and password like '$password';");
            if(count($patients) > 0)
            {
                    $_SESSION["userID"] = $patients[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'p';
                    $_SESSION['success'] = "Welcome ".$patients[0]['first_name'] ." ". $patients[0]['last_name'] ;
                    header('Location: patient/index.php');
                    exit();
            }
            else
            {
                $_SESSION["message"] = lang("No Patient found with this data");
                $_SESSION["fail"] = lang("No Patient found with this data");
                $errors[] = lang("No Patient found with this data");
            }
        }
        else if($userType == 'd')
        {
            $doctors = select("select * from doctor where email like '$email' and password like '$password';");
            if(count($doctors) > 0)
            {

                    if($doctors[0]['state'] == 'reject'){
                        $_SESSION["message"] = "your account has been rejected ... contact to adminstrator";
                        $_SESSION["fail"] = "your account has been rejected ... contact to adminstrator";
                        header('Location: login.php');
                        exit();
                    }
                    else if($doctors[0]['state'] == 'request'){
                        $_SESSION["message"] = "your account not accepted Yet ... contact to adminstrator";
                        $_SESSION["fail"] = "your account not accepted Yet ... contact to adminstrator";
                        header('Location: login.php');
                        exit();
                    }
                    else if($doctors[0]['state'] == 'accept')
                    {
                        $_SESSION["userID"] = $doctors[0]['id'];
                        $_SESSION["user"] = $email;
                        $_SESSION["userType"] = 'd';
                        $_SESSION['success'] = "Welcome ".$doctors[0]['first_name'] ." ". $doctors[0]['last_name'] ;
                        header('Location: doctor/index.php');
                        exit();
                    }
                    else
                    {
                        $_SESSION["message"] = "UnKnow doctor state ... contact admininstrator";
                        $_SESSION["fail"] = "UnKnow doctor state ... contact admininstrator";
                        $errors[] = "UnKnow doctor state ... contact admininstrator";
                    }

                    // $_SESSION["userID"] = $doctors[0]['id'];
                    // $_SESSION["user"] = $email;
                    // $_SESSION["userType"] = 'd';
                    // $_SESSION['success'] = lang("Welcome ") . $doctors[0]['name'] ;
                    // header('Location: doctor/index.php');
                    // exit();
            }
            else
            {
                $_SESSION["message"] = lang("No Doctor found with this data");
                $_SESSION["fail"] = lang("No Doctor found with this data");
                $errors[] = lang("No Doctor found with this data");
            }
        }
        else if($userType == 'n')
        {
            $nurses = select("select * from nurse where email like '$email' and password like '$password';");
            if(count($nurses) > 0)
            {

                if($nurses[0]['state'] == 'reject'){
                    $_SESSION["message"] = "your account has been rejected ... contact to adminstrator";
                    $_SESSION["fail"] = "your account has been rejected ... contact to adminstrator";
                    header('Location: login.php');
                    exit();
                }
                else if($nurses[0]['state'] == 'request'){
                    $_SESSION["message"] = "your account not accepted Yet ... contact to adminstrator";
                    $_SESSION["fail"] = "your account not accepted Yet ... contact to adminstrator";
                    header('Location: login.php');
                    exit();
                }
                else if($nurses[0]['state'] == 'accept')
                {
                    $_SESSION["userID"] = $nurses[0]['id'];
                    $_SESSION["user"] = $email;
                    $_SESSION["userType"] = 'n';
                    $_SESSION['success'] = "Welcome ".$nurses[0]['first_name'] ." ". $nurses[0]['last_name'] ;
                    header('Location: nurse/index.php');
                    exit();
                }
                else
                {
                    $_SESSION["message"] = "UnKnow nurse state ... contact admininstrator";
                    $_SESSION["fail"] = "UnKnow nurse state ... contact admininstrator";
                    $errors[] = "UnKnow nurse state ... contact admininstrator";
                }

                    // $_SESSION["userID"] = $nurses[0]['id'];
                    // $_SESSION["user"] = $email;
                    // $_SESSION["userType"] = 'n';
                    // $_SESSION['success'] = lang("Welcome ") . $nurses[0]['name'] ;
                    // header('Location: nurse/index.php');
                    // exit();
            }
            else
            {
                $_SESSION["message"] = lang("No Nurse found with this data");
                $_SESSION["fail"] = lang("No Nurse found with this data");
                $errors[] = lang("No Nurse found with this data");
            }
        }

        else
        {
            $_SESSION["message"] = lang("UnKnow user state ... contact admininstrator");
            $_SESSION["fail"] = lang("UnKnow user state ... contact admininstrator");
            $errors[] = lang("UnKnow user state ... contact admininstrator");
        }
      }
      else
      {
        $_SESSION["message"] = lang("Email or password not correct!");
        $_SESSION["fail"] = lang("Email or password not correct!");
        $errors[] = lang("Email or password not correct!");
      }
      
    }
    else
    {
        foreach($errors as $error)
        {
            if( !(isset($_SESSION["fail"]) && !empty($_SESSION["fail"]) ))
            {
                $_SESSION["fail"] = $error;
            }
            else
            {
                $_SESSION["fail"] .= "</br>$error";
            }
        }
        //$_SESSION["message"] = "We cant found any acount for this email.";
        // $_SESSION["fail"] = "We cant found any acount for this email.";
        // $errors[] = "We cant found any acount for this email.";
    }

  }

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main>
    <div class="container-xl px-4">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-10">
                <!-- Basic login form-->
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header justify-content-center">
                        <h3 class="fw-light my-4"><?php echo lang("Login"); ?></h3>
                    </div>
                    <div class="card-body">
                        <!-- Login form-->
                        <form action="" method="POST">
                            <!-- Form Group (email address)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                <input class="form-control" id="email" name="email" type="email"
                                    placeholder="<?php echo lang("Enter Email "); ?>" />
                            </div>
                            <!-- Form Group (password)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                <input class="form-control" id="password" name="password" type="password"
                                    placeholder="<?php echo lang("Enter password"); ?>" />
                            </div>
                            <!-- Form Group (remember password checkbox)-->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" id="rememberPasswordCheck" type="checkbox"
                                        value="" />
                                    <label class="form-check-label"
                                        for="rememberPasswordCheck"><?php echo lang("Remember password"); ?></label>
                                </div>
                            </div>
                            <!-- Form Group (login box)-->
                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                <a class="small" href="forget_password.php"><?php echo lang("Forgot Password?"); ?></a>
                                <button class="btn btn-primary" name="login"
                                    type="submit"><?php echo lang("Login"); ?></button>
                            </div>

                            <!-- Form Group (login box)-->
                            <div class="d-flex align-items-center  mt-4 mb-0">
                            <?php echo lang("Dont Have Account"); ?> 
                            <a class="small" href="index.php"> <?php echo lang("Create Account"); ?> </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>