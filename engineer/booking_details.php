<?php
  session_start();
  include('../includes/lib.php');
  include('../includes/service.php');
  include('../includes/customer.php');
  include('../includes/service_type.php');
  include('../includes/booking.php');
  include('../includes/booking_note.php');
  include('../includes/booking_attachment.php');
  
  checkEngineerSession();

  $pageTitle = "Booking Details";
  ?>

<?php include('../template/header.php'); ?>

<!-- التأكد من ان طريق الدخول للصفحة عن طريق الرابط وليس عن طريق فورم بيانات -->
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];


      $result = getBookingById($id);

      if( count( $result ) > 0)
       {

         $row = $result[0];
         $customer =  getCustomerById($row['customer_id'])[0];
         $service =  getServiceById($row['service_id'])[0];   
       }
      else
      {
        // في حال عدم وجود الحجز تحويلة لصفحة غير موجود
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

    <header class="pt-5 mt-4 mb-0 ">
        <div class="container-xl  text-center">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-primary">Booking Details</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <hr class="mb-1" />
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">
            <div class="card border-start-lg border-start-primary card-header-actions card-scrollable">
                <div class="card-header border-bottom ">
                    <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="overview-tab" href="#overview" data-bs-toggle="tab"
                                role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                        </li>
                        <?php if( !($row['state'] == 'request' || $row['state'] == 'reject' || $row['state'] == 'canceled')){  ?>
                        <li class="nav-item">
                            <a class="nav-link" id="payment-tab" href="#payment" data-bs-toggle="tab" role="tab"
                                aria-controls="payment" aria-selected="false">Service Price</a>
                        </li>
                        <?php }  ?>
                        <?php if( !($row['state'] == 'request' || $row['state'] == 'reject' ) ){  ?>
                        <li class="nav-item">
                            <a class="nav-link" id="notes-tab" href="#notes" data-bs-toggle="tab" role="tab"
                                aria-controls="notes" aria-selected="false">Notes</a>
                        </li>
                        <?php }  ?>
                    </ul>
                    <div>
                        <?php
                            if($row['state'] == 'request')
                                echo /*html*/'<span class="badge bg-gray-600">'.$row['state'].'</span>';
                            else if($row['state'] == 'reject')
                                echo /*html*/'<span class="badge bg-red ">'.$row['state'].'</span>';
                            else if($row['state'] == 'working')
                                echo /*html*/'<span class="badge bg-purple ">'.$row['state'].'</span>';
                            else if($row['state'] == 'ready')
                                echo /*html*/'<span class="badge bg-blue">'.$row['state'].'</span>';
                            else if($row['state'] == 'done')
                                echo /*html*/'<span class="badge bg-green">'.$row['state'].'</span>';
                            else if($row['state'] == 'paid')
                                echo /*html*/'<span class="badge bg-yellow-soft text-yellow">'.$row['state'].'</span>';
                            else if($row['state'] == 'canceled')
                                echo /*html*/'<span class="badge bg-red-soft text-red">'.$row['state'].'</span>';

                            ?>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="tab-content" id="cardTabContent">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel"
                            aria-labelledby="overview-tab">
                            <h5 class="card-title "> Booking NO: <?php echo $row['id']; ?></h5>
                            <h5 class="card-title "> Booking Date: <?php echo $row['booking_date']; ?>
                            </h5>
                            <h5 class="card-title text-primary">Service Name : <?php echo $service['name']; ?></h5>
                            <h5>Service Price : R.S <?php echo $row['service_price']; ?></h5>
                            <h5>Paid Price : R.S <?php echo $row['paid_price'] ?? 0; ?></h5>
                            <div class="text-s fw-bold d-inline-flex align-items-center">
                                <?php echo $row['detail']; ?>
                            </div>
                            <p class="card-text"> Booked By:
                                <span
                                    class="text-success"><?php echo $customer['first_name'] . ' ' . $customer['last_name'];?></span>
                            </p>
                            <?php if( $row['state'] == 'ready'){  ?> <?php } ?>
                            <form class="d-inline-block mb-2" action="bookingManager.php" method="POST"
                                enctype="multipart/form-data">
                                <!-- Form Group (booking_id)-->
                                <input type="hidden" name="booking_id" id="booking_id" value="<?php echo $row['id'];?>"
                                    required>
                                </input>
                                <!-- Submit button-->
                                <?php if( $row['state'] == 'request'){  ?>
                                <button name="engineerAcceptBooking" class="btn btn-info" type="submit">
                                    Accept</button>
                                <button name="engineerRejectBooking" class="btn btn-pink" type="submit">
                                    Reject</button>
                                <?php } ?>
                                <?php if( $row['state'] == 'working'){  ?>
                                <button name="engineerCompleteService" class="btn btn-primary" type="submit">
                                    Ready</button>
                                <?php } ?>
                            </form>
                        </div>
                        <!--  Start Payment Tab  -->
                        <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                            <h5 class="card-title">Payment and Notes</h5>
                            <p class="card-text"></p>
                            <form action="bookingManager.php" method="POST" enctype="multipart/form-data">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (customer_id)-->

                                    <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" required>
                                    </input>

                                    <input class="form-control" type="hidden" name="customer_id" id="customer_id"
                                        value="<?php echo $customer['id'];?>" required>
                                    </input>
                                    <!-- Form Group (service_id)-->
                                    <input type="hidden" name="service_id" id="service_id"
                                        value="<?php echo $row['service_id'];?>" required>
                                    </input>


                                    <!-- Form Group (card_number)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="card_number">Card Number</label>
                                        <input class="form-control" id="card_number" name="card_number" type="text"
                                            placeholder="Card Number" value="<?php echo $row['card_number'];?>"
                                            readonly />
                                    </div>
                                    <!-- Form Group (service_price)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="service_price">Service Price</label>
                                        <input class="form-control" id="service_price" name="service_price" type="text"
                                            placeholder="Service Price" value="<?php echo $row['service_price'];?>" />
                                    </div>
                                    <!-- Form Group (paid_price)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="paid_price">Paid Price</label>
                                        <input class="form-control" id="paid_price" name="paid_price" type="text"
                                            placeholder="Paid Price" value="<?php echo $row['paid_price'];?>"
                                            readonly />
                                    </div>
                                    <!-- Form Group (detail)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="detail">Detail</label>
                                        <input class="form-control" id="detail" name="detail" type="text"
                                            placeholder="Detail" value="<?php echo $row['detail'];?>" readonly />
                                    </div>
                                    <!-- Form Group (booking_date)-->
                                    <div class="col-md-4 mb-3">
                                        <label class="small mb-1" for="booking_date">Booking Date</label>
                                        <input class="form-control" id="booking_date" name="booking_date" type="Date"
                                            placeholder="Booking Date" value="<?php echo $row['booking_date'];?>"
                                            readonly />
                                    </div>
                                </div>
                                <!-- Submit button-->
                                <button name="engineerChangeBookingPrice" class="btn btn-success" type="submit">Update
                                    Price</button>
                            </form>
                        </div>
                        <!-- End Payment Tab -->


                        <?php if( !($row['state'] == 'request' || $row['state'] == 'reject' ) ){  ?>
                        <!--  Start Notes Tab  -->
                        <div class="tab-pane fade h-100" id="notes" role="tabpanel" aria-labelledby="notes-tab">

                            <?php if($row['state'] != 'canceled'){  ?>
                            <form action="bookingManager.php" method="POST" enctype="multipart/form-data">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (engineer_id)-->

                                    <input class="form-control" type="hidden" name="engineer_id" id="engineer_id"
                                        value="<?php if(isEngineer()) echo $_SESSION['userID'];?>" required>
                                    </input>
                                    <!-- Form Group (booking_id)-->
                                    <input type="hidden" name="booking_id" id="booking_id"
                                        value="<?php echo $row['id'];?>" required>
                                    </input>


                                    <!-- Form Group (note)-->
                                    <div class="col-10 mb-3">
                                        <!-- <label class="small mb-1" for="note">Note</label> -->
                                        <input class="form-control" id="note" name="note" type="text"
                                            placeholder="Enter Your Note" value="" required />
                                    </div>

                                    <div class="col-2">

                                        <!-- Submit button-->
                                        <button name="engineerAddBookingNote" class="btn btn-success"
                                            type="submit">Send</button>

                                    </div>
                                </div>
                            </form>
                            <?php }  ?>



                            <div class="col-12 noteMessage">
                                <?php 
                                    $allNotes = getAllBookingNote($row['id']);
                                    if(count($allNotes ) > 0)
                                    {
                                        foreach($allNotes as $note)
                                        {                                    
                                ?>
                                <?php if(isEngineer() && $note['engineer_id'] == $_SESSION['userID']){ ?>
                                <div>
                                    <p class="bg-blue-soft p-2 rounded-1 d-inline-block"><?php echo $note['note'];?></p>
                                </div>
                                <?php } else {?>
                                <div style="text-align: right;">
                                    <p class="bg-cyan-soft p-2 rounded-1 d-inline-block"><?php echo $note['note'];?></p>
                                </div>
                                <?php } ?>
                                <?php } }?>
                            </div>
                        </div>
                        <!-- End Notes Tab -->
                        <?php } ?>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- =============================================== -->
    <!-- ============ Booking Attachment Start ========= -->
    <!-- =============================================== -->

    <header class="pt-5 mt-4 mb-0 ">
        <div class="container-xl  text-center">
            <div class="row">
                <div class="col-12">
                    <div class="text-center ">
                        <h1 class="text-primary">Booking Attachments</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <hr class="mb-1" />
    <!-- Main page content-->
    <div class="container-xl px-4">
        <div class="row">
            <div class="card border-start-lg border-start-primary card-header-actions card-scrollable">
                <div class="card-header border-bottom ">
                    <ul class="nav nav-tabs card-header-tabs" id="cardTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="attachments-tab" href="#attachments" data-bs-toggle="tab"
                                role="tab" aria-controls="attachments" aria-selected="false">Attachments</a>
                        </li>
                    </ul>
                    <div>
                        <?php
                            if($row['state'] == 'request')
                                echo /*html*/'<span class="badge bg-gray-600">'.$row['state'].'</span>';
                            else if($row['state'] == 'reject')
                                echo /*html*/'<span class="badge bg-red ">'.$row['state'].'</span>';
                            else if($row['state'] == 'working')
                                echo /*html*/'<span class="badge bg-purple ">'.$row['state'].'</span>';
                            else if($row['state'] == 'ready')
                                echo /*html*/'<span class="badge bg-blue">'.$row['state'].'</span>';
                            else if($row['state'] == 'done')
                                echo /*html*/'<span class="badge bg-green">'.$row['state'].'</span>';
                            else if($row['state'] == 'paid')
                                echo /*html*/'<span class="badge bg-yellow-soft text-yellow">'.$row['state'].'</span>';
                            else if($row['state'] == 'canceled')
                                echo /*html*/'<span class="badge bg-red-soft text-red">'.$row['state'].'</span>';

                            ?>
                    </div>
                </div>
                <div class="card-body p-5">
                    <div class="tab-content" id="cardTabContent">
                        <!--  Start Attachments Tab  -->
                        <div class="tab-pane fade show active" id="attachments" role="tabpanel"
                            aria-labelledby="attachments-tab">

                            <form action="bookingManager.php" method="POST" enctype="multipart/form-data">
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (engineer_id)-->

                                    <input class="form-control" type="hidden" name="engineer_id" id="engineer_id"
                                        value="<?php if(isEngineer()) echo $_SESSION['userID'];?>" required>
                                    </input>
                                    <!-- Form Group (booking_id)-->
                                    <input type="hidden" name="booking_id" id="booking_id"
                                        value="<?php echo $row['id'];?>" required>
                                    </input>


                                    <!-- Form Group (attachment)-->
                                    <div class="col-10 mb-3">
                                        <!-- <label class="small mb-1" for="attachment">Attachment</label> -->
                                        <input class="form-control" id="attachment" name="attachment" type="file"
                                            placeholder="Enter Your Attachment" value="" required />
                                    </div>

                                    <div class="col-2">

                                        <!-- Submit button-->
                                        <button name="engineerAddBookingAttachment" class="btn btn-success"
                                            type="submit">Upload</button>

                                    </div>
                                </div>
                            </form>



                            <div class="col-12 attachmentMessage">
                                <?php 
                                    $allAttachments = getAllBookingAttachments($row['id']);
                                    if(count($allAttachments ) > 0)
                                    {
                                        foreach($allAttachments as $attachment)
                                        {                                    
                                ?>
                                <?php if(isEngineer() && $attachment['engineer_id'] == $_SESSION['userID']){ ?>
                                <div>
                                    <p class="bg-blue-soft p-2 rounded-1 d-inline-block">
                                        <?php if(!empty($attachment['attachment'])) { ?>
                                        <a target="_blank"
                                            href="<?php echo $PATH_ATTACHMENTS . $attachment['attachment'];?>"><?php echo $attachment['attachment'];?></a>
                                        <?php }?>
                                    </p>
                                </div>
                                <?php } else {?>
                                <div style="text-align: right;">
                                    <p class="bg-cyan-soft p-2 rounded-1 d-inline-block">
                                        <?php if(!empty($attachment['attachment'])) { ?>
                                        <a target="_blank"
                                            href="<?php echo $PATH_ATTACHMENTS . $attachment['attachment'];?>">
                                            <?php echo $attachment['attachment'];?></a>
                                        <?php }?>
                                    </p>
                                </div>
                                <?php } ?>
                                <?php } }?>
                            </div>
                        </div>
                        <!-- End Attachments Tab -->
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- =============================================== -->
    <!-- ============ Booking Attachment End =========== -->
    <!-- =============================================== -->
</main>


<?php include('../template/footer.php') ?>