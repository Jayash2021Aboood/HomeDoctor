<?php
  session_start();
  include('includes/lib.php');
  $pageTitle = "KsaEvent";

  ?>

<?php include('template/header.php'); ?>
<?php include('template/navbar.php'); ?>

<main class="page blog-post-list">
    <section class="clean-block clean-blog-list dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">place List</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in,
                    mattis vitae leo.</p>
            </div>
            <div class="block-content">
                <div class="clean-blog-post">
                    <div class="row">
                        <div class="col-lg-5"><img class="rounded img-fluid"
                                src="assets/img/2222.jpg?h=81fdd89f16afd6c12786a06a000e77b1"></div>
                        <div class="col-lg-7">
                            <h3>place 1</h3>
                            <div class="info"><span class="text-muted">Jan 16, 2022 by&nbsp;<a href="#">user
                                        name</a></span></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                                auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc quam urna, dignissim nec auctor in, mattis
                                vitae leo.</p><a class="btn btn-outline-primary btn-sm" role="button"
                                href="placeinfo.html">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="clean-blog-post">
                    <div class="row">
                        <div class="col-lg-5"><img class="rounded img-fluid"
                                src="assets/img/Saudi-Arabia-Riyadh.jpg?h=e885dc9a54b5748e29057962584cd985"></div>
                        <div class="col-lg-7">
                            <h3><strong>place 2</strong><br></h3>
                            <div class="info"><span class="text-muted">Jan 16, 2022 by&nbsp;<a href="#">user
                                        name<br></a></span></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                                auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc quam urna, dignissim nec auctor in, mattis
                                vitae leo.</p><a class="btn btn-outline-primary btn-sm" role="button"
                                href="placeinfo.html">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="clean-blog-post">
                    <div class="row">
                        <div class="col-lg-5"><img class="rounded img-fluid"
                                src="assets/img/avatars/wedevent.jpg?h=644f3c5f3a99612645eae18ae5b19e68"></div>
                        <div class="col-lg-7">
                            <h3><strong>place 3</strong><br></h3>
                            <div class="info"><span class="text-muted">Jan 16, 2022 by&nbsp;<a href="#"><span
                                            style="text-decoration: underline;">user name</span><br></a>
                                </span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                                auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Nunc quam urna, dignissim nec auctor in, mattis
                                vitae leo.</p><a class="btn btn-outline-primary btn-sm" role="button"
                                href="placeinfo.html">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include('template/footer.php'); ?>