<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/booking_note.php');

  checkAdminSession();

  $pageTitle = "Delete BookingNote";
  $row = new BookingNote(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = ' Are You Sure Want to Delete? ';
      $id = $_GET['id'];
      $result = getBookingNoteById($id);

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
    if(isset($_POST['deleteBookingNote']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteBookingNote($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "BookingNote Deleted successfuly!";          
          $_SESSION["success"] = "BookingNote Deleted successfuly!";          
          header('Location:'. $PATH_ADMIN_BOOKING_NOTE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Delete Data";
          $_SESSION["fail"] = "Error when Delete Data";

          $errors[] = "Error when Delete Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Delete';
        $_SESSION["fail"] = 'No data for Delete';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Delete';
      $_SESSION["fail"] = 'No data for Delete';
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
                            Delete BookingNote
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to BookingNotes List
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
                <!-- BookingNote details card-->
                <div class="card mb-4">
                    <div class="card-header">BookingNote Details <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (booking_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="booking_id">Booking</label>
                                    <input class="form-control" id="booking_id" name="booking_id" type="text" placeholder="Booking"
                                        value="<?php echo $row['booking_id'];?>" readonly />
                                </div>
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <input class="form-control" id="engineer_id" name="engineer_id" type="text" placeholder="Engineer"
                                        value="<?php echo $row['engineer_id'];?>" readonly />
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id">Customer</label>
                                    <input class="form-control" id="customer_id" name="customer_id" type="text" placeholder="Customer"
                                        value="<?php echo $row['customer_id'];?>" readonly />
                                </div>
                                <!-- Form Group (note)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="note">Note</label>
                                    <input class="form-control" id="note" name="note" type="text" placeholder="Note"
                                        value="<?php echo $row['note'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="deleteBookingNote" class="btn btn-danger" type="submit">Delete</button>
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
