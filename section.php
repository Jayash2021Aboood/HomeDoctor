<?php
  session_start();
  include('includes/lib.php');
  include('includes/section.php');
  include('includes/book.php');
  $pageTitle = lang("Section Details");

?>

<?php include('template/header.php'); ?>

<!-- التأكد من ان طريق الدخول للصفحة عن طريق الرابط وليس عن طريق فورم بيانات -->
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    // التأكد من ان معرف المهندس تم ارسالة في الرابط 
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
    //   جلب بيانات المهندس اعتمادا على المعرف وعرضها في الصفحة
      $result = getSectionById($id);

      if( count( $result ) > 0)
       {
         $row = $result[0];
       }
      else
      {
        // في حال عدم وجود المهندس تحويلة لصفحة غير موجود
        $_SESSION["message"] = lang('There is No data for this id');
        $_SESSION["fail"] = lang('There is No data for this id');
        //echo ' <script> location.replace("index.php"); </script>';
        header('Location: index.php');
        exit();
        
      }

      
    }
    else
    {
      $_SESSION["message"] = lang('No data for display');
      $_SESSION["fail"] = lang('No data for display');
      header('Location: index.php');
      exit();
    }
  }

?>

<?php include('template/startNavbar.php'); ?>



<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title text-primary">
                            <?php echo lang('Section Details'); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl">
        <div class="row">
            <div class="col-8 m-auto">
                <!-- Blog post-->
                <div class="card text-center">
                    <div class="card-body">
                        <div class="small text-muted"><?php echo $row['number']; ?></div>
                        <h2 class="card-title h4"><?php echo $row['name']; ?></h2>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <hr class="">
                </div>
            </div>
        </div>
        <div class="row">
            <?php

                $all = getAllBooksBySearch("");
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Books Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $book)
                    {
                        if($book['section_id'] !== $row['id']) continue;
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <!-- Blog post-->
                <div class="card mb-4">
                    <a href="book.php?id=<?php echo $book['id'] ?>"><img class="card-img-top"
                            src="<?php echo $PATH_PHOTOES . $book['book_image'] ?? 'book_default.jpg'; ?>"
                            alt="<?php echo $book['book_image'] ?>"></a>
                    <div class="card-body">
                        <div class="small text-muted"><?php echo $book['author_name']; ?></div>
                        <h2 class="card-title h4"><?php echo $book['name']; ?></h2>
                        <p class="card-text"><?php echo $book['detail']; ?></p>
                        <p class="card-text">
                            <?php echo displayAvailableCount(getAvailableBooksToIssue($book['id'])); ?>
                        </p>
                        <div class="text-end">
                            <?php if ( isset($book['book_file']) && !empty($book['book_file'])) { ?>
                            <a class="btn btn-success btn-sm"
                                href="<?php echo $PATH_PHOTOES . $book['book_file'] ; ?>"><?php echo lang('Download'); ?>
                            </a>
                            <?php } ?>
                            <a class="btn btn-primary btn-sm"
                                href="book.php?id=<?php echo $book['id'] ?>"><?php echo lang('Read more'); ?> →</a>

                        </div>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
</main>

<?php include('template/footer.php') ?>