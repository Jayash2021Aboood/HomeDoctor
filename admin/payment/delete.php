<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/payment.php');

  checkAdminSession();

  $pageTitle = lang("Delete Payment");
  $row = new Payment(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = lang('Are You Sure Want to Delete?');
      $id = $_GET['id'];
      $result = getPaymentById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = lang('There is No data for this id');
          $_SESSION["fail"] = lang('There is No data for this id');
      }

    }
    else
    {
      $_SESSION["message"] = lang('No data for display');
      $_SESSION["fail"] = lang('No data for display');
    }

  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['deletePayment']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deletePayment($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Payment Deleted successfuly!");          
          $_SESSION["success"] = lang("Payment Deleted successfuly!");          
          header('Location:'. $PATH_ADMIN_PAYMENT .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Delete Data");
          $_SESSION["fail"] = lang("Error when Delete Data");

          $errors[] = lang("Error when Delete Data");
        }
      }
      else
      {
        $_SESSION["message"] = lang('No data for Delete');
        $_SESSION["fail"] = lang('No data for Delete');
      }
    }
    else
    {
      $_SESSION["message"] = lang('No data for Delete');
      $_SESSION["fail"] = lang('No data for Delete');
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
                            <?php echo lang("Delete Payment"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Payments List"); ?>
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
                <!-- Payment details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Payment Details"); ?> <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (appointment_id )-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="appointment_id "><?php echo lang("Appointment"); ?></label>
                                    <input class="form-control" id="appointment_id " name="appointment_id " type="text" placeholder="<?php echo lang("Appointment"); ?>"
                                        value="<?php echo $row['appointment_id '];?>" readonly />
                                </div>
                                <!-- Form Group (paid_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="paid_price"><?php echo lang("Paid Price"); ?></label>
                                    <input class="form-control" id="paid_price" name="paid_price" type="text" placeholder="<?php echo lang("Paid Price"); ?>"
                                        value="<?php echo $row['paid_price'];?>" readonly />
                                </div>
                                <!-- Form Group (payment_method)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="payment_method"><?php echo lang("Payment Method"); ?></label>
                                    <input class="form-control" id="payment_method" name="payment_method" type="text" placeholder="<?php echo lang("Payment Method"); ?>"
                                        value="<?php echo $row['payment_method'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="deletePayment" class="btn btn-danger" type="submit"><?php echo lang("Delete"); ?></button>
                            <a href="index.php" class="btn btn-primary" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
