<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/setting.php');
  checkAdminSession();

  $pageTitle = lang("Update Setting");
  //$row = new Setting(null);
   $id =  $appointment_price = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
      $_SESSION["message"] = '';
      $result = GetSetting();

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $appointment_price = $row['appointment_price'];
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateSetting']))
    {
        $id = $_POST['id'];
        $appointment_price = $_POST['appointment_price'];
      if( empty($appointment_price)){
        $errors[] = "<li>" . lang("Appointment Price is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Appointment Price is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = GetSetting();
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = AddOrUpdateSetting($appointment_price);
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Setting Updated successfuly!");
          $_SESSION["success"] = lang("Setting Updated successfuly!");
          header('Location:'. $PATH_ADMIN_SETTING .'index.php');
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
                            <?php echo lang("Update Setting"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Setting details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Setting Data"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (appointment_price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1"
                                        for="appointment_price"><?php echo lang("Appointment Price"); ?></label>
                                    <input class="form-control" id="appointment_price" name="appointment_price" type="text"
                                        placeholder="<?php echo lang("Appointment Price"); ?>"
                                        value="<?php echo $appointment_price;?>" required />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="updateSetting" class="btn btn-success"
                                type="submit"><?php echo lang("Save"); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>