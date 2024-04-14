<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/engineer.php');
  checkAdminSession();

  $pageTitle = "Edit Engineer";
  //$row = new Engineer(null);
   $id =  $first_name =  $last_name =  $phone =  $email =  $password =  $city =  $specialty =  $date_of_graduate =  $experience_years =  $cv = $cv_old =  $image1 = $image1_old =  $image2 = $image2_old =  $image3 = $image3_old =  $image4 = $image4_old =  $image5 = $image5_old =  $image6 = $image6_old =  $state = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getEngineerById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $password = $row['password'];
        $city = $row['city'];
        $specialty = $row['specialty'];
        $date_of_graduate = $row['date_of_graduate'];
        $experience_years = $row['experience_years'];
        $cv = $row['cv'];
        $image1 = $row['image1'];
        $image2 = $row['image2'];
        $image3 = $row['image3'];
        $image4 = $row['image4'];
        $image5 = $row['image5'];
        $image6 = $row['image6'];
        $state = $row['state'];
      }
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
        $_SESSION["fail"] = ' There is No data for this id';
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
    if(isset($_POST['updateEngineer']))
    {
        $id = $_POST['id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $city = $_POST['city'];
        $specialty = $_POST['specialty'];
        $date_of_graduate = $_POST['date_of_graduate'];
        $experience_years = $_POST['experience_years'];
      $cv_old = $_POST['cv_old'];
      $cv = uploadImage('cv', DIR_PHOTOES, $cv_old);
      $image1_old = $_POST['image1_old'];
      $image1 = uploadImage('image1', DIR_PHOTOES, $image1_old);
      $image2_old = $_POST['image2_old'];
      $image2 = uploadImage('image2', DIR_PHOTOES, $image2_old);
      $image3_old = $_POST['image3_old'];
      $image3 = uploadImage('image3', DIR_PHOTOES, $image3_old);
      $image4_old = $_POST['image4_old'];
      $image4 = uploadImage('image4', DIR_PHOTOES, $image4_old);
      $image5_old = $_POST['image5_old'];
      $image5 = uploadImage('image5', DIR_PHOTOES, $image5_old);
      $image6_old = $_POST['image6_old'];
      $image6 = uploadImage('image6', DIR_PHOTOES, $image6_old);
        $state = $_POST['state'];
      if( empty($first_name)){
        $errors[] = "<li>First Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>First Name is requierd.</li>";
        }
      if( empty($last_name)){
        $errors[] = "<li>Last Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Last Name is requierd.</li>";
        }
      if( empty($phone)){
        $errors[] = "<li>Phone is requierd.</li>";
        $_SESSION["fail"] .= "<li>Phone is requierd.</li>";
        }
      if( empty($email)){
        $errors[] = "<li>Email is requierd.</li>";
        $_SESSION["fail"] .= "<li>Email is requierd.</li>";
        }
      if( empty($password)){
        $errors[] = "<li>Password is requierd.</li>";
        $_SESSION["fail"] .= "<li>Password is requierd.</li>";
        }
      if( empty($specialty)){
        $errors[] = "<li>Specialty is requierd.</li>";
        $_SESSION["fail"] .= "<li>Specialty is requierd.</li>";
        }
      if( empty($date_of_graduate)){
        $errors[] = "<li>Date of Graduate is requierd.</li>";
        $_SESSION["fail"] .= "<li>Date of Graduate is requierd.</li>";
        }
      if( empty($experience_years)){
        $errors[] = "<li>Experience Years is requierd.</li>";
        $_SESSION["fail"] .= "<li>Experience Years is requierd.</li>";
        }
      if( empty($cv)){
        $errors[] = "<li>CV is requierd.</li>";
        $_SESSION["fail"] .= "<li>CV is requierd.</li>";
        }
      if( empty($state)){
        $errors[] = "<li>State is requierd.</li>";
        $_SESSION["fail"] .= "<li>State is requierd.</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getEngineerById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateEngineer( $id,  $first_name,  $last_name,  $phone,  $email,  $password,  $city,  $specialty,  $date_of_graduate,  $experience_years,  $cv,  $image1,  $image2,  $image3,  $image4,  $image5,  $image6,  $state, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Engineer Updated successfuly!";
          $_SESSION["success"] = "Engineer Updated successfuly!";
          header('Location:'. $PATH_ADMIN_ENGINEER .'index.php');
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
                            Edit Engineer
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Engineers List
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
                <!-- Engineer details card-->
                <div class="card mb-4">
                    <div class="card-header">Engineer Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text"
                                        placeholder="First Name" value="<?php echo $first_name;?>" required />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text"
                                        placeholder="Last Name" value="<?php echo $last_name;?>" required />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="<?php echo $phone;?>" required />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="<?php echo $email;?>" required readonly />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password"
                                        placeholder="Password" value="<?php echo $password;?>" required />
                                </div>
                                <!-- Form Group (city)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="city">City</label>
                                    <input class="form-control" id="city" name="city" type="text" placeholder="City"
                                        value="<?php echo $city;?>" />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty">Specialty</label>
                                    <input class="form-control" id="specialty" name="specialty" type="text"
                                        placeholder="Specialty" value="<?php echo $specialty;?>" required />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate">Date of Graduate</label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate"
                                        type="date" placeholder="Date of Graduate"
                                        value="<?php echo $date_of_graduate;?>" required />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years">Experience Years</label>
                                    <input class="form-control" id="experience_years" name="experience_years"
                                        type="text" placeholder="Experience Years"
                                        value="<?php echo $experience_years;?>" required />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv">CV</label>
                                    <input id="cv_old" name="cv_old" type="hidden" value="<?php echo $cv;?>" />
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="CV"
                                        value="<?php echo $cv;?>"
                                        <?php if( !isset($cv) || empty($cv)) echo 'required';?> />
                                </div>
                                <!-- Form Group (image1)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image1">Image1</label>
                                    <input id="image1_old" name="image1_old" type="hidden"
                                        value="<?php echo $image1;?>" />
                                    <input class="form-control" id="image1" name="image1" type="file"
                                        placeholder="Image1" value="<?php echo $image1;?>" />
                                </div>
                                <!-- Form Group (image2)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image2">Image2</label>
                                    <input id="image2_old" name="image2_old" type="hidden"
                                        value="<?php echo $image2;?>" />
                                    <input class="form-control" id="image2" name="image2" type="file"
                                        placeholder="Image2" value="<?php echo $image2;?>" />
                                </div>
                                <!-- Form Group (image3)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image3">Image3</label>
                                    <input id="image3_old" name="image3_old" type="hidden"
                                        value="<?php echo $image3;?>" />
                                    <input class="form-control" id="image3" name="image3" type="file"
                                        placeholder="Image3" value="<?php echo $image3;?>" />
                                </div>
                                <!-- Form Group (image4)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image4">Image4</label>
                                    <input id="image4_old" name="image4_old" type="hidden"
                                        value="<?php echo $image4;?>" />
                                    <input class="form-control" id="image4" name="image4" type="file"
                                        placeholder="Image4" value="<?php echo $image4;?>" />
                                </div>
                                <!-- Form Group (image5)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image5">Image5</label>
                                    <input id="image5_old" name="image5_old" type="hidden"
                                        value="<?php echo $image5;?>" />
                                    <input class="form-control" id="image5" name="image5" type="file"
                                        placeholder="Image5" value="<?php echo $image5;?>" />
                                </div>
                                <!-- Form Group (image6)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image6">Image6</label>
                                    <input id="image6_old" name="image6_old" type="hidden"
                                        value="<?php echo $image6;?>" />
                                    <input class="form-control" id="image6" name="image6" type="file"
                                        placeholder="Image6" value="<?php echo $image6;?>" />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="<?php echo $state;?>" required readonly />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="updateEngineer" class="btn btn-success" type="submit">Save</button>
                            <button name="changeStateToAccept" class="btn btn-info" type="submit"
                                formaction="engineerStateManager.php?id=<?php echo $id;?>">Accept</button>
                            <button name="changeStateToReject" class="btn btn-pink" type="submit"
                                formaction="engineerStateManager.php?id=<?php echo $id;?>">Reject</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>