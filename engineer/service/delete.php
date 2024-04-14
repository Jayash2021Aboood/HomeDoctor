<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/service.php');

  checkEngineerSession();

  $pageTitle = "Delete Service";
  $row = new Service(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = ' Are You Sure Want to Delete? ';
      $id = $_GET['id'];
      $result = getServiceById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = 'There is No data for this id';
          $_SESSION["fail"] = 'There is No data for this id';
      }
      else
      {
        if($row['engineer_id'] != $_SESSION['userID'])
        {
          redirectToReferer("Access Denied You Dont have permission to access this Link");
        }
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
    if(isset($_POST['deleteService']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteService($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Service Deleted successfuly!";          
          $_SESSION["success"] = "Service Deleted successfuly!";          
          header('Location:'. $PATH_ENGINEER_SERVICE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Delete Data";
          $_SESSION["fail"] = "Error when Delete Data";

          $errors[] = "Error when Delete Data";
        }
      }
      else
      {
        $_SESSION["message"] = 'No data for Delete';
        $_SESSION["fail"] = 'No data for Delete';
      }
    }
    else
    {
      $_SESSION["message"] = 'No data for Delete';
      $_SESSION["fail"] = 'No data for Delete';
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
                            Delete Service
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Services List
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
                <!-- Service details card-->
                <div class="card mb-4">
                    <div class="card-header">Service Details <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (service_type_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_type_id">ServiceType</label>
                                    <input class="form-control" id="service_type_id" name="service_type_id" type="text"
                                        placeholder="ServiceType" value="<?php echo $row['service_type_id'];?>"
                                        readonly />
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="<?php echo $row['name'];?>" readonly />
                                </div>
                                <!-- Form Group (price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="price">Price</label>
                                    <input class="form-control" id="price" name="price" type="text" placeholder="Price"
                                        value="<?php echo $row['price'];?>" readonly />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail">Detail</label>
                                    <input class="form-control" id="detail" name="detail" type="text"
                                        placeholder="Detail" value="<?php echo $row['detail'];?>" readonly />
                                </div>
                                <!-- Form Group (image)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image">Image</label>
                                    <input class="form-control" id="image" name="image" type="text" placeholder="Image"
                                        value="<?php echo $row['image'];?>" readonly />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="deleteService" class="btn btn-danger" type="submit">Delete</button>
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