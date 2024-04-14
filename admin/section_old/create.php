<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/section.php');
  include_once('../../includes/section.php');
  checkAdminSession();


  
  $pageTitle = "Add Section";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addSection']))
    {


      $parent_id = $_POST['parent_id'];

      $number = $_POST['number'];

      $name = $_POST['name'];

      if( empty($number)){
        $errors[] = "<li>Number is requierd.</li>";
        $_SESSION["fail"] .= "<li>Number is requierd.</li>";
        }
      if( empty($name)){
        $errors[] = "<li>Name is requierd.</li>";
        $_SESSION["fail"] .= "<li>Name is requierd.</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addSection(
                                    $parent_id,
                                    $number,
                                    $name,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = "Section Added successfuly!";
          $_SESSION["success"] = "Section Added successfuly!";
          header('Location:'. $PATH_ADMIN_SECTION .'index.php');
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
                            Add Section
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Back to Sections List
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
                <!-- Section details card-->
                <div class="card mb-4">
                    <div class="card-header">Section Details</div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (parent_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="parent_id">Parent</label>
                                    <select class="form-select" name="parent_id" id="parent_id">
                                        <option selected disabled value="">Select a Parent:</option>
                                        <?php foreach(getAllSections() as $Section) { ?>
                                        <option value="<?php echo $Section['id']; ?>">
                                            <?php echo $Section['number'] .' - '. $Section['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (number)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="number">Number</label>
                                    <input class="form-control" id="number" name="number" type="text"
                                        placeholder="Number" value="" required />
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name">Name</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Name"
                                        value="" required />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addSection" class="btn btn-success" type="submit">Save</button>
                            <a href="index.php" class="btn btn-danger" type="button">Back To List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>