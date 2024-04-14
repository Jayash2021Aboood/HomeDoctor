<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/fine.php');
  include_once('../../includes/issue.php');
  include_once('../../includes/student.php');
  checkAdminSession();

  $pageTitle = lang("Edit Fine");
  //$row = new Fine(null);
   $id =  $issue_id =  $student_id =  $amount =  $state = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getFineById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $issue_id = $row['issue_id'];
        $student_id = $row['student_id'];
        $amount = $row['amount'];
        $state = $row['state'];
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
    if(isset($_POST['updateFine']))
    {
        $id = $_POST['id'];
        $issue_id = $_POST['issue_id'];
        $student_id = $_POST['student_id'];
        $amount = $_POST['amount'];
        $state = $_POST['state'];
      if( empty($issue_id)){
        $errors[] = "<li>" . lang("Issue is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Issue is requierd") . "</li>";
        }
      if( empty($student_id)){
        $errors[] = "<li>" . lang("Student is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Student is requierd") . "</li>";
        }
      if( empty($amount)){
        $errors[] = "<li>" . lang("TotalAmount is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("TotalAmount is requierd") . "</li>";
        }
      if( empty($state)){
        $errors[] = "<li>" . lang("State is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("State is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getFineById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateFine( $id,  $issue_id,  $student_id,  $amount,  $state, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Fine Updated successfuly!");
          $_SESSION["success"] = lang("Fine Updated successfuly!");
          header('Location:'. $PATH_ADMIN_FINE .'index.php');
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
                            <?php echo lang("Edit Fine"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Fines List"); ?>
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
                <!-- Fine details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Fine Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (issue_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="issue_id"><?php echo lang("Issue"); ?></label>
                                    <select class="form-select" name="issue_id" id="issue_id" required>
                                        <option disabled value=""><?php echo lang("Select a Issue"); ?>:</option>
                                        <?php foreach(getAllIssues() as $Issue) { ?>
                                        <option <?php if($issue_id == $Issue['id']) echo "selected" ?>
                                            value="<?php echo $Issue['id']; ?>"> <?php echo $Issue['id']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (student_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="student_id"><?php echo lang("Student"); ?></label>
                                    <select class="form-select" name="student_id" id="student_id" required>
                                        <option disabled value=""><?php echo lang("Select a Student"); ?>:</option>
                                        <?php foreach(getAllStudents() as $Student) { ?>
                                        <option <?php if($student_id == $Student['id']) echo "selected" ?>
                                            value="<?php echo $Student['id']; ?>"> <?php echo $Student['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="amount"><?php echo lang("TotalAmount"); ?></label>
                                    <input class="form-control" id="amount" name="amount" type="text"
                                        placeholder="<?php echo lang("TotalAmount"); ?>" value="<?php echo $amount;?>"
                                        required />
                                </div>
                                <!-- Form Group (state)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="state"><?php echo lang("State"); ?></label>
                                    <input class="form-control" id="state" name="state" type="text"
                                        placeholder="<?php echo lang("State"); ?>" value="<?php echo $state;?>"
                                        required />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <button name="updateFine" class="btn btn-success"
                                type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger"
                                type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>