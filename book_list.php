<?php
  session_start();
  include('includes/lib.php');
  include('includes/book.php');
  $pageTitle = lang("Books List");
  ?>

<?php include('template/header.php'); ?>


<?php include('template/startNavbar.php'); ?>

<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title text-primary">
                            <?php echo lang('Library Books'); ?>
                        </h1>
                    </div>
                    <div class="col-6 mb-3">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input class="form-control" id="search_term" name="search_term" type="text"
                                    placeholder="<?php echo lang('Search in books ...'); ?>"
                                    aria-label="<?php echo lang('Search for ...'); ?>" aria-describedby="button-search">
                                <button class="btn btn-primary" id="button-search" name="button-search"
                                    type="submit"><?php echo lang('Go'); ?></button>
                            </div>
                        </form>
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
                if(isset($_GET['search_term']) && !empty($_GET['search_term']))
                    $all = getAllBooksBySearch($_GET['search_term']);
                else
                    $all = getAllBooksBySearch("");
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
<!-- محتوى الصفحة -->


<?php include('template/footer.php') ?>