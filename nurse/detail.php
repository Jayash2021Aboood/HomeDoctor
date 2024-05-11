<?php
  session_start();
  include('../includes/lib.php');
  include_once('../includes/appointment.php');
  include_once('../includes/patient.php');
  include_once('../includes/doctor.php');
  include_once('../includes/nurse.php');

  checkNurseSession();

  $pageTitle = lang("Appointment Details");
  $row = new Appointment(null);
  include('../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getAppointmentById($id);

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
    if(isset($_POST['deleteAppointment']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteAppointment($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Appointment Deleted successfuly!");          
          $_SESSION["success"] = lang("Appointment Deleted successfuly!");          
          header('Location:'. $PATH_NURSE_APPOINTMENT .'index.php');
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
                            <?php echo lang("Appointment Details"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Appointments List"); ?>
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
                <!-- Appointment details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Appointment Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail"><?php echo lang("Detail"); ?></label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="<?php echo lang("Detail"); ?>"
                                        value="<?php echo $row['detail'];?>" readonly />
                                </div>
                                <!-- Form Group (patient_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="patient_id"><?php echo lang("Patient"); ?></label>
                                    <select disabled class="form-select" name="patient_id" id="patient_id" required>
                                        <option disabled value=""><?php echo lang("Select a Patient"); ?>:</option>
                                        <?php foreach(getAllPatients() as $Patient) { ?>
                                        <option <?php if($row['patient_id'] == $Patient['id']) echo "selected" ?> value="<?php echo $Patient['id']; ?>"> <?php echo $Patient['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (doctor_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="doctor_id"><?php echo lang("Doctor"); ?></label>
                                    <select disabled class="form-select" name="doctor_id" id="doctor_id" >
                                        <option disabled value=""><?php echo lang("Select a Doctor"); ?>:</option>
                                        <?php foreach(getAllDoctors() as $Doctor) { ?>
                                        <option <?php if($row['doctor_id'] == $Doctor['id']) echo "selected" ?> value="<?php echo $Doctor['id']; ?>"> <?php echo $Doctor['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (nurse_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="nurse_id"><?php echo lang("Nurse"); ?></label>
                                    <select disabled class="form-select" name="nurse_id" id="nurse_id" >
                                        <option disabled value=""><?php echo lang("Select a Nurse"); ?>:</option>
                                        <?php foreach(getAllNurses() as $Nurse) { ?>
                                        <option <?php if($row['nurse_id'] == $Nurse['id']) echo "selected" ?> value="<?php echo $Nurse['id']; ?>"> <?php echo $Nurse['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (appointment_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="appointment_date"><?php echo lang("Appointment Date"); ?></label>
                                    <input class="form-control" id="appointment_date" name="appointment_date" type="date" placeholder="<?php echo lang("Appointment Date"); ?>"
                                        value="<?php echo $row['appointment_date'];?>" readonly />
                                </div>
                                <!-- Form Group (appointment_time)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="appointment_time"><?php echo lang("Appointment Time"); ?></label>
                                    <input class="form-control" id="appointment_time" name="appointment_time" type="text" placeholder="<?php echo lang("Appointment Time"); ?>"
                                        value="<?php echo $row['appointment_time'];?>" readonly />
                                </div>
                                <!-- Form Group (price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="price"><?php echo lang("Price"); ?></label>
                                    <input class="form-control" id="price" name="price" type="text" placeholder="<?php echo lang("Price"); ?>"
                                        value="<?php echo $row['price'];?>" readonly />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="<?php echo lang("State"); ?>"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
                                <!-- Form Group (created_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="created_date"><?php echo lang("Created Date"); ?></label>
                                    <input class="form-control" id="created_date" name="created_date" type="date" placeholder="<?php echo lang("Created Date"); ?>"
                                        value="<?php echo $row['created_date'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" type="button"><?php echo lang("Edit"); ?></a>
                            <a href="index.php" class="btn btn-primary" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../template/footer.php'); ?>
