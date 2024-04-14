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

<!-- التأكد من ان طريق الدخول للصفحة عن طريق الرابط وليس عن طريق فورم بيانات -->
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    // التأكد من ان معرف الحدث تم ارسالة في الرابط 
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
    //   جلب تفاصيل الحدث اعتمادا على المعرف وعرضها في الصفحة
      $result = gettblbookingById($id);

      if( count( $result ) > 0)
       {

         $row = $result[0];
       }
      else
      {
        // في حال عدم وجود الحدث تحويلة لصفحة غير موجود
        $_SESSION["message"] = 'There is No data for this id';
        echo ' <script> location.replace("notFound.php"); </script>';
        
      }

      
    }
    else
    {
      $_SESSION["message"] = 'No data for display';
      echo ' <script> location.replace("notFound.php"); </script>';
    }
  }

?>


<!-- محتوى الصفحة -->
<main class="page product-page">
    <section class="clean-block clean-product dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Event Details</h2>
                <p class="text-danger"> <?php echo $_SESSION['message']; ?> </p>
            </div>
            <!-- عرض بيانات الحدث  -->
            <div class="block-content">
                <div class="product-info">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="gallery"><img class="img-fluid d-block mx-auto"
                                    src="<?php if(!empty($row['Photo'])){ echo  $PATH_ADMIN_PHOTOES . $row['Photo'];} else { echo $PATH_ADMIN_PHOTOES .'noImageEvent.jpg'; }?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info">
                                <h3><strong><?php echo($row['Name']);?></strong></h3>
                                <div class="rating"><img
                                        src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img
                                        src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img
                                        src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img
                                        src="assets/img/star-half-empty.svg?h=52643cdf5581ce4b2bc133d700b32857"><img
                                        src="assets/img/star-empty.svg?h=67e3ef1204a154c2af6db4a9eaf69156"></div>
                                <div class="price">
                                    <h3><?php echo($row['Currency'] . $row['Price']);?></h3>
                                </div><a class="btn btn-primary" role="button"
                                    href="payment-page.php?id=<?php echo($row['ID']);?>"><strong>buy
                                        ticket</strong></a>
                                <div class="summary">
                                    <p><?php echo(substr($row['AdditionalInformation'],0,172));?><br><br></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-info">
                    <div>
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item"><a class="nav-link active" role="tab" data-toggle="tab"
                                    id="description-tab" href="#description">Description</a></li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active fade show description" role="tabpanel" id="description">
                                <p><?php echo($row['AdditionalInformation']);?><br><br></p>
                                <div class="row">
                                    <div class="col-md-5">
                                        <figure class="figure"><img class="img-fluid figure-img"
                                                src="<?php if(!empty($row['Photo2'])){ echo  $PATH_ADMIN_PHOTOES . $row['Photo2'];} else { echo $PATH_ADMIN_PHOTOES .'noImageEvent.jpg'; }?>">
                                        </figure>
                                    </div>
                                    <div class="col-md-7">
                                        <h4><strong><?php echo($row['Feature']);?></strong></h4>
                                        <p><?php echo($row['AdditionalInformation2']);?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7 right">
                                        <h4><strong><?php echo($row['Feature2']);?></strong></h4>
                                        <p><?php echo($row['AdditionalInformation3']);?></p>
                                    </div>
                                    <div class="col-md-5">
                                        <figure class="figure"><img class="img-fluid figure-img"
                                                src="<?php if(!empty($row['Photo3'])){ echo  $PATH_ADMIN_PHOTOES . $row['Photo3'];} else { echo $PATH_ADMIN_PHOTOES .'noImageEvent.jpg'; }?>">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                // جلب الاحداث المرتبطة بالحدث وعرضها في الصفحة
                    $all = select("select * from tblbooking limit 3");
                    if(!(count($all) > 0)) return;
                    else{
                ?>
                <div class="clean-related-items">
                    <h3>Related Events</h3>
                    <div class="items">
                        <div class="row justify-content-center">
                            <!-- Start Card -->
                            <?php
                            foreach($all as  $row)
                            {
                            ?>
                            <div class="col-sm-6 col-lg-4">
                                <div class="clean-related-item">
                                    <div class="image"><a href="event-Details.php?id=<?php echo($row['ID']);?>"><img
                                                class="img-fluid d-block mx-auto"
                                                src="<?php if(!empty($row['Photo'])){ echo  $PATH_ADMIN_PHOTOES . $row['Photo'];} else { echo $PATH_ADMIN_PHOTOES .'noImageEvent.jpg'; }?>"></a>
                                    </div>
                                    <div class="related-name"><a
                                            href="event-Details.php?id=<?php echo($row['ID']);?>"><strong><?php echo($row['Name']);?></strong></a>
                                        <div class="rating"><img
                                                src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img
                                                src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img
                                                src="assets/img/star.svg?h=6a5bf50661a8e494efd6f3408b44f8b0"><img
                                                src="assets/img/star-half-empty.svg?h=52643cdf5581ce4b2bc133d700b32857"><img
                                                src="assets/img/star-empty.svg?h=67e3ef1204a154c2af6db4a9eaf69156">
                                        </div>
                                        <h4><?php echo($row['Currency'].$row['Price']);?></h4>
                                    </div>
                                </div>
                            </div>
                            <?php }?>
                            <!-- End Card -->
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </section>
</main>

<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>