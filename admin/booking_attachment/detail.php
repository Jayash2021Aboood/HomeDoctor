<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/booking_attachment.php');
  include_once('../../includes/booking.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/customer.php');

  checkAdminSession();

  $pageTitle = "Detail BookingAttachment";
  $row = new BookingAttachment(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getBookingAttachmentById($id);

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
    if(isset($_POST['deleteBookingAttachment']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteBookingAttachment($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "BookingAttachment Detaild successfuly!";          
          $_SESSION["success"] = "BookingAttachment Detaild successfuly!";          
          header('Location:'. $PATH_ADMIN_BOOKING_ATTACHMENT .'index.php');
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
                            Detail BookingAttachment
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to BookingAttachments List
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
                <!-- BookingAttachment details card-->
                <div class="card mb-4">
                    <div class="card-header">BookingAttachment Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (booking_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="booking_id">Booking</label>
                                    <select disabled class="form-select" name="booking_id" id="booking_id" required>
                                        <option disabled value="">Select a Booking:</option>
                                        <?php foreach(getAllBookings() as $Booking) { ?>
                                        <option <?php if($row['booking_id'] == $Booking['id']) echo "selected" ?> value="<?php echo $Booking['id']; ?>"> <?php echo $Booking['id']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <select disabled class="form-select" name="engineer_id" id="engineer_id" >
                                        <option disabled value="">Select a Engineer:</option>
                                        <?php foreach(getAllEngineers() as $Engineer) { ?>
                                        <option <?php if($row['engineer_id'] == $Engineer['id']) echo "selected" ?> value="<?php echo $Engineer['id']; ?>"> <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id">Customer</label>
                                    <select disabled class="form-select" name="customer_id" id="customer_id" >
                                        <option disabled value="">Select a Customer:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option <?php if($row['customer_id'] == $Customer['id']) echo "selected" ?> value="<?php echo $Customer['id']; ?>"> <?php echo $Customer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (attachment)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="attachment">Attachment</label>
                                    <input class="form-control" id="attachment" name="attachment" type="file" placeholder="Attachment"
                                        value="<?php echo $row['attachment'];?>" readonly />
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
