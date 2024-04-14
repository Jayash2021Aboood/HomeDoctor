<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/author.php');
  checkEmployeeSession();


  
  $pageTitle = lang("Add Author");
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['addAuthor']))
    {


      $name = $_POST['name'];

      $phone = $_POST['phone'];

      $email = $_POST['email'];

      $address = $_POST['address'];

      $nationality = $_POST['nationality'];

      if( empty($name)){
        $errors[] = "<li>" . lang("Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
        }
  
      if(count($errors) == 0)
      {
        $add = addAuthor(
                                    $name,
                                    $phone,
                                    $email,
                                    $address,
                                    $nationality,
                                    );
        if($add ==  true)
        {
          $_SESSION["message"] = lang("Author Added successfuly!");
          $_SESSION["success"] = lang("Author Added successfuly!");
          header('Location:'. $PATH_EMPLOYEE_AUTHOR .'index.php');
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
                           <?php echo lang("Add Author"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Authors List"); ?>
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
                <!-- Author details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Author Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="" required  />
                                </div>
                                <!-- Form Group (phone)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="phone"><?php echo lang("Phone"); ?></label>
                                    <input class="form-control" id="phone" name="phone" type="tel" placeholder="<?php echo lang("Phone"); ?>"
                                        value=""   />
                                </div>
                                <!-- Form Group (email)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="email"><?php echo lang("Email"); ?></label>
                                    <input class="form-control" id="email" name="email" type="email" placeholder="<?php echo lang("Email"); ?>"
                                        value=""   />
                                </div>
                                <!-- Form Group (address)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="address"><?php echo lang("Address"); ?></label>
                                    <input class="form-control" id="address" name="address" type="text" placeholder="<?php echo lang("Address"); ?>"
                                        value=""   />
                                </div>
                                <!-- Form Group (nationality)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="nationality"><?php echo lang("Nationality"); ?></label>
                                    <input class="form-control" id="nationality" name="nationality" type="text" placeholder="<?php echo lang("Nationality"); ?>"
                                        value=""   />
                                </div>
                            </div>
                            <!-- Submit button-->
                            <button name="addAuthor" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>



