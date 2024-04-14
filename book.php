<?php
  session_start();
  include('includes/lib.php');
  include('includes/book.php');
  $pageTitle = lang("Book Details");

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
      $result = getAllBooksWithDetails($id);

      if( count( $result ) > 0)
       {

         $row = $result[0];
         $total_book = $row['total_book'];
        //  $total_rate = $row['total_rate'];
            
       }
      else
      {
        // في حال عدم وجود المهندس تحويلة لصفحة غير موجود
        $_SESSION["message"] = 'There is No data for this id';
        $_SESSION["fail"] = 'There is No data for this id';
        //echo ' <script> location.replace("index.php"); </script>';
        header('Location: index.php');
        exit();
        
      }

      
    }
    else
    {
      $_SESSION["message"] = 'No data for display';
      $_SESSION["fail"] = 'No data for display';
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
                            <?php echo lang('Book Details'); ?>
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
                <div class="card mb-4">
                    <a href="book.php?id=<?php echo $row['id'] ?>"><img class="card-img-top mh-100"
                            src="<?php echo $PATH_PHOTOES . $row['book_image'] ?? 'book_default.jpg'; ?>"
                            alt="<?php echo $row['book_image'] ?>"></a>
                    <div class="card-body">
                        <div class="small text-muted"><?php echo $row['author_name']; ?></div>
                        <h2 class="card-title h4"><?php echo $row['name']; ?></h2>
                        <p class="card-text"><?php echo $row['detail']; ?></p>
                        <p class="card-text">
                            <?php
                                $availeible = getAvailableBooksToIssue($row['id']);
                                echo displayAvailableCount($availeible); 
                             ?>
                        </p>
                        <?php if ( isset($row['book_file']) && !empty($row['book_file'])) { ?>
                        <div class="text-center">
                            <a class="btn btn-success"
                                href="<?php echo $PATH_PHOTOES . $row['book_file'] ; ?>"><?php echo lang('Download'); ?>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <hr class="my-2">
                    <h4 class="p-3"><?php echo lang('Additional Information'); ?></h4>
                    <p class="mb-0 mt-0 "><?php echo lang('Number copies'); ?> : <?php echo $row['number_copies']; ?>
                    </p>
                    <p class="mb-0 mt-0 "> <?php echo lang('PublishDate'); ?> : <?php echo $row['publish_date']; ?></p>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('template/footer.php') ?>