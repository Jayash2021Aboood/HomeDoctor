<?php
  session_start();
  include('includes/lib.php');
  include('includes/engineer.php');
  $pageTitle = "Engineers List";

  ?>

<?php include('template/header.php'); ?>



<?php include('template/startNavbar.php'); ?>

<!-- محتوى الصفحة -->
<main class="page">

    <header class="py-10 mb-0 ">
        <div class="container-xl px-4 text-center">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-primary">Our Engineers</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">

            <?php

                $all = getAllEngineersWithRatesAndServiceTotals();
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Service Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $row)
                    {
                ?>

            <?php
                $total_service = $row['total_service'];
                $total_rate = $row['total_rate'];
            ?>

            <div class="col-lg-4 mb-4">
                <!-- Knowledge base category card 5-->
                <a class="card card-progress lift lift-sm border-start-lg border-start-secondary"
                    href="engineer.php?id=<?php echo $row['id'] ?>">
                    <div class="card-body">
                        <h5 class="card-title text-secondary">
                            <i class="me-2" data-feather="user"></i>
                            <?php echo $row['first_name'].' '. $row['last_name'] ; ?>
                        </h5>
                        <p class="card-text"><?php echo $row['specialty']; ?></p>
                    </div>
                    <div class="card-text">
                    </div>
                    <div class="card-footer">
                        <div class="small text-muted"><?php echo $total_service; ?> Services</div>

                    </div>

                    <div class="progress rounded-0">
                        <div class="progress-bar bg-<?php echo getRateColor($total_rate); ?>" role="progressbar"
                            style="width: <?php echo $total_rate ?>%" aria-valuenow="<?php echo $total_rate ?>"
                            aria-valuemin="0" aria-valuemax="100"><?php echo floor($total_rate) ?>%</div>
                    </div>
                </a>
            </div>
            <?php }}?>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>