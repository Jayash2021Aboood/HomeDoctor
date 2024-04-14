<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/appointment.php');
  include_once('../../includes/patient.php');
  include_once('../../includes/doctor.php');
  include_once('../../includes/nurse.php');
  checkAdminSession();

  $pageTitle = lang("Edit Appointment");
  //$row = new Appointment(null);
   $id =  $detail =  $patient_id  =  $doctor_id =  $nurse_id =  $appointment_date =  $price =  $state = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getAppointmentById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $detail = $row['detail'];
        $patient_id  = $row['patient_id '];
        $doctor_id = $row['doctor_id'];
        $nurse_id = $row['nurse_id'];
        $appointment_date = $row['appointment_date'];
        $price = $row['price'];
        $state = $row['state'];
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
    if(isset($_POST['updateAppointment']))
    {
        $id = $_POST['id'];
        $detail = $_POST['detail'];
        $patient_id  = $_POST['patient_id '];
        $doctor_id = $_POST['doctor_id'];
        $nurse_id = $_POST['nurse_id'];
        $appointment_date = $_POST['appointment_date'];
        $price = $_POST['price'];
        $state = $_POST['state'];
      if( empty($detail)){
        $errors[] = "<li>" . lang("Detail is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Detail is requierd") . "</li>";
        }
      if( empty($patient_id )){
        $errors[] = "<li>" . lang("Patient is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Patient is requierd") . "</li>";
        }
      if( empty($appointment_date)){
        $errors[] = "<li>" . lang("Appointment Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment Date is requierd") . "</li>";
        }
      if( empty($price)){
        $errors[] = "<li>" . lang("Price is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Price is requierd") . "</li>";
        }
      if( empty($state)){
        $errors[] = "<li>" . lang("State is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("State is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getAppointmentById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateAppointment( $id,  $detail,  $patient_id ,  $doctor_id,  $nurse_id,  $appointment_date,  $price,  $state, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Appointment Updated successfuly!");
          $_SESSION["success"] = lang("Appointment Updated successfuly!");
          header('Location:'. $PATH_ADMIN_APPOINTMENT .'index.php');
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
                            <?php echo lang("Edit Appointment"); ?>
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
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail"><?php echo lang("Detail"); ?></label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="<?php echo lang("Detail"); ?>"
                                        value="<?php echo $detail;?>" required />
                                </div>
                                <!-- Form Group (patient_id )-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="patient_id "><?php echo lang("Patient"); ?></label>
                                    <select class="form-select" name="patient_id " id="patient_id " required>
                                        <option disabled value=""><?php echo lang("Select a Patient"); ?>:</option>
                                        <?php foreach(getAllPatients() as $Patient) { ?>
                                        <option <?php if($patient_id  == $Patient['id']) echo "selected" ?> value="<?php echo $Patient['id']; ?>"> <?php echo $Patient['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (doctor_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="doctor_id"><?php echo lang("Doctor"); ?></label>
                                    <select class="form-select" name="doctor_id" id="doctor_id" >
                                        <option disabled value=""><?php echo lang("Select a Doctor"); ?>:</option>
                                        <?php foreach(getAllDoctors() as $Doctor) { ?>
                                        <option <?php if($doctor_id == $Doctor['id']) echo "selected" ?> value="<?php echo $Doctor['id']; ?>"> <?php echo $Doctor['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (nurse_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="nurse_id"><?php echo lang("Nurse"); ?></label>
                                    <select class="form-select" name="nurse_id" id="nurse_id" >
                                        <option disabled value=""><?php echo lang("Select a Nurse"); ?>:</option>
                                        <?php foreach(getAllNurses() as $Nurse) { ?>
                                        <option <?php if($nurse_id == $Nurse['id']) echo "selected" ?> value="<?php echo $Nurse['id']; ?>"> <?php echo $Nurse['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (appointment_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="appointment_date"><?php echo lang("Appointment Date"); ?></label>
                                    <input class="form-control" id="appointment_date" name="appointment_date" type="date" placeholder="<?php echo lang("Appointment Date"); ?>"
                                        value="<?php echo $appointment_date;?>" required />
                                </div>
                                <!-- Form Group (price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="price"><?php echo lang("Price"); ?></label>
                                    <input class="form-control" id="price" name="price" type="text" placeholder="<?php echo lang("Price"); ?>"
                                        value="<?php echo $price;?>" required />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="<?php echo lang("State"); ?>"
                                        value="<?php echo $state;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateAppointment" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

