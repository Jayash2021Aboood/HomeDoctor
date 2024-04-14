<?php
// لاستخدام الجلسات في الصفحة 
  session_start();
  //    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');
  $pageTitle = "KsaEvent";

  ?>

<!-- استدعاء رأس الصفحة -->
<?php include('template/header.php'); ?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>


<!-- محتوى الصفحة -->
<main class="page service-page">
    <section class="clean-block clean-services dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Event list</h2>
                <p>The list of events and activities that we provide it and manage it as your needed.</p>
            </div>

            <!-- Start Card -->
            <?php
            // اذا تم ارسال معرف نوع الحدث يتم اظهار جميع الاحداث من هذا النوع
            //  واذا لم يتم ارسال المعرف للنوع يتم جلب جميع الاحداث وعرضها
                    if(isset($_GET['eventTypeId']) && !empty($_GET['eventTypeId']))
                        $all = gettblbookingByEventTypeID($_GET['eventTypeId']);
                    else
                        $all = getAlltblbookings();
                    if(!(count($all) > 0)) echo /*html*/'<div class="block-heading"> <h2 class="text-danger" >No Events Found To Display. </h2></div>'; 
                    else{ 
                ?>
            <div class="row">
                <?php
                    foreach($all as  $row)
                    {
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card"><img class="card-img-top w-100 d-block"
                            src="<?php if(!empty($row['Photo'])){ echo  $PATH_ADMIN_PHOTOES . $row['Photo'];} else { echo $PATH_ADMIN_PHOTOES .'noImageEvent.jpg'; }?>"
                            alt="<?php echo $row['Photo'];?>">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo($row['Name']);?><br></h4>
                            <p class="card-text"><?php echo($row['AdditionalInformation']);?></p>
                        </div>
                        <div><a class="btn btn-outline-primary btn-sm" role="button"
                                href="event-Details.php?id=<?php echo($row['ID']);?>"
                                style="margin: 25px;"><strong>Learn More</strong></a></div>
                    </div>
                </div>
                <?php }}?>
                <!-- End Card -->
            </div>
        </div>
    </section>
</main>
<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>