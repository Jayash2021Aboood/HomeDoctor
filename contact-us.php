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
<main class="page contact-us-page">
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Contact Us</h2>
            </div>
            <form>
                <div class="form-group"><label>Name</label><input class="form-control" type="text"></div>
                <div class="form-group"><label>Subject</label><input class="form-control" type="text"></div>
                <div class="form-group"><label>Email</label><input class="form-control" type="email"></div>
                <div class="form-group"><label>Message</label><textarea class="form-control"></textarea></div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Send</button></div>
            </form>
        </div>
    </section>
</main>
<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php'); ?>