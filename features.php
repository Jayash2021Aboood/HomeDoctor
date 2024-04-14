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
<main class="page">
    <section class="clean-block features" style="padding-bottom: 0px;">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Features</h2>
                <p>We manage the services, activities and personal events of institutions and companies with the highest
                    standards of comfort, safety and discipline to make your life better.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5 feature-box"><i class="icon-settings icon"></i>
                    <h4>Event Management</h4>
                    <p>
                        Managing events, events and performances using modern technical means.</p>
                </div>
                <div class="col-md-5 feature-box"><i class="fas fa-audio-description icon"></i>
                    <h4>Ads for Event</h4>
                    <p>We provide services on the latest events in the site and display details of important events such
                        as pictures and prices in a simple way to customers.</p>
                </div>
                <div class="col-md-5 feature-box"><i class="typcn typcn-ticket icon"></i>
                    <h4>Buy tickets</h4>
                    <p>Providing seat purchase and reservation services by purchasing tickets through the website and
                        electronic payment.</p>
                </div>
                <div class="col-md-5 feature-box"><i class="material-icons icon">place</i>
                    <h4>Information places</h4>
                    <p>Providing information about the venues for holding events, performances and events, and providing
                        information that helps customers to reach places and choose the most appropriate places for
                        them.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>