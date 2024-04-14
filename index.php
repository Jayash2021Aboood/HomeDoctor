<?php
  session_start();
  include('includes/lib.php');
  include('includes/book.php');
  $pageTitle = "Home";

  ?>

<?php include('template/header.php'); ?>





<?php include('template/startNavbar.php'); ?>

<main class="mt-1">
    <header class="d-md-block py-10  mb-4 bg-img-cover"
        style="background-image: url('assets/img/backgrounds/library3.jpeg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;">
        <div class="container-xl p-0 overlay overlay-60 overlay-black">
            <div class="text-center  z-1 text-white mb-0">
                <h1 class="text-white z-2"><?php echo lang("Welcome to Bayda Library"); ?></h1>
                <p class="lead mb-0 text-white-75 z-2"><?php echo lang("A sea of science and knowledge"); ?>
                </p>
            </div>
        </div>
    </header>

    <div class="container-xl px-4">
        <div class="row justify-content-center">
        </div>
    </div>
</main>


<!-- books -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title text-primary">
                            <?php echo lang('Collection contain more than 50,000 Books'); ?>
                        </h1>
                    </div>
                    <div class="col-6 mb-3 text-start">
                        <a href="book_list.php"> <?php echo lang("see more"); ?> →</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <?php
                $all = getAllBooksBySearch("",3);
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Books Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $row)
                    {
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <!-- Blog post-->
                <div class="card mb-4">
                    <a href="book.php?id=<?php echo $row['id'] ?>"><img class="card-img-top"
                            src="<?php echo $PATH_PHOTOES . $row['book_image'] ?? 'book_default.jpg'; ?>"
                            alt="<?php echo $row['book_image'] ?>"></a>
                    <div class="card-body">
                        <div class="small text-muted"><?php echo $row['author_name']; ?></div>
                        <h2 class="card-title h4"><?php echo $row['name']; ?></h2>
                        <p class="card-text"><?php echo $row['detail']; ?></p>
                        <p class="card-text"><?php echo displayAvailableCount(getAvailableBooksToIssue($row['id'])); ?>
                        </p>
                        <div class="small text-muted"><?php echo $row['section_name']; ?></div>
                        <div class="text-end">
                            <?php if ( isset($row['book_file']) && !empty($row['book_file'])) { ?>
                            <a class="btn btn-success btn-sm"
                                href="<?php echo $PATH_PHOTOES . $row['book_file'] ; ?>"><?php echo lang('Download'); ?>
                            </a>
                            <?php } ?>
                            <a class="btn btn-primary btn-sm"
                                href="book.php?id=<?php echo $row['id'] ?>"><?php echo lang('Read more'); ?> →</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
</main>


<!-- Imgae center page -->
<main>
    <header class="d-none d-md-block py-10  mb-4 bg-img-cover overlay overlay-80"
        style="background-image: url('assets/img/backgrounds/library2.jpg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;">
        <div class="container-xl pt-10  px-4">
            <div class="text-center  z-1">
                <h1 class="text-white">جامعة البيضاء</h1>
                <p class="lead mb-0 text-white-75">
                    جامعة يمنية حكومية أنشئت بالقرار الجمهوری رقم ( 119 ) للعام 2008م الذي أقر إنشاء خمس جامعات يمنية هي
                    : ( لحج - أبين - الضالع - حجة - البيضاء ) تقع جامعة البيضاء في مدينة البيضاء بمحافظة البيضاء -
                    اليمن. سميت جامعة البيضاء نسبة إلى مدينة البيضاء التي تعتبر مركز المحافظة.
                </p>
            </div>
        </div>
    </header>

    <div class="container-xl px-4">
        <div class="row justify-content-center">
        </div>
    </div>
</main>


<!-- Main Sections -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title text-primary">
                            <?php echo lang('Collection contain more than 1,000 Section'); ?>
                        </h1>
                        <p> <?php echo lang('supporting dewi Method'); ?> </p>
                    </div>
                    <div class="col-6 mb-3 text-start">
                        <a href="section_list.php"> <?php echo lang("see more"); ?> →</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <?php
                $all = select("SELECT * FROM section WHERE parent_id is NULL;");
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Sections Found To Display. </h2></div>'; 
                else{ 
                        // Here Print Without nested ul li 
                    foreach($all as  $row)
                    {       
            ?>
            <div class="col-12">
                <!-- Blog post-->
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- <div class="small text-muted"><?php //echo $row['email']; ?></div> -->
                        <h2 class="card-title h4">
                            <div class="row">
                                <div class="col-md-9"><?php echo $row['number'] . ' - ' . $row['name']; ?></div>
                                <div class="col-md-3 text-md-end">
                                    <a class="btn btn-primary btn-sm"
                                        href="section.php?id=<?php echo $row['id'] ?>"><?php echo lang('Display Details'); ?>
                                        →</a>
                                </div>
                            </div>
                        </h2>

                    </div>
                </div>
            </div>
            <?php 
                        }
        } ?>
        </div>
    </div>
</main>


<!-- Imgae Bottom page -->
<!-- <main>
    <header class="d-none d-md-block py-10  mb-4 bg-img-cover overlay overlay-60"
        style="background-image: url('assets/img/demo/demo-ocean-lg.jpg'); min-height: 500px; height: 500px;  background-attachment: fixed; background-repeat: no-repeat;">
        <div class="container-xl pt-10  px-4">
            <div class="text-center  z-1">
                <h1 class="text-white"><?php //echo lang("Welcome to Bayda Library"); ?></h1>
                <p class="lead mb-0 text-white-50"><?php //echo lang("A sea of science and knowledge"); ?>
                </p>
            </div>
        </div>
    </header>

    <div class="container-xl px-4">
        <div class="row justify-content-center">
        </div>
    </div>
</main> -->




<?php include('template/footer.php') ?>