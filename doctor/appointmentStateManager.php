<?php
  session_start();

  include('../includes/lib.php');
  include_once('../includes/appointment.php');
  checkAdminSession();

  //$pageTitle = "State Manager";
  //$row = new Appointment(null);

  $id =  $detail =  $patient_id =  $doctor_id =  $nurse_id =  $appointment_date =  $appointment_time =  $price =  $state =  $created_date = "";
  // include('../template/header.php'); 
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {

    // =======================================================================
    // ======================== Change State To Accept =======================
    // =======================================================================

    if(isset($_POST['changeStateToAccept']))
    {
      $id = $_POST['id'];
      $detail = $_POST['detail'];
      $patient_id = $_POST['patient_id'];
      $doctor_id = $_POST['doctor_id'];
      $nurse_id = $_POST['nurse_id'];
      $appointment_date = $_POST['appointment_date'];
      $appointment_time = $_POST['appointment_time'];
      $price = $_POST['price'];
      $state = $_POST['state'];
      $created_date = $_POST['created_date'];
      if( empty($detail)){
        $errors[] = "<li>" . lang("Detail is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Detail is requierd") . "</li>";
        }
      if( empty($patient_id)){
        $errors[] = "<li>" . lang("Patient is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Patient is requierd") . "</li>";
        }
      if( empty($appointment_date)){
        $errors[] = "<li>" . lang("Appointment Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment Date is requierd") . "</li>";
        }
      if( empty($appointment_time)){
        $errors[] = "<li>" . lang("Appointment Time is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment Time is requierd") . "</li>";
        }
      if( empty($price)){
        $errors[] = "<li>" . lang("Price is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Price is requierd") . "</li>";
        }
      if( empty($state)){
        $errors[] = "<li>" . lang("State is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("State is requierd") . "</li>";
        }
      if( empty($created_date)){
        $errors[] = "<li>" . lang("Created Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Created Date is requierd") . "</li>";
        }
      
        // =======================  Statrt Custom Validation code


        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getAppointmentById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        // =======================  Statrt Custom  code
          $state =  "accept";
        // =======================  End Custom  code

        $update = $update = query("UPDATE appointment SET state = 'accept' WHERE id = $id");
        if($update ==  true)
        {

          redirectToRefererSuccess("Appointment Accepted successfuly!");
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
      $detail = $_POST['detail'];
      $patient_id = $_POST['patient_id'];
      $doctor_id = $_POST['doctor_id'];
      $nurse_id = $_POST['nurse_id'];
      $appointment_date = $_POST['appointment_date'];
      $appointment_time = $_POST['appointment_time'];
      $price = $_POST['price'];
      $state = $_POST['state'];
      $created_date = $_POST['created_date'];
      if( empty($detail)){
        $errors[] = "<li>" . lang("Detail is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Detail is requierd") . "</li>";
        }
      if( empty($patient_id)){
        $errors[] = "<li>" . lang("Patient is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Patient is requierd") . "</li>";
        }
      if( empty($appointment_date)){
        $errors[] = "<li>" . lang("Appointment Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment Date is requierd") . "</li>";
        }
      if( empty($appointment_time)){
        $errors[] = "<li>" . lang("Appointment Time is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment Time is requierd") . "</li>";
        }
      if( empty($price)){
        $errors[] = "<li>" . lang("Price is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Price is requierd") . "</li>";
        }
      if( empty($state)){
        $errors[] = "<li>" . lang("State is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("State is requierd") . "</li>";
        }
      if( empty($created_date)){
        $errors[] = "<li>" . lang("Created Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Created Date is requierd") . "</li>";
        }
      
        // =======================  Statrt Custom Validation code


        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getAppointmentById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        // =======================  Statrt Custom  code
          $state =  "reject";
        // =======================  End Custom  code

        $update = query("UPDATE appointment SET state = 'reject' WHERE id = $id");
        if($update ==  true)
        {

          redirectToRefererSuccess("Appointment Rejected successfuly!");
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