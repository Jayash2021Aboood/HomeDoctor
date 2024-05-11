<?php
  session_start();
  include('../includes/lib.php');
  include_once('../includes/patient.php');

  checkNurseSession();


  $appointment_id= 0;

  $pageTitle = lang("Patient Details");
  $row = new Patient(null);
  include('../template/header.php');

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(isset($_GET['appointment_id'])){
        $appointment_id= $_GET['appointment_id'];
        } 
    }
  
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getPatientById($id);

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
    if(isset($_POST['deletePatient']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deletePatient($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Patient Deleted successfuly!");          
          $_SESSION["success"] = lang("Patient Deleted successfuly!");          
          header('Location:'. $PATH_NURSE_PATIENT .'index.php');
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
                            <?php echo lang("Patient Details"); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Patient details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Patient Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name"><?php echo lang("First Name"); ?></label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="<?php echo lang("First Name"); ?>"
                                        value="<?php echo $row['first_name'];?>" readonly />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name"><?php echo lang("Last Name"); ?></label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="<?php echo lang("Last Name"); ?>"
                                        value="<?php echo $row['last_name'];?>" readonly />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value="<?php echo $row['phone'];?>" readonly />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="<?php echo $row['email'];?>" readonly />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="<?php echo $row['location'];?>" readonly />
                                </div>
                                <!-- Form Group (date_of_birth)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_birth"><?php echo lang("Date of Birth"); ?></label>
                                    <input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="<?php echo lang("Date of Birth"); ?>"
                                        value="<?php echo $row['date_of_birth'];?>" readonly />
                                </div>
                                <!-- Form Group (height)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="height"><?php echo lang("Height"); ?></label>
                                    <input class="form-control" id="height" name="height" type="text" placeholder="<?php echo lang("Height"); ?>"
                                        value="<?php echo $row['height'];?>" readonly />
                                </div>
                                <!-- Form Group (weight)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="weight"><?php echo lang("Weight"); ?></label>
                                    <input class="form-control" id="weight" name="weight" type="text" placeholder="<?php echo lang("Weight"); ?>"
                                        value="<?php echo $row['weight'];?>" readonly />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="has_chronic_disease" name="has_chronic_disease"
                                        type="checkbox" disabled
                                        <?php if($row['has_chronic_disease'] == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="has_chronic_disease"><?php echo lang("Has Chronic Disease"); ?></label>
                                </div>
                                <!-- Form Group (what_are_diseases)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="what_are_diseases"><?php echo lang("What Are Diseases"); ?></label>
                                    <input class="form-control" id="what_are_diseases" name="what_are_diseases" type="text" placeholder="<?php echo lang("What Are Diseases"); ?>"
                                        value="<?php echo $row['what_are_diseases'];?>" readonly />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="has_allergic_to_anything" name="has_allergic_to_anything"
                                        type="checkbox" disabled
                                        <?php if($row['has_allergic_to_anything'] == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="has_allergic_to_anything"><?php echo lang("Has Allergic To Anything"); ?></label>
                                </div>
                                <!-- Form Group (what_are_things)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="what_are_things"><?php echo lang("What Are Things"); ?></label>
                                    <input class="form-control" id="what_are_things" name="what_are_things" type="text" placeholder="<?php echo lang("What Are Things"); ?>"
                                        value="<?php echo $row['what_are_things'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $appointment_id; ?>" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../template/footer.php'); ?>
