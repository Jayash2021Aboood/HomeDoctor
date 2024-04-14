<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/booking.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/service.php');
  include_once('../../includes/customer.php');
  checkAdminSession();

  $pageTitle = "Edit Booking";
  //$row = new Booking(null);
   $id =  $engineer_id =  $service_id =  $customer_id =  $card_number =  $service_price =  $paid_price =  $detail =  $booking_date =  $state = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getBookingById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $engineer_id = $row['engineer_id'];
        $service_id = $row['service_id'];
        $customer_id = $row['customer_id'];
        $card_number = $row['card_number'];
        $service_price = $row['service_price'];
        $paid_price = $row['paid_price'];
        $detail = $row['detail'];
        $booking_date = $row['booking_date'];
        $state = $row['state'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
      }

    }
    else
    {
      $_SESSION["message"] = 'No data for display';
      $_SESSION["fail"] = 'No data for display';
      
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateBooking']))
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
      
      if(count($errors) == 0)
      {

        $result = getBookingById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateBooking( $id,  $engineer_id,  $service_id,  $customer_id,  $card_number,  $service_price,  $paid_price,  $detail,  $booking_date,  $state, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Booking Updated successfuly!";
          $_SESSION["success"] = "Booking Updated successfuly!";
          header('Location:'. $PATH_ADMIN_BOOKING .'index.php');
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
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            Edit Booking
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Bookings List
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
                <!-- Booking details card-->
                <div class="card mb-4">
                    <div class="card-header">Booking Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <select class="form-select" name="engineer_id" id="engineer_id" required>
                                        <option disabled value="">Select a Engineer:</option>
                                        <?php foreach(getAllEngineers() as $Engineer) { ?>
                                        <option <?php if($engineer_id == $Engineer['id']) echo "selected" ?>
                                            value="<?php echo $Engineer['id']; ?>">
                                            <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (service_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_id">Service</label>
                                    <select class="form-select" name="service_id" id="service_id" required>
                                        <option disabled value="">Select a Service:</option>
                                        <?php foreach(getAllServices() as $Service) { ?>
                                        <option <?php if($service_id == $Service['id']) echo "selected" ?>
                                            value="<?php echo $Service['id']; ?>"> <?php echo $Service['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id">Customer</label>
                                    <select class="form-select" name="customer_id" id="customer_id" required>
                                        <option disabled value="">Select a Customer:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option <?php if($customer_id == $Customer['id']) echo "selected" ?>
                                            value="<?php echo $Customer['id']; ?>">
                                            <?php echo $Customer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (card_number)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="card_number">Card Number</label>
                                    <input class="form-control" id="card_number" name="card_number" type="text"
                                        placeholder="Card Number" value="<?php echo $card_number;?>" />
                                </div>
                                <!-- Form Group (service_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_price">Service Price</label>
                                    <input class="form-control" id="service_price" name="service_price" type="text"
                                        placeholder="Service Price" value="<?php echo $service_price;?>" required />
                                </div>
                                <!-- Form Group (paid_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="paid_price">Paid Price</label>
                                    <input class="form-control" id="paid_price" name="paid_price" type="number"
                                        placeholder="Paid Price" default="0" value="<?php echo $paid_price;?>" />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail">Detail</label>
                                    <input class="form-control" id="detail" name="detail" type="text"
                                        placeholder="Detail" value="<?php echo $detail;?>" />
                                </div>
                                <!-- Form Group (booking_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="booking_date">BookingDate</label>
                                    <input class="form-control" id="booking_date" name="booking_date" type="Date"
                                        placeholder="BookingDate" value="<?php echo $booking_date;?>" required />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="<?php echo $state;?>" required readonly />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="updateBooking" class="mb-1 btn btn-success" type="submit">Save</button>
                            <button name="changeStateToAccept" class="mb-1 btn btn-info" type="submit"
                                formaction="bookingStateManager.php?id=<?php echo $id;?>">Accept</button>
                            <button name="changeStateToReject" class="mb-1 btn btn-pink" type="submit"
                                formaction="bookingStateManager.php?id=<?php echo $id;?>">Reject</button>
                            <button name="changeStateToReady" class="mb-1 btn btn-primary" type="submit"
                                formaction="bookingStateManager.php?id=<?php echo $id;?>">Ready</button>
                            <button name="changeStateToDone" class="mb-1 btn btn-success" type="submit"
                                formaction="bookingStateManager.php?id=<?php echo $id;?>">Done</button>
                            <button name="changeStateToPaid" class="mb-1 btn btn-warning" type="submit"
                                formaction="bookingStateManager.php?id=<?php echo $id;?>">Paid</button>
                            <button name="changeStateToCanceled" class="mb-1 btn btn-danger" type="submit"
                                formaction="bookingStateManager.php?id=<?php echo $id;?>">Canceled</button>
                            <a href="index.php" class="mb-1 btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>