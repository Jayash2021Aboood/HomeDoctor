<?php
  session_start();
  include('includes/lib.php');
  $pageTitle = "About Us";

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<!-- محتوى الصفحة -->
<main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content pt-4">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto mt-4">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="life-buoy"></i></div>
                            FAQ! Need Help ?
                        </h1>
                        <div class="page-header-subtitle">What are you looking for? Our knowledge base is here to help.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4">
        <h4 class="mb-0 mt-5">Main Categories</h4>
        <hr class="mt-2 mb-4" />
        <!-- Knowledge base main category card 1-->
        <a class="card card-icon lift lift-sm mb-4" href="#">
            <div class="row g-0">
                <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="compass"></i>
                </div>
                <div class="col">
                    <div class="card-body py-4">
                        <h5 class="card-title text-primary mb-2">What is the purpose of the platform?</h5>
                        <p class="card-text mb-1">It is a platform that acts as an intermediary between the engineer and
                            the client wishing to obtain services, providing the client with extensive services and
                            competitive prices, and the possibility of benefiting from the services of independent
                            engineers, engineers can benefit from a permanent source of job opportunities in the field
                            of engineering part-time and full-time.</p>
                        <div class="small text-muted">5 articles in this category</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- Knowledge base main category card 2-->
        <a class="card card-icon lift lift-sm mb-4" href="#">
            <div class="row g-0">
                <div class="col-auto card-icon-aside bg-secondary"><i class="text-white-50" data-feather="users"></i>
                </div>
                <div class="col">
                    <div class="card-body py-4">
                        <h5 class="card-title text-secondary mb-2">How do I change my password?</h5>
                        <p class="card-text mb-1">Go to Manage Profiles and change the password. In case you forget your
                            password, please reset your password from the home page by providing your username or email
                            address with which you registered..</p>
                        <div class="small text-muted">3 articles in this category</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- Knowledge base main category card 3-->
        <a class="card card-icon lift lift-sm mb-4" href="#">
            <div class="row g-0">
                <div class="col-auto card-icon-aside bg-teal"><i class="text-white-50" data-feather="book"></i></div>
                <div class="col">
                    <div class="card-body py-4">
                        <h5 class="card-title text-teal mb-2">How are the financial transactions between the service
                            applicant and the service provider?</h5>
                        <p class="card-text mb-1">The platform is an intermediary linking a requester and a service
                            provider to perform the required engineering tasks and has no relation to financial
                            transfers between the two parties.</p>
                        <div class="small text-muted">7 articles in this category</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- Knowledge base main category card 4-->
        <a class="card card-icon lift lift-sm mb-4" href="#">
            <div class="row g-0">
                <div class="col-auto card-icon-aside bg-primary"><i class="text-white-50" data-feather="compass"></i>
                </div>
                <div class="col">
                    <div class="card-body py-4">
                        <h5 class="card-title text-primary mb-2">Do I file taxes for my project engineer?</h5>
                        <p class="card-text mb-1">You are not responsible for filing taxes for field engineers who work
                            on our platform. The individual or entity is obligated to report earnings and prepare the
                            Internal Revenue Service. As for preparing reports, it is our responsibility.</p>
                        <div class="small text-muted">5 articles in this category</div>
                    </div>
                </div>
            </div>
        </a>
        <!-- Knowledge base rating-->
        <div class="text-center mt-5">
            <h4 class="mb-3">Was this page helpful?</h4>
            <div class="mb-3">
                <button class="btn btn-primary mx-2 px-3" role="button">
                    <i class="me-2" data-feather="thumbs-up"></i>
                    Yes
                </button>
                <button class="btn btn-primary mx-2 px-3" role="button">
                    <i class="me-2" data-feather="thumbs-down"></i>
                    No
                </button>
            </div>
            <div class="text-small text-muted"><em>29 people found this page helpful so far!</em></div>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>