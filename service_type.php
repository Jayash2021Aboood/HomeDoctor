<?php
  session_start();
  include('includes/lib.php');
  include('includes/service_type.php');
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
                        <h1 class="text-primary">Services Categories </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">
            <?php
            // جلب  صفوف من جدول انواع الخدمات لعرضها في الصفحة
                $all = getAllServiceTypes();
                if(!(count($all) > 0)) return;
                else{
                    // في حال ان الصفوف موجوده يتم عرضها 
                    foreach($all as  $row)
                    {
             ?>
            <div class="col-md-6 col-xl-4 mb-4 mt-3 mb-xl-0">
                <div class="card">
                    <div class="card-body text-center pt-5 pb-5">
                        <h3 class="mb-4"><?php echo $row['name']; ?></h3>
                        <p class="mb-4"><?php echo $row['detail']; ?></p>
                        <a href="service_list.php?service_type_id=<?php echo $row['id']; ?>"
                            class="btn btn-primary">Show
                            Service </a>
                    </div>
                </div>
            </div>
            <?php }}?>

        </div>
    </div>
</main>


<?php include('template/footer.php') ?>