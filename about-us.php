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
    <section class="clean-block about-us">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">About Us</h2>
                <p>We host the best events for you with proper management Controlling chaos is what event management is
                    all about. There’s a lot to manage with conferences, marketing events, and similar productions.
                    Fortunately, today’s best event management processes help you with every aspect of your event
                    journey.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-lg-4">
                    <div class="card clean-card text-center">
                        <div class="card-body info">
                            <h4 class="card-title"><strong>Office locations</strong><br></h4>
                            <p class="card-text"><br>To best support our growing global customer base, we have both
                                remote and in-person office locations around the world.<br><br></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card clean-card text-center">
                        <div class="card-body info">
                            <h4 class="card-title">FEATURED<br></h4>
                            <p class="card-text">all thing to Event Management all thing to Event Management all thing
                                to Event Management<br></p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card clean-card text-center">
                        <div class="card-body info">
                            <h4 class="card-title"><strong>How KSA event can help you</strong><br></h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>