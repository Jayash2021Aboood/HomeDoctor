<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/language.php');
  checkAdminSession();

  $pageTitle = lang("Edit Language");
  //$row = new Language(null);
   $id =  $name =  $code = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getLanguageById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $name = $row['name'];
        $code = $row['code'];
      }
      else
      {
        $_SESSION["message"] = lang('There is No data for this id');
        $_SESSION["fail"] = lang('There is No data for this id');
      }

    }
    else
    {
      $_SESSION["message"] = lang('No data for display');
      $_SESSION["fail"] = lang('No data for display');
      
    }
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateLanguage']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $code = $_POST['code'];
      if( empty($name)){
        $errors[] = "<li>" . lang("Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
        }
      if( empty($code)){
        $errors[] = "<li>" . lang("Code is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Code is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getLanguageById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateLanguage( $id,  $name,  $code, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Language Updated successfuly!");
          $_SESSION["success"] = lang("Language Updated successfuly!");
          header('Location:'. $PATH_ADMIN_LANGUAGE .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Update Data");
          $_SESSION["fail"] = lang("Error when Update Data");
          $errors[] = lang("Error when Update Data");
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
                            <?php echo lang("Edit Language"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Languages List"); ?>
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
                <!-- Language details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Language Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="<?php echo $name;?>" required />
                                </div>
                                <!-- Form Group (code)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="code"><?php echo lang("Code"); ?></label>
                                    <input class="form-control" id="code" name="code" type="text" placeholder="<?php echo lang("Code"); ?>"
                                        value="<?php echo $code;?>" required />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateLanguage" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

