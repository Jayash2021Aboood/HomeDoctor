<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/service_type.php');
  checkAdminSession();


  
  $pageTitle = "Add ServiceType";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addServiceType']))
    {


      $name = $_POST['name'];

      $detail = $_POST['detail'];

      if( empty($name)){
        $errors[] = "<li>Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Name is requierd.</li>";
        }
      if( empty($detail)){
        $errors[] = "<li>Detail is requierd.</li>";
        $_SESSION["fail"] .= "<li>Detail is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addServiceType(
                                    $name,
                                    $detail,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "ServiceType Added successfuly!";
          $_SESSION["success"] = "ServiceType Added successfuly!";
          header('Location:'. $PATH_ADMIN_SERVICETYPE .'index.php');
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
                            Add ServiceType
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to ServiceTypes List
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
                <!-- ServiceType details card-->
                <div class="card mb-4">
                    <div class="card-header">ServiceType Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="" required  />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail">Detail</label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="Detail"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addServiceType" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



