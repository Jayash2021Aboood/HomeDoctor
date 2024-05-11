<?php
  session_start();
  include('../includes/lib.php');
  include_once('../includes/medicine.php');
  include_once('../includes/appointment.php');
  checkDoctorSession();


  $appointment_id= 0;

  $pageTitle = lang("Add Medicine");
  include('../template/header.php'); 
  $errors = array();

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
      if(isset($_GET['appointment_id'])){
        $appointment_id= $_GET['appointment_id'];
      } 
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addMedicine']))
    {


      $appointment_id = $_POST['appointment_id'];

      $name = $_POST['name'];

      $detail = $_POST['detail'];

      if( empty($appointment_id)){
        $errors[] = "<li>" . lang("Appointment is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment is requierd") . "</li>";
        }
      if( empty($name)){
        $errors[] = "<li>" . lang("Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
        }
      if( empty($detail)){
        $errors[] = "<li>" . lang("Detail is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Detail is requierd") . "</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addMedicine(
                                    $appointment_id,
                                    $name,
                                    $detail,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = lang("Medicine Added successfuly!");
          $_SESSION["success"] = lang("Medicine Added successfuly!");
          header('Location:'. $PATH_DOCTOR .'edit.php?id='.$appointment_id);
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Adding Data");
          $_SESSION["fail"] = lang("Error when Adding Data");
          $errors[] = lang("Error when Adding Data");
        }
        
      }
  
    }
  }
?>

<?php include('../template/startNavbar.php'); ?>



<!-- Content -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                           <?php echo lang("Add Medicine"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="edit.php?id=<?php echo $appointment_id; ?>">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Medicines List"); ?>
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
                <!-- Medicine details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Medicine Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                
                                <!-- Form Group (appointment_id)-->
                                <div class="col-md-4 mb-3 d-none">
                                    <label class="small mb-1" for="appointment_id"><?php echo lang("Appointment"); ?></label>
                                    <select class="form-select" name="appointment_id" id="appointment_id" required>
                                        <option disabled value=""><?php echo lang("Select a Appointment"); ?>:</option>
                                        <?php foreach(getAllAppointments() as $Appointment) { ?>
                                        <option <?php if($appointment_id == $Appointment['id']) echo "selected" ?> value="<?php echo $Appointment['id']; ?>"> <?php echo $Appointment['detail']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail"><?php echo lang("Detail"); ?></label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="<?php echo lang("Detail"); ?>"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addMedicine" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="edit.php?id=<?php echo $appointment_id; ?>" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../template/footer.php'); ?>



