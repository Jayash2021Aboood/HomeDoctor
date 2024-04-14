<?php
// لاستخدام الجلسات في الصفحة 
  session_start();

  //    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');
  $pageTitle = "Home Page";

  ?>

<!-- استدعاء رأس الصفحة -->
<?php include('template/header.php'); ?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>


<!-- محتوى الصفحة -->
<main class="page landing-page">
    <section class="clean-block clean-hero"
        style="background-image: url(&quot;assets/img/tech/image4.jpg?h=0adc0de9a17a7caea6b8641f5d6ae02c&quot;);color: rgba(9, 162, 255, 0.85);height: 502px;background-size: auto;">
        <div class="border-white text" style="height: 200px;">
            <h2>ESP Event Management System<br></h2>
            <p>We host the best events for you with proper management Controlling chaos is what event management is
                all about. There’s a lot to manage with conferences, marketing events, and similar productions.
                Fortunately, today’s best event management
                processes help you with every aspect of your event journey.<br><br></p>
        </div>
    </section>
    <section class="clean-block clean-info dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">What we organize<br></h2>
                <p>event management system software website that manage an events.
                    The&nbsp;website&nbsp;&nbsp;provides most of the basic functionality required for an event</p>

            </div>
            <!-- Start Card -->
            <?php
            // جلب 5 صفوف من جدول انواع الاحداث لعرضها في الصفحة
                $all = getAlltbleventtypes(5);
                if(!(count($all) > 0)) return;
                else{
                    // في حال ان الصفوف موجوده يتم عرضها 
                    foreach($all as  $row)
                    {
            ?>
            <div class="row align-items-center">
                <div class="col-md-6"><img class="img-thumbnail"
                        src="<?php if(!empty($row['Photo'])){ echo  $PATH_ADMIN_EVENT_TYPE_PHOTOES . $row['Photo'];} else { echo $PATH_ADMIN_EVENT_TYPE_PHOTOES .'noImageEvent.jpg'; }?>">
                </div>
                <div class="col-md-6">
                    <h3><?php echo $row['EventType'] ?><br></h3>
                    <div class="getting-started-info">
                        <p><?php echo $row['Description'] ?><br><br></p>
                    </div><a class="btn btn-outline-primary btn-lg" role="button"
                        href="event-list.php?eventTypeId=<?php echo $row['ID']; ?>">show
                        Now</a>
                </div>
            </div>
            <?php }} ?>
            <!-- End Card -->
        </div>
    </section>

    <!-- عرض المميزات التي نقدمها -->
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