<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/engineer.php');
  checkAdminSession();


  
  $pageTitle = "Add Engineer";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addEngineer']))
    {


      $first_name = $_POST['first_name'];

      $last_name = $_POST['last_name'];

      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $password = $_POST['password'];

      $city = $_POST['city'];

      $specialty = $_POST['specialty'];

      $date_of_graduate = $_POST['date_of_graduate'];

      $experience_years = $_POST['experience_years'];

      $cv = uploadImage('cv',DIR_PHOTOES);

      $image1 = uploadImage('image1',DIR_PHOTOES);

      $image2 = uploadImage('image2',DIR_PHOTOES);

      $image3 = uploadImage('image3',DIR_PHOTOES);

      $image4 = uploadImage('image4',DIR_PHOTOES);

      $image5 = uploadImage('image5',DIR_PHOTOES);

      $image6 = uploadImage('image6',DIR_PHOTOES);

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
        $add = addEngineer(
                                    $first_name,
                                    $last_name,
                                    $phone,
                                    $email,
                                    $password,
                                    $city,
                                    $specialty,
                                    $date_of_graduate,
                                    $experience_years,
                                    $cv,
                                    $image1,
                                    $image2,
                                    $image3,
                                    $image4,
                                    $image5,
                                    $image6,
                                    $state,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Engineer Added successfuly!";
          $_SESSION["success"] = "Engineer Added successfuly!";
          header('Location:'. $PATH_ADMIN_ENGINEER .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Adding Data";
          $_SESSION["fail"] = "Error when Adding Data";
          $errors[] = "Error when Adding Data";
        }
        
      }
  
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
                            Add Engineer
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
                    <div class="card-header">Engineer Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First Name"
                                        value="" required  />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Last Name"
                                        value="" required  />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="" required  />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="" required  />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                                        value="" required  />
                                </div>
                                <!-- Form Group (city)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="city">City</label>
                                    <input class="form-control" id="city" name="city" type="text" placeholder="City"
                                        value=""   />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty">Specialty</label>
                                    <input class="form-control" id="specialty" name="specialty" type="text" placeholder="Specialty"
                                        value="" required  />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate">Date of Graduate</label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate" type="date" placeholder="Date of Graduate"
                                        value="" required  />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years">Experience Years</label>
                                    <input class="form-control" id="experience_years" name="experience_years" type="text" placeholder="Experience Years"
                                        value="" required  />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv">CV</label>
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="CV"
                                        value="" required  />
                                </div>
                                <!-- Form Group (image1)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image1">Image1</label>
                                    <input class="form-control" id="image1" name="image1" type="file" placeholder="Image1"
                                        value=""   />
                                </div>
                                <!-- Form Group (image2)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image2">Image2</label>
                                    <input class="form-control" id="image2" name="image2" type="file" placeholder="Image2"
                                        value=""   />
                                </div>
                                <!-- Form Group (image3)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image3">Image3</label>
                                    <input class="form-control" id="image3" name="image3" type="file" placeholder="Image3"
                                        value=""   />
                                </div>
                                <!-- Form Group (image4)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image4">Image4</label>
                                    <input class="form-control" id="image4" name="image4" type="file" placeholder="Image4"
                                        value=""   />
                                </div>
                                <!-- Form Group (image5)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image5">Image5</label>
                                    <input class="form-control" id="image5" name="image5" type="file" placeholder="Image5"
                                        value=""   />
                                </div>
                                <!-- Form Group (image6)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image6">Image6</label>
                                    <input class="form-control" id="image6" name="image6" type="file" placeholder="Image6"
                                        value=""   />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addEngineer" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



