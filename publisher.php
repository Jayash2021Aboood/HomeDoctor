<?php
  session_start();
  include('includes/lib.php');
  include('includes/publisher.php');
  $pageTitle = lang("Publisher Details");

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
      $result = getPublisherById($id);

      if( count( $result ) > 0)
       {
         $row = $result[0];
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
                            <?php echo lang('Publisher Details'); ?>
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
                <div class="card">
                    <div class="card-body">
                        <div class="small text-muted"><?php echo $row['email']; ?></div>
                        <h2 class="card-title h4"><?php echo $row['name']; ?></h2>
                        <p class="card-text"><?php echo $row['phone']; ?></p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <hr class="">
                </div>
            </div>
        </div>
    </div>
</main>

<?php include('template/footer.php') ?>