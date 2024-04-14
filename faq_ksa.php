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
<main class="page faq-page">
    <section class="clean-block clean-faq dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">FAQ</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                    mattis vitae leo.</p>
            </div>
            <div class="block-content">
                <div class="faq-item">
                    <h4 class="question">Question 1</h4>
                    <div class="answer">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor
                            in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor
                            in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <h4 class="question"><strong>Question 2</strong><br></h4>
                    <div class="answer">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor
                            in, mattis vitae leo.</p>
                    </div>
                </div>
                <div class="faq-item">
                    <h4 class="question"><strong>Question 3</strong><br></h4>
                    <div class="answer">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor
                            in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.&nbsp;Lorem
                            ipsum dolor sit amet, consectetur adipiscing
                            elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>