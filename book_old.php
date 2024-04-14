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

<!-- محتوى الصفحة -->
<main class="page">

    <header class="py-10 pb-5 mb-0 ">
        <div class="container-xl px-4">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-primary"><?php echo $row['name']; ?></h1>

                        <!-- <div class="progress col-lg-5 m-auto">
                            <div class="progress-bar  bg-<?php echo getRateColor($total_rate); ?>" role="progressbar"
                                style="width: <?php echo $total_rate ?>%" aria-valuenow="<?php echo $total_rate ?>"
                                aria-valuemin="0" aria-valuemax="100">
                                <?php echo floor($total_rate) ?>%</div>
                        </div> -->
                    </div>
                </div>

                <div class="col-md-6 col-sm-12 mt-4 text-center">
                    <h4 class="p-3">Information</h4>
                    <p class="mb-0 mt-0 "> Number copies : <?php echo $row['number_copies']; ?></p>
                    <p class="mb-0 mt-0 "> Publish date:<?php echo $row['publish_date']; ?></p>
                    <p class="mb-0 mt-0 "> Details: <?php echo $row['detail']; ?></p>
                    </p>
                </div>
                <!-- <div class="col-md-6 col-sm-12 mt-4 text-center">
                    <h4 class="p-3">Contact Information</h4>
                    <p class="mb-0 mt-0 ">mail : <?php echo $row['section_id']; ?></p>
                    <p class="mb-0 mt-0 ">tel : <?php echo $row['language_id']; ?></p>
                </div> -->
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <!-- <div class="container-xl px-4">
        <h2 class="mt-5 mb-0">My Gallary</h2>
        <p>This is some of my work with previuos customer!</p>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <?php if(isset($row['image1']) && !empty($row['image1'])){ ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <a class="d-block lift rounded overflow-hidden mb-2" href="#"><img class="img-fluid"
                        src="<?php echo $PATH_PHOTOES . $row['image1']; ?>" alt="<?php echo $row['image1']; ?>" /></a>
            </div>
            <?php } ?>
            <?php if(isset($row['image2']) && !empty($row['image2'])){ ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <a class="d-block lift rounded overflow-hidden mb-2" href="#"><img class="img-fluid"
                        src="<?php echo $PATH_PHOTOES . $row['image2']; ?>" alt="<?php echo $row['image2']; ?>" /></a>
            </div>
            <?php } ?>
            <?php if(isset($row['image3']) && !empty($row['image3'])){ ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <a class="d-block lift rounded overflow-hidden mb-2" href="#"><img class="img-fluid"
                        src="<?php echo $PATH_PHOTOES . $row['image3']; ?>" alt="<?php echo $row['image3']; ?>" /></a>
            </div>
            <?php } ?>
            <?php if(isset($row['image4']) && !empty($row['image4'])){ ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <a class="d-block lift rounded overflow-hidden mb-2" href="#"><img class="img-fluid"
                        src="<?php echo $PATH_PHOTOES . $row['image4']; ?>" alt="<?php echo $row['image4']; ?>" /></a>
            </div>
            <?php } ?>
            <?php if(isset($row['image5']) && !empty($row['image5'])){ ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <a class="d-block lift rounded overflow-hidden mb-2" href="#"><img class="img-fluid"
                        src="<?php echo $PATH_PHOTOES . $row['image5']; ?>" alt="<?php echo $row['image5']; ?>" /></a>
            </div>
            <?php } ?>
            <?php if(isset($row['image6']) && !empty($row['image6'])){ ?>
            <div class="col-md-6 col-xl-4 mb-4 mb-xl-0">
                <a class="d-block lift rounded overflow-hidden mb-2" href="#"><img class="img-fluid"
                        src="<?php echo $PATH_PHOTOES . $row['image6']; ?>" alt="<?php echo $row['image6']; ?>" /></a>
            </div>
            <?php } ?>
        </div>
    </div> -->

    <!-- Main page content-->
    <div class="container-xl px-4">
        <h2 class="mt-5 mb-0">My Books</h2>
        <p>This is some of my Books Nice to Servie you!</p>
        <hr class="mt-0 mb-4" />
        <div class="row">
            <?php
                $all = getAllBooksByPubAndAuthAndSecByID($row['id']);
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Book Found To Display. </h2></div>'; 
                else{ 
                    foreach($all as  $row)
                    {
            ?>

            <div class="col-xl-4 col-md-6 mb-4">
                <!-- Dashboard info widget 1-->
                <!-- <div class="card border-start-lg border-start-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <div class="small fw-bold text-primary mb-1"><?php echo $row['name']; ?></div>
                                <div class="h5"> R.S <?php echo $row['price']; ?></div>
                                <div class="text-xs fw-bold d-inline-flex align-items-center">
                                    <?php echo $row['detail']; ?>
                                </div>
                            </div>
                            <!-- <div class="ms-2"><i class="fas fa-dollar-sign fa-2x text-gray-200"></i></div> -->
            </div>
            <!-- <div>
                            <a class="btn btn-primary mt-2"
                                href="<?php echo $PATH_CUSTOMER; ?>service.php?id=<?php echo $row['id'] ?>"> Book now
                            </a>
                        </div> -->
        </div>
    </div> -->
    </div>
    <?php }}?>
    </div>
    </div>
</main>


<?php include('template/footer.php') ?>