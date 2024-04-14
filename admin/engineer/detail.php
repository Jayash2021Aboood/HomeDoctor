<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/engineer.php');

  checkAdminSession();

  $pageTitle = "Detail Engineer";
  $row = new Engineer(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getEngineerById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = 'There is No data for this id';
          $_SESSION["fail"] = 'There is No data for this id';
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
    if(isset($_POST['deleteEngineer']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteEngineer($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Engineer Detaild successfuly!";          
          $_SESSION["success"] = "Engineer Detaild successfuly!";          
          header('Location:'. $PATH_ADMIN_ENGINEER .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Detail Data";
          $_SESSION["fail"] = "Error when Detail Data";

          $errors[] = "Error when Detail Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Detail';
        $_SESSION["fail"] = 'No data for Detail';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Detail';
      $_SESSION["fail"] = 'No data for Detail';
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
                            Detail Engineer
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
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (first_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="first_name">First Name</label>
                                    <input class="form-control" id="first_name" name="first_name" type="text" placeholder="First Name"
                                        value="<?php echo $row['first_name'];?>" readonly />
                                </div>
                                <!-- Form Group (last_name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="last_name">Last Name</label>
                                    <input class="form-control" id="last_name" name="last_name" type="text" placeholder="Last Name"
                                        value="<?php echo $row['last_name'];?>" readonly />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone">Phone</label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="Phone"
                                        value="<?php echo $row['phone'];?>" readonly />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email">Email</label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"
                                        value="<?php echo $row['email'];?>" readonly />
                                </div>
                                <!-- Form Group (password)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                                        value="<?php echo $row['password'];?>" readonly />
                                </div>
                                <!-- Form Group (city)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="city">City</label>
                                    <input class="form-control" id="city" name="city" type="text" placeholder="City"
                                        value="<?php echo $row['city'];?>" readonly />
                                </div>
                                <!-- Form Group (specialty)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="specialty">Specialty</label>
                                    <input class="form-control" id="specialty" name="specialty" type="text" placeholder="Specialty"
                                        value="<?php echo $row['specialty'];?>" readonly />
                                </div>
                                <!-- Form Group (date_of_graduate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="date_of_graduate">Date of Graduate</label>
                                    <input class="form-control" id="date_of_graduate" name="date_of_graduate" type="date" placeholder="Date of Graduate"
                                        value="<?php echo $row['date_of_graduate'];?>" readonly />
                                </div>
                                <!-- Form Group (experience_years)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="experience_years">Experience Years</label>
                                    <input class="form-control" id="experience_years" name="experience_years" type="text" placeholder="Experience Years"
                                        value="<?php echo $row['experience_years'];?>" readonly />
                                </div>
                                <!-- Form Group (cv)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="cv">CV</label>
                                    <input class="form-control" id="cv" name="cv" type="file" placeholder="CV"
                                        value="<?php echo $row['cv'];?>" readonly />
                                </div>
                                <!-- Form Group (image1)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image1">Image1</label>
                                    <input class="form-control" id="image1" name="image1" type="file" placeholder="Image1"
                                        value="<?php echo $row['image1'];?>" readonly />
                                </div>
                                <!-- Form Group (image2)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image2">Image2</label>
                                    <input class="form-control" id="image2" name="image2" type="file" placeholder="Image2"
                                        value="<?php echo $row['image2'];?>" readonly />
                                </div>
                                <!-- Form Group (image3)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image3">Image3</label>
                                    <input class="form-control" id="image3" name="image3" type="file" placeholder="Image3"
                                        value="<?php echo $row['image3'];?>" readonly />
                                </div>
                                <!-- Form Group (image4)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image4">Image4</label>
                                    <input class="form-control" id="image4" name="image4" type="file" placeholder="Image4"
                                        value="<?php echo $row['image4'];?>" readonly />
                                </div>
                                <!-- Form Group (image5)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image5">Image5</label>
                                    <input class="form-control" id="image5" name="image5" type="file" placeholder="Image5"
                                        value="<?php echo $row['image5'];?>" readonly />
                                </div>
                                <!-- Form Group (image6)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image6">Image6</label>
                                    <input class="form-control" id="image6" name="image6" type="file" placeholder="Image6"
                                        value="<?php echo $row['image6'];?>" readonly />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state">State</label>
                                    <input class="form-control" id="state" name="state" type="text" placeholder="State"
                                        value="<?php echo $row['state'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <a href="edit.php?id=<?php echo $row['id'];?>" class="btn btn-success" type="button">Edit</a>
                            <a href="index.php" class="btn btn-primary" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
