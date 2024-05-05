<?php
  session_start();

  include('../includes/lib.php');
  include_once('../includes/patient.php');
  checkPatientSession();

  $pageTitle = "My Profile";
  
  $id =  $first_name =  $last_name =  $phone =  $email =  $password =  $location =  $date_of_birth =  $height =  $weight =  $has_chronic_disease =  $what_are_diseases =  $has_allergic_to_anything =  $what_are_things = "";
  
  include('../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    
      $_SESSION["message"] = '';
      $id = $_SESSION['userID'];
      $result = getPatientById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $password = $row['password'];
        $location = $row['location'];
        $date_of_birth = $row['date_of_birth'];
        $height = $row['height'];
        $weight = $row['weight'];
        $has_chronic_disease = ( isset( $row['has_chronic_disease']))? 1:0;
        $what_are_diseases = $row['what_are_diseases'];
        $has_allergic_to_anything = ( isset( $row['has_allergic_to_anything']))? 1:0;
        $what_are_things = $row['what_are_things'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
      }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updatePatient']))
    {
      $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $location = $_POST['location'];
        $date_of_birth = $_POST['date_of_birth'];
        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $has_chronic_disease = ( isset( $_POST['has_chronic_disease']))? 1:0;
        $what_are_diseases = $_POST['what_are_diseases'];
        $has_allergic_to_anything = ( isset( $_POST['has_allergic_to_anything']))? 1:0;
        $what_are_things = $_POST['what_are_things'];
      if( empty($first_name)){
        $errors[] = "<li>" . lang("First Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("First Name is requierd") . "</li>";
        }
      if( empty($last_name)){
        $errors[] = "<li>" . lang("Last Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Last Name is requierd") . "</li>";
        }
      if( empty($phone)){
        $errors[] = "<li>" . lang("Phone is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Phone is requierd") . "</li>";
        }
      if( empty($email)){
        $errors[] = "<li>" . lang("Email is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Email is requierd") . "</li>";
        }
      if( empty($password)){
        $errors[] = "<li>" . lang("Password is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Password is requierd") . "</li>";
        }
      if( empty($location)){
        $errors[] = "<li>" . lang("Location is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Location is requierd") . "</li>";
        }
      if( empty($date_of_birth)){
        $errors[] = "<li>" . lang("Date of Birth is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Date of Birth is requierd") . "</li>";
        }
      if( empty($height)){
        $errors[] = "<li>" . lang("Height is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Height is requierd") . "</li>";
        }
      if( empty($weight)){
        $errors[] = "<li>" . lang("Weight is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Weight is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getPatientById($id);
        if( count( $result ) > 0)
          $row = $result[0];
          $email = $row['email'];
        
        $update = updatePatient($id,  $first_name,  $last_name,  $phone,  $email,  $password,  $location,  $date_of_birth,  $height,  $weight,  $has_chronic_disease,  $what_are_diseases,  $has_allergic_to_anything,  $what_are_things, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Data Updated successfuly!";
          $_SESSION["success"] = "Data Updated successfuly!";
          header('Location:index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Update Data";
          $_SESSION["fail"] = "Error when Update Data";
          $errors[] = "Error when Update Data";
        }
        
      }
      else
      {
        redirectToReferer();
      }
  
    }
  }
?>

<?php include('../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            My Profile
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Home
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
                <!-- Patient details card-->
                <div class="card mb-4">
                    <div class="card-header">My Profile Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name"><?php echo lang("First Name"); ?></label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="<?php echo lang("First Name"); ?>"
                                        value="<?php echo $first_name;?>" required />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name"><?php echo lang("Last Name"); ?></label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="<?php echo lang("Last Name"); ?>"
                                        value="<?php echo $last_name;?>" required />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value="<?php echo $phone;?>" required />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value="<?php echo $email;?>" required readonly/>
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password"><?php echo lang("Password"); ?></label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="<?php echo lang("Password"); ?>"
                                        value="<?php echo $password;?>" required />
                                </div>
                                <!-- Form Group (location)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="location"><?php echo lang("Location"); ?></label>
                                    <input class="form-control" id="location" name="location" type="text" placeholder="<?php echo lang("Location"); ?>"
                                        value="<?php echo $location;?>" required />
                                </div>
                                <!-- Form Group (date_of_birth)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_birth"><?php echo lang("Date of Birth"); ?></label>
                                    <input class="form-control" id="date_of_birth" name="date_of_birth" type="date" placeholder="<?php echo lang("Date of Birth"); ?>"
                                        value="<?php echo $date_of_birth;?>" required />
                                </div>
                                <!-- Form Group (height)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="height"><?php echo lang("Height"); ?></label>
                                    <input class="form-control" id="height" name="height" type="text" placeholder="<?php echo lang("Height"); ?>"
                                        value="<?php echo $height;?>" required />
                                </div>
                                <!-- Form Group (weight)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="weight"><?php echo lang("Weight"); ?></label>
                                    <input class="form-control" id="weight" name="weight" type="text" placeholder="<?php echo lang("Weight"); ?>"
                                        value="<?php echo $weight;?>" required />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="has_chronic_disease" name="has_chronic_disease"
                                        type="checkbox"
                                        <?php if($has_chronic_disease == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="has_chronic_disease"><?php echo lang("Has Chronic Disease"); ?></label>
                                </div>
                                <!-- Form Group (what_are_diseases)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="what_are_diseases"><?php echo lang("What Are Diseases"); ?></label>
                                    <input class="form-control" id="what_are_diseases" name="what_are_diseases" type="text" placeholder="<?php echo lang("What Are Diseases"); ?>"
                                        value="<?php echo $what_are_diseases;?>"  />
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="has_allergic_to_anything" name="has_allergic_to_anything"
                                        type="checkbox"
                                        <?php if($has_allergic_to_anything == 1) echo 'checked';?> />
                                    <label class="form-check-label" for="has_allergic_to_anything"><?php echo lang("Has Allergic To Anything"); ?></label>
                                </div>
                                <!-- Form Group (what_are_things)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="what_are_things"><?php echo lang("What Are Things"); ?></label>
                                    <input class="form-control" id="what_are_things" name="what_are_things" type="text" placeholder="<?php echo lang("What Are Things"); ?>"
                                        value="<?php echo $what_are_things;?>"  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="updatePatient" class="btn btn-success" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../template/footer.php'); ?>