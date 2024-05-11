<?php
  session_start();
  include('includes/lib.php');
  $pageTitle = "Home";

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main class="mt-1">
    <header class="d-md-block py-10  mb-4 bg-img-cover px-sm-0">
        <!-- style="background-image: url('assets/img/backgrounds/library3.jpeg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;"> -->
        <div class="container-xl p-0 ">
            <div class="text-center  z-1 mb-0">
                <h1 class=" z-2"><?php echo lang("Welcome to Home Doctor"); ?></h1>
                <p class="lead mb-0 px-10 z-2"><?php echo lang("The home doctor welcomes you with a simple and comfortable design that reflects the spirit of comfort and health care. Includes basic information about your home doctor's services, including a schedule of available appointments and the services they provide, such as routine examinations and home treatments. The website also provides an easy way to book appointments via a simple form that can be filled out online. The site seeks to provide a smooth and reliable user experience for patients who prefer to receive medical care in the comfort of their homes."); ?>
                </p>

            </div>
        </div>
    </header>

    <div class="container-xl px-4 px-sm-0">
        <div class="row justify-content-center">
            <a class="btn btn-success btn-sm col-6" href="login.php"><?php echo lang('Login'); ?> →</a>
        </div>
        <div class="row justify-content-center mt-2">
            <a class="btn btn-success btn-sm col-3 m-1" href="nurseSignin.php"><?php echo lang('Create Nurse Account'); ?> →</a>
            <a class="btn btn-success btn-sm col-3 m-1" href="doctorSignin.php"><?php echo lang('Create Doctor Account'); ?> →</a>
            <a class="btn btn-success btn-sm col-3 m-1" href="patientSignin.php"><?php echo lang('Create Patient Account'); ?> →</a>
        </div>
    </div>
</main>







<?php include('template/footer.php') ?>