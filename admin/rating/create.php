<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/rating.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/customer.php');
  checkAdminSession();


  
  $pageTitle = "Add Rating";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addRating']))
    {


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
        $add = addRating(
                                    $engineer_id,
                                    $customer_id,
                                    $rate,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Rating Added successfuly!";
          $_SESSION["success"] = "Rating Added successfuly!";
          header('Location:'. $PATH_ADMIN_RATING .'index.php');
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
                            Add Rating
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
                    <div class="card-header">Rating Details</div>
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
                                        <option value="<?php echo $Engineer['id']; ?>"> <?php echo $Engineer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (customer_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="customer_id">Customer</label>
                                    <select class="form-select" name="customer_id" id="customer_id" required>
                                        <option selected disabled value="">Select a Customer:</option>
                                        <?php foreach(getAllCustomers() as $Customer) { ?>
                                        <option value="<?php echo $Customer['id']; ?>"> <?php echo $Customer['first_name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (rate)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="rate">Rate</label>
                                    <input class="form-control" id="rate" name="rate" type="text" placeholder="Rate"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addRating" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



