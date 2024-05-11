<?php
  session_start();
  include('../includes/lib.php');
  $pageTitle = "Home";

  checkNurseSession();
  ?>

<?php include('../template/header.php'); ?>


<?php include('../template/startNavbar.php'); ?>


<main>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-5">
        <!-- Custom page header alternative example-->
        <div class="d-flex justify-content-between align-items-sm-center flex-column flex-sm-row mb-4">
            <div class="me-4 mb-3 mb-sm-0">
                <h1 class="mb-0"><?php echo lang("Dashboard"); ?></h1>
                <div class="small">
                    <span class="fw-500 text-primary">Friday</span>
                    · September 20, 2021 · 12:16 PM
                </div>
            </div>
            <!-- Date range picker example-->
            <div class="input-group input-group-joined border-0 shadow" style="width: 16.5rem">
                <span class="input-group-text"><i data-feather="calendar"></i></span>
                <input class="form-control ps-0 pointer" id="litepickerRangePlugin"
                    placeholder="Select date range..." />
            </div>
        </div>
        <!-- Illustration dashboard card example-->
        <div class="card card-waves mb-4 mt-5">
            <div class="card-body p-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col">
                        <h2 class="text-primary">Welcome back, your dashboard is ready!</h2>
                        <p class="text-gray-700">Great job, your affiliate dashboard is ready to go! You can view sales,
                            generate links, prepare coupons, and download affiliate reports using this dashboard.</p>
                        <a class="btn btn-primary p-3" href="#!">
                            Get Started
                            <i class="ms-1" data-feather="arrow-right"></i>
                        </a>
                    </div>
                    <div class="col d-none d-lg-block mt-xxl-n4"><img class="img-fluid px-xl-4 mt-xxl-n5"
                            src="<?php echo $PATH_SERVER ?>assets/img/illustrations/statistics.svg" /></div>
                </div>
            </div>
        </div>
        <?php $nurse_id = $_SESSION['userID']; ?>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1"><?php echo lang("Earnings Money"); ?></div>
                                <div class="h5">R.S
                                <?php echo (select("select sum(price) as total from appointment WHERE nurse_id =$nurse_id and state ='accept';")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-success d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-up"></i>
                                    12%
                                </div> -->
                            </div>
                            <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard orange widget 2-->
                <div class="card border-start-lg border-start-orange h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-orange mb-3 text-center"><?php echo lang("Appointments"); ?>  (count)</div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from appointment where nurse_id=$nurse_id ;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard orange widget 2-->
                <div class="card border-start-lg border-start-orange h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-orange mb-3 text-center"><?php echo lang("Pending Appointments"); ?></div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from appointment where nurse_id=$nurse_id and state like 'request' ;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard orange widget 2-->
                <div class="card border-start-lg border-start-orange h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-orange mb-3 text-center"><?php echo lang("Rejected Appointments"); ?></div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from appointment where nurse_id=$nurse_id and state like 'reject' ;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <!-- Dashboard orange widget 2-->
                <div class="card border-start-lg border-start-orange h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-orange mb-3 text-center"><?php echo lang("Accepted Appointments"); ?></div>
                                <div class="h5 text-center">
                                    <?php echo (select("select count(id) as total from appointment where nurse_id=$nurse_id and state like 'accept' ;")[0])['total']; ?>
                                </div>
                                <!-- <div class="text-xs fw-bold text-danger d-inline-flex align-items-center">
                                    <i class="me-1" data-feather="trending-down"></i>
                                    3%
                                </div> -->
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-tag fa-2x text-gray-200"></i></div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>


<?php include('../template/footer.php') ?>