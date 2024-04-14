<?php
  session_start();
  include('includes/lib.php');
  include('includes/section.php');
  $pageTitle = lang("Sections List");
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
                            <?php echo lang('Library Sections'); ?>
                        </h1>
                    </div>
                    <div class="col-6 mb-3">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input class="form-control" id="search_term" name="search_term" type="text"
                                    placeholder="<?php echo lang('Search in sections ...'); ?>"
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
                    $all = getAllSectionsBySearch($_GET['search_term']);
                else
                    $all = getAllSectionsBySearch("");
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Sections Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $row)
                    {
            ?>
            <div class="col-4">
                <!-- Blog post-->
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- <div class="small text-muted"><?php //echo $row['email']; ?></div> -->
                        <h2 class="card-title h4"><?php echo $row['number'] . ' - ' . $row['name']; ?></h2>
                        <!-- <p class="card-text"><?php //echo $row['phone']; ?></p> -->
                        <!-- <p class="card-text"><?php //echo $row['nationality']; ?></p> -->
                        <a class="btn btn-primary btn-sm"
                            href="section.php?id=<?php echo $row['id'] ?>"><?php echo lang('Read more'); ?> →</a>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>