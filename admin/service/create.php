<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/service.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/service_type.php');
  checkAdminSession();


  
  $pageTitle = "Add Service";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addService']))
    {


      $engineer_id = $_POST['engineer_id'];

      $service_type_id = $_POST['service_type_id'];

      $name = $_POST['name'];

      $price = $_POST['price'];

      $detail = $_POST['detail'];

      $image = uploadImage('image',DIR_PHOTOES);

      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($service_type_id)){
        $errors[] = "<li>ServiceType is requierd.</li>";
        $_SESSION["fail"] .= "<li>ServiceType is requierd.</li>";
        }
      if( empty($name)){
        $errors[] = "<li>Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Name is requierd.</li>";
        }
      if( empty($price)){
        $errors[] = "<li>Price is requierd.</li>";
        $_SESSION["fail"] .= "<li>Price is requierd.</li>";
        }
      if( empty($detail)){
        $errors[] = "<li>Detail is requierd.</li>";
        $_SESSION["fail"] .= "<li>Detail is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addService(
                                    $engineer_id,
                                    $service_type_id,
                                    $name,
                                    $price,
                                    $detail,
                                    $image,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Service Added successfuly!";
          $_SESSION["success"] = "Service Added successfuly!";
          header('Location:'. $PATH_ADMIN_SERVICE .'index.php');
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
                            Add Service
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
                    <div class="card-header">Service Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <select class="form-select" name="engineer_id" id="engineer_id" required>
                                        <option selected disabled value="">Select a Engineer:</option>
                                        <?php foreach(getAllEngineers() as $Engineer) { ?>
                                        <option value="<?php echo $Engineer['id']; ?>">
                                            <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (service_type_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_type_id">ServiceType</label>
                                    <select class="form-select" name="service_type_id" id="service_type_id" required>
                                        <option selected disabled value="">Select a ServiceType:</option>
                                        <?php foreach(getAllServiceTypes() as $ServiceType) { ?>
                                        <option value="<?php echo $ServiceType['id']; ?>">
                                            <?php echo $ServiceType['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="" required />
                                </div>
                                <!-- Form Group (price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="price">Price</label>
                                    <input class="form-control" id="price" name="price" type="text" placeholder="Price"
                                        value="" required />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail">Detail</label>
                                    <input class="form-control" id="detail" name="detail" type="text"
                                        placeholder="Detail" value="" required />
                                </div>
                                <!-- Form Group (image)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image">Image</label>
                                    <input class="form-control" id="image" name="image" type="file" placeholder="Image"
                                        value="" />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addService" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>