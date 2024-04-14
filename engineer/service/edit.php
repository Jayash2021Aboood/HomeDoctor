<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/service.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/service_type.php');
  checkEngineerSession();

  $pageTitle = "Edit Service";
  //$row = new Service(null);
   $id =  $engineer_id =  $service_type_id =  $name =  $price =  $detail =  $image = $image_old = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getServiceById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $engineer_id = $row['engineer_id'];
        $service_type_id = $row['service_type_id'];
        $name = $row['name'];
        $price = $row['price'];
        $detail = $row['detail'];
        $image = $row['image'];

        if($engineer_id != $_SESSION['userID'])
        {
          redirectToReferer("Access Denied You Dont have permission to access this Link");
        }
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
    if(isset($_POST['updateService']))
    {
        $id = $_POST['id'];
        $engineer_id = $_SESSION['userID'];
        $service_type_id = $_POST['service_type_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $detail = $_POST['detail'];
      $image_old = $_POST['image_old'];
      $image = uploadImage('image', DIR_PHOTOES, $image_old);
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

        $result = getServiceById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
          if($row['engineer_id'] != $_SESSION['userID'])
          {
            redirectToReferer("Access Denied You Dont have permission to Make Changes on this Link");
          }

        $update = updateService( $id,  $engineer_id,  $service_type_id,  $name,  $price,  $detail,  $image, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Service Updated successfuly!";
          $_SESSION["success"] = "Service Updated successfuly!";
          header('Location:'. $PATH_ENGINEER_SERVICE .'index.php');
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
                            Edit Service
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
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (service_type_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="service_type_id">ServiceType</label>
                                    <select class="form-select" name="service_type_id" id="service_type_id" required>
                                        <option disabled value="">Select a ServiceType:</option>
                                        <?php foreach(getAllServiceTypes() as $ServiceType) { ?>
                                        <option <?php if($service_type_id == $ServiceType['id']) echo "selected" ?>
                                            value="<?php echo $ServiceType['id']; ?>">
                                            <?php echo $ServiceType['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="<?php echo $name;?>" required />
                                </div>
                                <!-- Form Group (price)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="price">Price</label>
                                    <input class="form-control" id="price" name="price" type="text" placeholder="Price"
                                        value="<?php echo $price;?>" required />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail">Detail</label>
                                    <input class="form-control" id="detail" name="detail" type="text"
                                        placeholder="Detail" value="<?php echo $detail;?>" required />
                                </div>
                                <!-- Form Group (image)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="image">Image</label>
                                    <input id="image_old" name="image_old" type="hidden" value="<?php echo $image;?>" />
                                    <input class="form-control" id="image" name="image" type="file" placeholder="Image"
                                        value="<?php echo $image;?>" />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="updateService" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>