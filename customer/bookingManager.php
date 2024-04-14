<?php
  session_start();
  include('../includes/lib.php');
  include_once('../includes/engineer.php');
  include_once('../includes/customer.php');
  include_once('../includes/service.php');
  include_once('../includes/booking.php');
  include_once('../includes/booking_note.php');
  include_once('../includes/booking_attachment.php');
  include_once('../includes/rating.php');
  checkCustomerSession();


  
  //$pageTitle = "Add Booking";
  //include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    
    // =======================================================================
    // ======================== Customer Adding Booking ======================
    // =======================================================================
    if(isset($_POST['customerAddBooking']))
    {

    
      $engineer_id = $_POST['engineer_id'];

      $service_id = $_POST['service_id'];

      $customer_id = $_SESSION["userID"];

      $card_number = "NULL";

      $service_price = $_POST['service_price'];

      $paid_price = "NULL";
      
      $detail = $_POST['detail'];

      $booking_date = $_POST['booking_date'];
      

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
      if( empty($card_number)){
        $errors[] = "<li>Card Number is requierd.</li>";
        $_SESSION["fail"] .= "<li>Card Number is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($paid_price)){
        $errors[] = "<li>Paid Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Paid Price is requierd.</li>";
        }     
        if(!empty($service_price) && !empty($paid_price)){
            if($service_price > $paid_price){
                $errors[] = "<li>Paid Price is Must be the same Service Price</li>";
                $_SESSION["fail"] .= "<li>Paid Price is Must be the same Service Price</li>";
            }
        }


      
      if(count($errors) == 0)
      {
        $add = addBooking(
                                    $engineer_id,
                                    $service_id,
                                    $customer_id,
                                    $card_number,
                                    $service_price,
                                    $paid_price,
                                    $detail,
                                    $booking_date,
                                    'request',
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Booking Added successfuly!";
          $_SESSION["success"] = "Booking Added successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Adding Data";
          $_SESSION["fail"] = "Error when Adding Data";
          $errors[] = "Error when Adding Data";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        
      }
  
    }

    // =======================================================================
    // ======================== Customer Adding Rating ======================
    // =======================================================================
    if(isset($_POST['customerAddRating']))
    {
      $booking_id = $_POST['booking_id'];
      $rate = $_POST['rate'];
      $engineer_id = $customer_id = "";
      
      if( empty($_POST['booking_id'])){
        $errors[] = "<li>You Cant rate before you select buy servise </li>";
        $_SESSION["fail"] .= "<li>You Cant rate before you select buy servise </li>";
        }
      if( empty($_POST['rate'])){
        $errors[] = "<li>Rate value is requierd.</li>";
        $_SESSION["fail"] .= "<li>Rate value is requierd.</li>";
        }

      if(count($errors) > 0)
        redirectToReferer();

      $booking = getBookingById($booking_id);
      if(count($booking) == 0)
        redirectToReferer("No Booking Found to Rate");

      $row = $booking[0];
      $engineer_id = $row['engineer_id'];
      $customer_id = $row['customer_id'];

      if($customer_id != $_SESSION['userID']) 
        redirectToReferer("you dont have permission to modify this data!");
        
      if(count($errors) == 0)
      {
        $oldRate = select("SELECT * FROM rating WHERE engineer_id = $engineer_id AND customer_id = $customer_id;");
        if(count($oldRate) > 0)
          $add = updateRating($oldRate[0]['id'], $engineer_id, $customer_id, $rate);
        else
          $add = addRating($engineer_id, $customer_id, $rate);
        if($add ==  true)
        {
          $_SESSION["message"] = "Rating Updated successfuly!";
          $_SESSION["success"] = "Rating Updated successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          redirectToReferer("Error when Adding Data");
        }
        
      }
  
    }

    // =======================================================================
    // ======================== Customer Adding Booking Note =================
    // =======================================================================

    if(isset($_POST['customerAddBookingNote']))
    {
      $booking_id = $_POST['booking_id'];
      $note = $_POST['note'];
      $engineer_id = $customer_id = "";
      
      if( empty($_POST['booking_id'])){
        $errors[] = "<li>You Cant adding note before you select buy service </li>";
        $_SESSION["fail"] .= "<li>You adding  note before you select buy servise </li>";
        }
      if( empty($_POST['note'])){
        $errors[] = "<li>Note value is requierd.</li>";
        $_SESSION["fail"] .= "<li>Note value is requierd.</li>";
        }

      if(count($errors) > 0)
        redirectToReferer();

      $booking = getBookingById($booking_id);
      if(count($booking) == 0)
        redirectToReferer("No Booking Found to Adding Note");

      $row = $booking[0];
      $engineer_id = $row['engineer_id'];
      $customer_id = $row['customer_id'];
      
      if($customer_id != $_SESSION['userID']) 
        redirectToReferer("you dont have permission to modify this data!");

      if(count($errors) == 0)
      {
        $add = addBookingNote($booking_id, "NULL", $customer_id, $note);
        if($add ==  true)
        {
          $_SESSION["message"] = "Note Updated successfuly!";
          $_SESSION["success"] = "Note Updated successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          redirectToReferer("Error when Adding Data");
        }
        
      }
  
    }


    // =======================================================================
    // ======================== Customer Adding Booking Attachment ===========
    // =======================================================================

    if(isset($_POST['customerAddBookingAttachment']))
    {
      // var_dump($_POST);
      // exit();
      $booking_id = $_POST['booking_id'];
      //$attachment = $_POST['attachment'];
      $attachment = uploadImage('attachment',DIR_ATTACHMENTS);
      $engineer_id = $customer_id = "";
      
      if( empty($_POST['booking_id'])){
        $errors[] = "<li>You Cant adding attachment before you select buy service </li>";
        $_SESSION["fail"] .= "<li>You adding  attachment before you select buy servise </li>";
        }
      if( empty($attachment)){
        $errors[] = "<li>Attachment value is requierd.</li>";
        $_SESSION["fail"] .= "<li>Attachment value is requierd.</li>";
        }

      if(count($errors) > 0)
        redirectToReferer();

      $booking = getBookingById($booking_id);
      if(count($booking) == 0)
        redirectToReferer("No Booking Found to Adding Attachment");

      $row = $booking[0];
      $engineer_id = $row['engineer_id'];
      $customer_id = $row['customer_id'];
      
      if($customer_id != $_SESSION['userID']) 
        redirectToReferer("you dont have permission to modify this data!");

      if(count($errors) == 0)
      {
        $add = addBookingAttachment($booking_id, "NULL", $customer_id, $attachment);
        if($add ==  true)
        {
          $_SESSION["message"] = "Attachment Updated successfuly!";
          $_SESSION["success"] = "Attachment Updated successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          redirectToReferer("Error when Adding Data");
        }
        
      }
  
    }

    // =======================================================================
    // ======================== Customer Change Booking State To done =================
    // =======================================================================

    if(isset($_POST['customerAcceptBookingDone']))
    {
      $booking_id = $_POST['booking_id'];  
      $customer_id = "";
      
      if( empty($_POST['booking_id'])){
        $errors[] = "<li>booking is required </li>";
        $_SESSION["fail"] .= "<li>booking is required </li>";
        }

      if(count($errors) > 0)
        redirectToReferer();

      $booking = getBookingById($booking_id);
      if(count($booking) == 0)
        redirectToReferer("No Booking Found to Update");

      $row = $booking[0];
      $customer_id = $row['customer_id'];
      
      if($customer_id != $_SESSION['userID']) 
        redirectToReferer("you dont have permission to modify this data!");

      if($row['state'] != "ready")
        redirectToReferer("you cant update booking state, work Must be ready to to Make it Done");

      if(count($errors) == 0)
      {
        
        $add = query("UPDATE booking SET state = 'done' WHERE id = $booking_id");
        if($add ==  true)
        {
          $_SESSION["message"] = "Booking Updated successfuly!";
          $_SESSION["success"] = "Booking Updated successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          redirectToReferer("Error when Adding Data");
        }
        
      }
  
    }


    // =======================================================================
    // ======================== Customer Change Booking State To working =================
    // =======================================================================

    if(isset($_POST['customerBackBookingToEnginner']))
    {
      $booking_id = $_POST['booking_id'];  
      $customer_id = "";
      
      if( empty($_POST['booking_id'])){
        $errors[] = "<li>booking is required </li>";
        $_SESSION["fail"] .= "<li>booking is required </li>";
        }

      if(count($errors) > 0)
        redirectToReferer();

      $booking = getBookingById($booking_id);
      if(count($booking) == 0)
        redirectToReferer("No Booking Found to Update");

      $row = $booking[0];
      $customer_id = $row['customer_id'];
      
      if($customer_id != $_SESSION['userID']) 
        redirectToReferer("you dont have permission to modify this data!");

      if($row['state'] != "ready")
        redirectToReferer("you cant update booking state, work Must be ready to return it to Engineer");

      if(count($errors) == 0)
      {
        
        $add = query("UPDATE booking SET state = 'working' WHERE id = $booking_id");
        if($add ==  true)
        {
          $_SESSION["message"] = "Booking Updated successfuly!";
          $_SESSION["success"] = "Booking Updated successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          redirectToReferer("Error when Adding Data");
        }
        
      }
  
    }


    // =======================================================================
    // ======================== Customer Change Booking State To working =================
    // =======================================================================

    if(isset($_POST['customerPaidBooking']))
    {

      $id = $_POST['id'];
    
      $engineer_id = $_POST['engineer_id'];

      $service_id = $_POST['service_id'];

      $customer_id = $_SESSION["userID"];

      $card_number = $_POST['card_number'];

      $service_price = $_POST['service_price'];

      $paid_price = $_POST['paid_price'];
      
      $detail = $_POST['detail'];

      $booking_date = $_POST['booking_date'];

      if(!isset($id) || empty($id)){
        $errors[] = "<li>Booking  is requierd.</li>";
        $_SESSION["fail"] .= "<li>Booking is requierd.</li>";
        }

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
      if( empty($card_number)){
        $errors[] = "<li>Card Number is requierd.</li>";
        $_SESSION["fail"] .= "<li>Card Number is requierd.</li>";
        }
      if( empty($service_price)){
        $errors[] = "<li>Service Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Service Price is requierd.</li>";
        }
      if( empty($paid_price) || is_null($paid_price)){
        $errors[] = "<li>Paid Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Paid Price is requierd.</li>";
        }     
        if(!empty($service_price) && !empty($paid_price)){
            if($service_price > $paid_price){
                $errors[] = "<li>Paid Price is Must be the same Service Price</li>";
                $_SESSION["fail"] .= "<li>Paid Price is Must be the same Service Price</li>";
            }
        }


      if(count($errors) > 0)
        redirectToReferer();

      $booking = getBookingById($id);
      if(count($booking) == 0)
        redirectToReferer("No Booking Found to Update");

      $row = $booking[0];
      $customer_id = $row['customer_id'];
      
      if($customer_id != $_SESSION['userID']) 
        redirectToReferer("you dont have permission to modify this data!");

      // if($row['state'] != "ready")
      //   redirectToReferer("you cant update booking state, work Must be ready to return it to Engineer");

      if(count($errors) == 0)
      {
        
        $add = updateBooking($id, $engineer_id, $service_id, $customer_id, $card_number, $service_price, $paid_price, $detail, $booking_date, 'paid');
        if($add ==  true)
        {
          $_SESSION["message"] = "Booking Updated successfuly!";
          $_SESSION["success"] = "Booking Updated successfuly!";
          header('Location: ' . $_SERVER['HTTP_REFERER']);
          exit();
        }
        else
        {
          redirectToReferer("Error when Adding Data");
        }
        
      }
  
    }
   
    redirectToReferer();
  }
  redirectToReferer();
?>