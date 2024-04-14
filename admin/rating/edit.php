<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/rating.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/customer.php');
  checkAdminSession();

  $pageTitle = "Edit Rating";
  //$row = new Rating(null);
   $id =  $engineer_id =  $customer_id =  $rate = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getRatingById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $engineer_id = $row['engineer_id'];
        $customer_id = $row['customer_id'];
        $rate = $row['rate'];
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
    if(isset($_POST['updateRating']))
    {
        $id = $_POST['id'];
        $engineer_id = $_POST['engineer_id'];
        $customer_id = $_POST['customer_id'];
        $rate = $_POST['rate'];
      if( empty($engineer_id)){
        $errors[] = "<li>Engineer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Engineer is requierd.</li>";
        }
      if( empty($customer_id)){
        $errors[] = "<li>Customer is requierd.</li>";
        $_SESSION["fail"] .= "<li>Customer is requierd.</li>";
        }
      if( empty($rate)){
        $errors[] = "<li>Rate is requierd.</li>";
        $_SESSION["fail"] .= "<li>Rate is requierd.</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getRatingById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateRating( $id,  $engineer_id,  $customer_id,  $rate, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = "Rating Updated successfuly!";
          $_SESSION["success"] = "Rating Updated successfuly!";
          header('Location:'. $PATH_ADMIN_RATING .'index.php');
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
                            Edit Rating
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Ratings List
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
                <!-- Rating details card-->
                <div class="card mb-4">
                    <div class="card-header">Rating Details </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (engineer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="engineer_id">Engineer</label>
                                    <select class="form-select" name="engineer_id" id="engineer_id" required>
                                        <option disabled value="">Select a Engineer:</option>
                                        <?php foreach(getAllEngineers() as $Engineer) { ?>
                                        <option <?php if($engineer_id == $Engineer['id']) echo "selected" ?> value="<?php echo $Engineer['id']; ?>"> <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id">Customer</label>
                                    <select class="form-select" name="customer_id" id="customer_id" required>
                                        <option disabled value="">Select a Customer:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option <?php if($customer_id == $Customer['id']) echo "selected" ?> value="<?php echo $Customer['id']; ?>"> <?php echo $Customer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (rate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="rate">Rate</label>
                                    <input class="form-control" id="rate" name="rate" type="text" placeholder="Rate"
                                        value="<?php echo $rate;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateRating" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

