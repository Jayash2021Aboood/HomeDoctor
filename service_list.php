<?php
  session_start();
  include('includes/lib.php');
  include('includes/service.php');
  $pageTitle = "Categories";

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
                        <h1 class="text-primary">Our Services</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">

            <?php
            // اذا تم ارسال معرف نوع الحدث يتم اظهار جميع الاحداث من هذا النوع
            //  واذا لم يتم ارسال المعرف للنوع يتم جلب جميع الاحداث وعرضها
                    if(isset($_GET['service_type_id']) && !empty($_GET['service_type_id']))
                        $all = getAllServicesByTypeID($_GET['service_type_id']);
                    else
                        $all = getAllServices();
                    if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Service Found To Display. </h2></div>'; 
                    else{ 
                        foreach($all as  $row)
                        {
                ?>

            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <div class="card border-start-lg border-start-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class=" fs-3 fw-bold text-primary mb-1"><?php echo $row['name']; ?></div>
                                <div class="h5">R.S <?php echo $row['price']; ?></div>
                                <div class="text-xs fw-bold d-inline-flex align-items-center">
                                    <?php echo $row['detail']; ?>
                                </div>
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div> -->
                        </div>
                        <div>
                            <a class="btn btn-primary mt-2"
                                href="<?php echo $PATH_CUSTOMER; ?>service.php?id=<?php echo $row['id']; ?>"> Book now
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <?php }}?>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>