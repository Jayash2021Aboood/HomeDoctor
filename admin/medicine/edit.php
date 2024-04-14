<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/medicine.php');
  include_once('../../includes/appointment.php');
  checkAdminSession();

  $pageTitle = lang("Edit Medicine");
  //$row = new Medicine(null);
   $id =  $appointment_id  =  $name =  $detail = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getMedicineById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $appointment_id  = $row['appointment_id '];
        $name = $row['name'];
        $detail = $row['detail'];
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
    if(isset($_POST['updateMedicine']))
    {
        $id = $_POST['id'];
        $appointment_id  = $_POST['appointment_id '];
        $name = $_POST['name'];
        $detail = $_POST['detail'];
      if( empty($appointment_id )){
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

        $result = getMedicineById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateMedicine( $id,  $appointment_id ,  $name,  $detail, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Medicine Updated successfuly!");
          $_SESSION["success"] = lang("Medicine Updated successfuly!");
          header('Location:'. $PATH_ADMIN_MEDICINE .'index.php');
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
                            <?php echo lang("Edit Medicine"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
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
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="<?php echo $name;?>" required />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail"><?php echo lang("Detail"); ?></label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="<?php echo lang("Detail"); ?>"
                                        value="<?php echo $detail;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateMedicine" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

