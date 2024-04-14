<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/booking.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/service.php');
  include_once('../../includes/customer.php');
  checkAdminSession();

  
  
   $id =  $engineer_id =  $service_id =  $customer_id =  $card_number =  $service_price =  $paid_price =  $detail =  $booking_date =  $state = "";
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {


    // =======================================================================
    // ======================== Change State To Working =======================
    // =======================================================================
    if(isset($_POST['changeStateToAccept']))
    {
        $id = $_POST['id'];
        $engineer_id = $_POST['engineer_id'];
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $card_number = $_POST['card_number'];
        $service_price = $_POST['service_price'];
        $paid_price = $_POST['paid_price'];
        $detail = $_POST['detail'];
        $booking_date = $_POST['booking_date'];
        $state = $_POST['state'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_id)){
        $errors[] = "<li>Service is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($booking_date)){
        $errors[] = "<li>BookingDate is requierd.</li>";
        $_SESSION["fail"] .= "<li>BookingDate is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code
        if(!isset($paid_price) || empty($paid_price))
        {
            $paid_price = "NULL";
        }

        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];

        // =======================  Statrt Custom  code
          $state =  "working";
        // =======================  End Custom  code
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
            redirectToRefererSuccess("Booking State Updates successfuly!");
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
        $engineer_id = $_POST['engineer_id'];
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $card_number = $_POST['card_number'];
        $service_price = $_POST['service_price'];
        $paid_price = $_POST['paid_price'];
        $detail = $_POST['detail'];
        $booking_date = $_POST['booking_date'];
        $state = $_POST['state'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_id)){
        $errors[] = "<li>Service is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($booking_date)){
        $errors[] = "<li>BookingDate is requierd.</li>";
        $_SESSION["fail"] .= "<li>BookingDate is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code
        if(!isset($paid_price) || empty($paid_price))
        {
            $paid_price = "NULL";
        }

        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];

        // =======================  Statrt Custom  code
          $state =  "reject";
        // =======================  End Custom  code
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
            redirectToRefererSuccess("Booking Rejected successfuly!");
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
    // ======================== Change State To Ready =======================
    // =======================================================================
    if(isset($_POST['changeStateToReady']))
    {
        $id = $_POST['id'];
        $engineer_id = $_POST['engineer_id'];
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $card_number = $_POST['card_number'];
        $service_price = $_POST['service_price'];
        $paid_price = $_POST['paid_price'];
        $detail = $_POST['detail'];
        $booking_date = $_POST['booking_date'];
        $state = $_POST['state'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_id)){
        $errors[] = "<li>Service is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($booking_date)){
        $errors[] = "<li>BookingDate is requierd.</li>";
        $_SESSION["fail"] .= "<li>BookingDate is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code
        if(!isset($paid_price) || empty($paid_price))
        {
            $paid_price = "NULL";
        }

        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];

        // =======================  Statrt Custom  code
          $state =  "ready";
        // =======================  End Custom  code
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
            redirectToRefererSuccess("Booking State Updated successfuly!");
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
    // ======================== Change State To Done =======================
    // =======================================================================
    if(isset($_POST['changeStateToDone']))
    {
        $id = $_POST['id'];
        $engineer_id = $_POST['engineer_id'];
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $card_number = $_POST['card_number'];
        $service_price = $_POST['service_price'];
        $paid_price = $_POST['paid_price'];
        $detail = $_POST['detail'];
        $booking_date = $_POST['booking_date'];
        $state = $_POST['state'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_id)){
        $errors[] = "<li>Service is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($booking_date)){
        $errors[] = "<li>BookingDate is requierd.</li>";
        $_SESSION["fail"] .= "<li>BookingDate is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code
        if(!isset($paid_price) || empty($paid_price))
        {
            $paid_price = "NULL";
        }

        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];

        // =======================  Statrt Custom  code
          $state =  "done";
        // =======================  End Custom  code
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
            redirectToRefererSuccess("Booking State Updated successfuly!");
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
    // ======================== Change State To Paid =======================
    // =======================================================================
    if(isset($_POST['changeStateToPaid']))
    {
        $id = $_POST['id'];
        $engineer_id = $_POST['engineer_id'];
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $card_number = $_POST['card_number'];
        $service_price = $_POST['service_price'];
        $paid_price = $_POST['paid_price'];
        $detail = $_POST['detail'];
        $booking_date = $_POST['booking_date'];
        $state = $_POST['state'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_id)){
        $errors[] = "<li>Service is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($booking_date)){
        $errors[] = "<li>BookingDate is requierd.</li>";
        $_SESSION["fail"] .= "<li>BookingDate is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code
        if(!isset($paid_price) || empty($paid_price))
        {
            $paid_price = "NULL";
        }

        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];

        // =======================  Statrt Custom  code
          $state =  "paid";
        // =======================  End Custom  code
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
            redirectToRefererSuccess("Booking State Updated successfuly!");
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
    // ======================== Change State To Canceled =======================
    // =======================================================================
    if(isset($_POST['changeStateToCanceled']))
    {
        $id = $_POST['id'];
        $engineer_id = $_POST['engineer_id'];
        $service_id = $_POST['service_id'];
        $customer_id = $_POST['customer_id'];
        $card_number = $_POST['card_number'];
        $service_price = $_POST['service_price'];
        $paid_price = $_POST['paid_price'];
        $detail = $_POST['detail'];
        $booking_date = $_POST['booking_date'];
        $state = $_POST['state'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_id)){
        $errors[] = "<li>Service is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($booking_date)){
        $errors[] = "<li>BookingDate is requierd.</li>";
        $_SESSION["fail"] .= "<li>BookingDate is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      

        // =======================  Statrt Custom Validation code
        if(!isset($paid_price) || empty($paid_price))
        {
            $paid_price = "NULL";
        }
        // =======================  End Custom  Validation code

      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];

        // =======================  Statrt Custom  code
          $state =  "canceled";
        // =======================  End Custom  code
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
            redirectToRefererSuccess("Booking State Updated successfuly!");
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