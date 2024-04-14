<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/booking.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/service.php');
  include_once('../../includes/customer.php');

  checkAdminSession();

  $pageTitle = "Detail Booking";
  $row = new Booking(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getBookingById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = 'There is No data for this id';
          $_SESSION["fail"] = 'There is No data for this id';
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
    if(isset($_POST['deleteBooking']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteBooking($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Booking Detaild successfuly!";          
          $_SESSION["success"] = "Booking Detaild successfuly!";          
          header('Location:'. $PATH_ADMIN_BOOKING .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Detail Data";
          $_SESSION["fail"] = "Error when Detail Data";

          $errors[] = "Error when Detail Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Detail';
        $_SESSION["fail"] = 'No data for Detail';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Detail';
      $_SESSION["fail"] = 'No data for Detail';
    }

  }

?>

<?php include('../../template/startNavbar.php'); ?>

<!-- Content -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            Detail Booking
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
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <select disabled class="form-select" name="engineer_id" id="engineer_id" required>
                                        <option disabled value="">Select a Engineer:</option>
                                        <?php foreach(getAllEngineers() as $Engineer) { ?>
                                        <option <?php if($row['engineer_id'] == $Engineer['id']) echo "selected" ?> value="<?php echo $Engineer['id']; ?>"> <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (service_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_id">Service</label>
                                    <select disabled class="form-select" name="service_id" id="service_id" required>
                                        <option disabled value="">Select a Service:</option>
                                        <?php foreach(getAllServices() as $Service) { ?>
                                        <option <?php if($row['service_id'] == $Service['id']) echo "selected" ?> value="<?php echo $Service['id']; ?>"> <?php echo $Service['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id">Customer</label>
                                    <select disabled class="form-select" name="customer_id" id="customer_id" required>
                                        <option disabled value="">Select a Customer:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option <?php if($row['customer_id'] == $Customer['id']) echo "selected" ?> value="<?php echo $Customer['id']; ?>"> <?php echo $Customer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (card_number)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="card_number">Card Number</label>
                                    <input class="form-control" id="card_number" name="card_number" type="text" placeholder="Card Number"
                                        value="<?php echo $row['card_number'];?>" readonly />
                                </div>
                                <!-- Form Group (service_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_price">Service Price</label>
                                    <input class="form-control" id="service_price" name="service_price" type="text" placeholder="Service Price"
                                        value="<?php echo $row['service_price'];?>" readonly />
                                </div>
                                <!-- Form Group (paid_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="paid_price">Paid Price</label>
                                    <input class="form-control" id="paid_price" name="paid_price" type="text" placeholder="Paid Price"
                                        value="<?php echo $row['paid_price'];?>" readonly />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail">Detail</label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="Detail"
                                        value="<?php echo $row['detail'];?>" readonly />
                                </div>
                                <!-- Form Group (booking_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="booking_date">BookingDate</label>
                                    <input class="form-control" id="booking_date" name="booking_date" type="Date" placeholder="BookingDate"
                                        value="<?php echo $row['booking_date'];?>" readonly />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" type="button">Edit</a>
                            <a href="index.php" class="btn btn-primary" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
