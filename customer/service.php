<?php
  session_start();
  include('../includes/lib.php');
  include('../includes/service.php');
  include('../includes/engineer.php');
  include('../includes/service_type.php');
  
  checkCustomerSession();

  $pageTitle = "Service Details";
  ?>

<?php include('../template/header.php'); ?>

<!-- التأكد من ان طريق الدخول للصفحة عن طريق الرابط وليس عن طريق فورم بيانات -->
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    // التأكد من ان معرف المهندس تم ارسالة في الرابط 
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
    //   جلب بيانات الخدمة اعتمادا على المعرف وعرضها في الصفحة
      $result = getServiceById($id);

      if( count( $result ) > 0)
       {

         $row = $result[0];
         $engineer =  getEngineerById($row['engineer_id'])[0];
         $service_type =  getServiceTypeById($row['service_type_id'])[0];   
       }
      else
      {
        // في حال عدم وجود الخدمة تحويلة لصفحة غير موجود
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

<?php include('../template/startNavbar.php'); ?>

<!-- محتوى الصفحة -->
<main class="page">

    <header class="py-10 mb-0 pb-4 ">
        <div class="container-xl px-4 text-center">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-primary">Sevice Details</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <hr class="mt-2 mb-4" />
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">
            <div class="card border-start-lg border-start-primary">
                <div class="card-header border-bottom">
                    <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" href="#overview" data-bs-toggle="tab"
                                role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-5">
                    <div class="tab-content" id="cardTabContent">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <h5 class="card-title text-primary"><?php echo $row['name']; ?></h5>
                            <h5>R.S <?php echo $row['price']; ?></h5>
                            <div class="text-s fw-bold d-inline-flex align-items-center">
                                <?php echo $row['detail']; ?>
                            </div>
                            <p class="card-text"> Provided By:
                                <span
                                    class="text-success"><?php echo $engineer['first_name'] . ' ' . $engineer['last_name'];?></span>
                            </p>
                            <p class="card-text"> Category :
                                <span class="text-success"><?php echo $service_type['name'] ;?></span>
                            </p>

                            <hr class="mb-3" />
                            <h5 class="card-title">Create Booking Know for this Service!</h5>
                            <p class="card-text"></p>
                            <form action="bookingManager.php" method="POST" enctype="multipart/form-data">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (engineer_id)-->

                                    <input class="form-control" type="hidden" name="engineer_id" id="engineer_id"
                                        value="<?php echo $engineer['id'];?>" required>
                                    </input>
                                    <!-- Form Group (service_id)-->
                                    <input type="hidden" name="service_id" id="service_id"
                                        value="<?php echo $row['id'];?>" required>
                                    </input>
                                    <!-- Form Group (service_price)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="service_price">Service Price</label>
                                        <input class="form-control" id="service_price" name="service_price" type="text"
                                            placeholder="Service Price" value="<?php echo $row['price'];?>" required
                                            readonly />
                                    </div>

                                    <!-- Form Group (booking_date)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="booking_date">Booking Date</label>
                                        <input class="form-control" id="booking_date" name="booking_date" type="Date"
                                            placeholder="Booking Date" value="" required />
                                    </div>
                                    <!-- Form Group (detail)-->
                                    <div class="col-12 mb-3">
                                        <label class="small mb-1" for="detail">Detail</label>
                                        <textarea class="lh-base form-control" id="detail" name="detail" rows="4"
                                            placeholder="Enter your booking  details"></textarea>
                                    </div>



                                </div>
                                <!-- Submit button-->
                                <button name="customerAddBooking" class="btn btn-success" type="submit">Book</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>


<?php include('../template/footer.php') ?>