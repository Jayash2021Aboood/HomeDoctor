<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/nurse.php');
  checkAdminSession();

  //$pageTitle = "State Manager";
  //$row = new Nurse(null);

   $id =  $first_name =  $last_name =  $phone =  $email =  $password =  $city =  $specialty =  $date_of_graduate =  $experience_years =  $cv = $cv_old =  $image1 = $image1_old =  $image2 = $image2_old =  $image3 = $image3_old =  $image4 = $image4_old =  $image5 = $image5_old =  $image6 = $image6_old =  $state = "";
  // include('../../template/header.php'); 
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {

    // =======================================================================
    // ======================== Change State To Accept =======================
    // =======================================================================

    if(isset($_POST['changeStateToAccept']))
    {
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $city = $_POST['location'];
        $specialty = $_POST['specialty'];
        $date_of_graduate = $_POST['date_of_graduate'];
        $experience_years = $_POST['experience_years'];
      $cv_old = $_POST['cv_old'];
      $cv = uploadImage('cv', DIR_PHOTOES, $cv_old);
        $state = $_POST['state'];
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
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code


        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getNurseById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        // =======================  Statrt Custom  code
          $state =  "accept";
        // =======================  End Custom  code

        $update = $update = query("UPDATE nurse SET state = 'accept' WHERE id = $id");
        if($update ==  true)
        {

          redirectToRefererSuccess("Nurse Accepted successfuly!");
        }
        else
        {
          redirectToReferer("Error when Update Data");
        }
        
      }
      else
      {
        redirectToRefererSuccess();
      }
  
    }



    // =======================================================================
    // ======================== Change State To Reject =======================
    // =======================================================================

    if(isset($_POST['changeStateToReject']))
    {
      $id = $_POST['id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $city = $_POST['location'];
      $specialty = $_POST['specialty'];
      $date_of_graduate = $_POST['date_of_graduate'];
      $experience_years = $_POST['experience_years'];
    $cv_old = $_POST['cv_old'];
    $cv = uploadImage('cv', DIR_PHOTOES, $cv_old);
      $state = $_POST['state'];
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
    if( empty($state)){
      $errors[] = "<li>State is requierd.</li>";
      $_SESSION["fail"] .= "<li>State is requierd.</li>";
      }
      

        // =======================  Statrt Custom Validation code


        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getNurseById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        // =======================  Statrt Custom  code
          $state =  "reject";
        // =======================  End Custom  code

        $update = query("UPDATE nurse SET state = 'reject' WHERE id = $id");
        if($update ==  true)
        {

          redirectToRefererSuccess("Nurse Rejected successfuly!");
        }
        else
        {
          redirectToReferer("Error when Update Data");
        }
        
      }
      else
      {
        redirectToRefererSuccess();
      }
  
    }
  }

  redirectToRefererSuccess();

?>