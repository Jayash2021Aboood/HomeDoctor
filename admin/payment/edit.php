<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/payment.php');
  include_once('../../includes/appointment.php');
  checkAdminSession();

  $pageTitle = lang("Edit Payment");
  //$row = new Payment(null);
   $id =  $appointment_id  =  $paid_price =  $payment_method = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getPaymentById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $appointment_id  = $row['appointment_id '];
        $paid_price = $row['paid_price'];
        $payment_method = $row['payment_method'];
      }
      else
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
    if(isset($_POST['updatePayment']))
    {
        $id = $_POST['id'];
        $appointment_id  = $_POST['appointment_id '];
        $paid_price = $_POST['paid_price'];
        $payment_method = $_POST['payment_method'];
      if( empty($appointment_id )){
        $errors[] = "<li>" . lang("Appointment is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment is requierd") . "</li>";
        }
      if( empty($paid_price)){
        $errors[] = "<li>" . lang("Paid Price is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Paid Price is requierd") . "</li>";
        }
      if( empty($payment_method)){
        $errors[] = "<li>" . lang("Payment Method is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Payment Method is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getPaymentById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updatePayment( $id,  $appointment_id ,  $paid_price,  $payment_method, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Payment Updated successfuly!");
          $_SESSION["success"] = lang("Payment Updated successfuly!");
          header('Location:'. $PATH_ADMIN_PAYMENT .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Update Data");
          $_SESSION["fail"] = lang("Error when Update Data");
          $errors[] = lang("Error when Update Data");
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
                            <?php echo lang("Edit Payment"); ?>
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
                    <div class="card-header"><?php echo lang("Payment Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (appointment_id )-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="appointment_id "><?php echo lang("Appointment"); ?></label>
                                    <select class="form-select" name="appointment_id " id="appointment_id " required>
                                        <option disabled value=""><?php echo lang("Select a Appointment"); ?>:</option>
                                        <?php foreach(getAllAppointments() as $Appointment) { ?>
                                        <option <?php if($appointment_id  == $Appointment['id']) echo "selected" ?> value="<?php echo $Appointment['id']; ?>"> <?php echo $Appointment['detail']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (paid_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="paid_price"><?php echo lang("Paid Price"); ?></label>
                                    <input class="form-control" id="paid_price" name="paid_price" type="text" placeholder="<?php echo lang("Paid Price"); ?>"
                                        value="<?php echo $paid_price;?>" required />
                                </div>
                                <!-- Form Group (payment_method)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="payment_method"><?php echo lang("Payment Method"); ?></label>
                                    <input class="form-control" id="payment_method" name="payment_method" type="text" placeholder="<?php echo lang("Payment Method"); ?>"
                                        value="<?php echo $payment_method;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updatePayment" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

