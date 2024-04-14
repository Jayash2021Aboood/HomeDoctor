<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/setting.php');
  checkEmployeeSession();

  $pageTitle = lang("Update Setting");
  //$row = new Setting(null);
   $id =  $return_days =  $fine_amount =  $student_max_issue = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
      $_SESSION["message"] = '';
      $result = GetSetting();

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $return_days = $row['return_days'];
        $fine_amount = $row['fine_amount'];
        $student_max_issue = $row['student_max_issue'];
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
                            <?php echo lang("Setting Screen"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Setting details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Setting Data"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (return_days)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1"
                                        for="return_days"><?php echo lang("Return Days"); ?></label>
                                    <input class="form-control" id="return_days" name="return_days" type="text"
                                        placeholder="<?php echo lang("Return Days"); ?>"
                                        value="<?php echo $return_days;?>" required />
                                </div>
                                <!-- Form Group (fine_amount)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1"
                                        for="fine_amount"><?php echo lang("Fine Amount"); ?></label>
                                    <input class="form-control" id="fine_amount" name="fine_amount" type="text"
                                        placeholder="<?php echo lang("Fine Amount"); ?>"
                                        value="<?php echo $fine_amount;?>" required />
                                </div>
                                <!-- Form Group (student_max_issue)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1"
                                        for="student_max_issue"><?php echo lang("Student Max Issues"); ?></label>
                                    <input class="form-control" id="student_max_issue" name="student_max_issue"
                                        type="text" placeholder="<?php echo lang("Student Max Issues"); ?>"
                                        value="<?php echo $student_max_issue;?>" required />
                                </div>

                            </div>
                            <!-- Submit button-->
                            <a href="../index.php" class="btn btn-danger"
                                type="button"><?php echo lang("Back To Home"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>