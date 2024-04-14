<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/section.php');
  include_once('../../includes/section.php');
  checkEmployeeSession();


  
  $pageTitle = lang("Add Section");
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
        $errors[] = "<li>" . lang("Number is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Number is requierd") . "</li>";
        }
      if( empty($name)){
        $errors[] = "<li>" . lang("Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
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
          $_SESSION["message"] = lang("Section Added successfuly!");
          $_SESSION["success"] = lang("Section Added successfuly!");
          header('Location:'. $PATH_EMPLOYEE_SECTION .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Adding Data");
          $_SESSION["fail"] = lang("Error when Adding Data");
          $errors[] = lang("Error when Adding Data");
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
                           <?php echo lang("Add Section"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Sections List"); ?>
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
                    <div class="card-header"><?php echo lang("Section Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (parent_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="parent_id"><?php echo lang("Parent"); ?></label>
                                    <select class="form-select" name="parent_id" id="parent_id" >
                                        <option selected disabled value=""><?php echo lang("Select a Parent"); ?>:</option>
                                        <?php foreach(getAllSections() as $Section) { ?>
                                        <option value="<?php echo $Section['id']; ?>"> <?php echo $Section['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>

                                <!-- Form Group (number)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="number"><?php echo lang("Number"); ?></label>
                                    <input class="form-control" id="number" name="number" type="text" placeholder="<?php echo lang("Number"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="" required  />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addSection" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



