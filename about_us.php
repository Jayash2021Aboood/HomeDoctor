<?php
  session_start();
  include('includes/lib.php');
  $pageTitle = "About Us";

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
                        <h1 class="text-primary">About Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">
            <div class="col-md-8 col-lg-8 col-xl-8  mb-4 mb-xl-3 m-auto">
                <div class="card">
                    <div class="card-body text-center pt-5 pb-5">
                        <h3 class="mb-4">Mission</h3>
                        <p class="mb-4">Providing our clients with innovative solutions and designs with an emphasis on
                            quality and costs. Our dedicated staff is committed to the highest professional standards in
                            serving our clients. We intend to be at the forefront of engineering service providers.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-xl-8 mb-4 mb-xl-3 m-auto">
                <div class="card">
                    <div class="card-body text-center pt-5 pb-5">
                        <h3 class="mb-4">Vision</h3>
                        <p class="mb-4">Our mission supports and directs our vision to be at the forefront of providing
                            advisory services in line with and supports the Kingdom's Vision 2030, and we strive to
                            achieve this by following the following principles:
                            Our customers are the most important and precious thing we have at all, and we are committed
                            to achieving their requirements.
                            Our highly trained and experienced professional and technical staff are our most important
                            and valuable resource, and we will support their goals and aspirations.
                            Our projects will be executed using the highest standards in engineering, architecture and
                            management practice, with an emphasis on quality, integrity, costs, responsiveness and
                            timing.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>


<?php include('template/footer.php') ?>