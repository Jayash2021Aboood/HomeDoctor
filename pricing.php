<?php
  session_start();
  include('includes/lib.php');
  $pageTitle = "KsaEvent";

  ?>

<?php include('template/header.php'); ?>
<?php include('template/navbar.php'); ?>
<main class="page pricing-table-page">
    <section class="clean-block clean-pricing dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Pricing Event</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                    mattis vitae leo.</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5 col-lg-4">
                    <div class="clean-pricing-item">
                        <div class="heading">
                            <h3>NORMAL<br></h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="features">
                            <h4><span class="feature">Full Support:&nbsp;</span><span>No</span></h4>
                            <h4><span class="feature"><strong>another&nbsp;services:</strong><br></span><span>No</span>
                            </h4>
                        </div>
                        <div class="price">
                            <h4>$25</h4>
                        </div><a class="btn btn-outline-primary btn-block" role="button" href="payment-page.html">BUY
                            NOW</a>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="clean-pricing-item">
                        <div class="ribbon"><span>Best Value</span></div>
                        <div class="heading">
                            <h3>moderate<br></h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="features">
                            <h4><span class="feature">Full Support:&nbsp;</span><span>Yes</span></h4>
                            <h4><span
                                    class="feature"><strong>another&nbsp;services:&nbsp;</strong><br></span><span>no</span>
                            </h4>
                        </div>
                        <div class="price">
                            <h4>$50</h4>
                        </div><a class="btn btn-primary btn-block" role="button" href="payment-page.html">BUY NOW</a>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="clean-pricing-item">
                        <div class="heading">
                            <h3>VIP<br></h3>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <div class="features">
                            <h4><span class="feature">Full Support:&nbsp;</span><span>Yes</span></h4>
                            <h4><span
                                    class="feature"><strong>another&nbsp;services:&nbsp;</strong><br></span><span>yes</span>
                            </h4>
                        </div>
                        <div class="price">
                            <h4>$150</h4>
                        </div><a class="btn btn-outline-primary btn-block" role="button" href="payment-page.html">BUY
                            NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('template/footer.php') ?>