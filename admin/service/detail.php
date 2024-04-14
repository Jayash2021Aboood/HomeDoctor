<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/service.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/service_type.php');

  checkAdminSession();

  $pageTitle = "Detail Service";
  $row = new Service(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $id = $_GET['id'];
      $result = getServiceById($id);

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
    if(isset($_POST['deleteService']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteService($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = "Service Detaild successfuly!";          
          $_SESSION["success"] = "Service Detaild successfuly!";          
          header('Location:'. $PATH_ADMIN_SERVICE .'index.php');
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
                            Detail Service
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
                    <div class="card-header">Service Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <select disabled class="form-select" name="engineer_id" id="engineer_id" required>
                                        <option disabled value="">Select a Engineer:</option>
                                        <?php foreach(getAllEngineers() as $Engineer) { ?>
                                        <option <?php if($row['engineer_id'] == $Engineer['id']) echo "selected" ?> value="<?php echo $Engineer['id']; ?>"> <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (service_type_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_type_id">ServiceType</label>
                                    <select disabled class="form-select" name="service_type_id" id="service_type_id" required>
                                        <option disabled value="">Select a ServiceType:</option>
                                        <?php foreach(getAllServiceTypes() as $ServiceType) { ?>
                                        <option <?php if($row['service_type_id'] == $ServiceType['id']) echo "selected" ?> value="<?php echo $ServiceType['id']; ?>"> <?php echo $ServiceType['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
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
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="Detail"
                                        value="<?php echo $row['detail'];?>" readonly />
                                </div>
                                <!-- Form Group (image)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image">Image</label>
                                    <input class="form-control" id="image" name="image" type="file" placeholder="Image"
                                        value="<?php echo $row['image'];?>" readonly />
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
