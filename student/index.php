<?php
  session_start();
  include('../includes/lib.php');
  error_reporting(0);
  $pageTitle = "Home";


  ?>

<?php include('../template/header.php'); ?>
<?php include('../template/startNavbar.php'); ?>

<main>
    <header class="py-10  mb-4 bg-img-cover overlay overlay-60"
        style="background-image: url('../assets/img/demo/demo-ocean-lg.jpg'); min-height: 500px; height: 500px;">
        <div class="container-xl pt-10  px-4">
            <div class="text-center  z-1">
                <h1 class="text-white">Welcome to Engineer Services Provider</h1>
                <p class="lead mb-0 text-white-50">A passion to deliver the best
                </p>
            </div>
        </div>
    </header>
    <!-- Main page content-->

      <!-- Dashboard info widget 2-->
      <div class="card border-start-lg border-start-pink h-5">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-pink mb-3 text-center">Issue (count)</div>
                                <div class="h5 text-center">
                                <?php echo (select("select count(id) as total from issue WHERE student_id = ".$_SESSION['userID']." ;")[0])['total']; ?>
                                </div>
                                
                            </div>
                           
                        </div>
                    </div>
                </div>


                <div class="card border-start-lg border-start-primary h-5">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1">Total fine </div>
                                <div class="h5">R.S
                                    <?php echo (select("select sum(amount) as total from fine WHERE student_id = ".$_SESSION['userID']." ;")[0]['total']); ?>
                                </div>
                                <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-up"></i>
                                    12%
                                </div>
                            </div>
                            <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
                

                

</main>



<?php include('../template/footer.php') ?>