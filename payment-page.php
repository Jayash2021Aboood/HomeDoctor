<?php
// لاستخدام الجلسات في الصفحة 
  session_start();
  //    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');
  $pageTitle = "Payment Page";


  ?>
<!-- استدعاء رأس الصفحة -->
<?php include('template/header.php'); ?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>

<!-- التأكد من ان طريق الدخول للصفحة عن طريق الرابط وليس عن طريق فورم بيانات -->
<?php
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    // التأكد من ان معرف الحدث تم ارسالة في الرابط 
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      //   جلب تفاصيل الحدث اعتمادا على المعرف وعرضها في الصفحة
      $result = gettblbookingById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
      }
      else
      {
        $_SESSION["message"] = 'There is No data for this id';
        echo ' <script> location.replace("notFound.php"); </script>';
      }

      // if($row == null)
    }
    else
    {
      // في حال عدم وجود الحدث تحويلة لصفحة غير موجود
      $_SESSION["message"] = 'No data for display';
      echo ' <script> location.replace("notFound.php"); </script>';
    }
  }


// التأكد من ان طريق الدخول للصفحة عن طريق فورم الدفع وليس عن طريق الرابط 
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    // التأكد من ان المستخدم مسجل دخول او يتم تحويلة لتسجيل الدخول
    if (!(isset($_SESSION['userID']))) 
    {
      echo ' <script> location.replace("login.php"); </script>';
    }


    // التأكد من ان المستخدم ظفط على زر الدفع 
    if(isset($_POST['payment']))
    {
      // جلب بيانات الحدث المراد حجزةمن قبل المستخدم
      if(isset($_POST['eventID']))
        $eventID = $_POST['eventID'];
        $numberOfTicket = $_POST['numberOfTicket'];
        //$eventID = $_POST['eventID'];

        $result = gettblbookingById($eventID);
        if( count( $result ) > 0)
        {
          // تسجيل الحجز في قاعدة البيانات
          $event = $result[0];
          $add = addBookingEvent($_SESSION['userID'],$event['ID'],$event['Price'] ,$numberOfTicket ,date('Y-m-d H:i:s'));
          if($add ==  true)
          {
            echo (/*html*/'<script> alert("Your Booking Has Been Successfuly!"); </script>');
            echo ' <script> location.replace("payment-page.php?id='. $event["ID"].'"); </script>';
          }
          else
          {
            $_SESSION["message"] = "Error when Payment Event";
            $errors[] = "Error when Payment Event";
          } 
        }
        else
        {
          $_SESSION["message"] = "there is no Event for Buy";
          $errors[] = "there is no Event for Buy";
        }    
        
    }
  }


?>

<!-- محتوى الصفحة -->
<main class="page payment-page">
    <section class="clean-block payment-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Payment</h2>
            </div>
            <form action="" method="POST">
                <div class="products">
                    <h3 class="title">Checkout</h3>
                    <div class="item"><span class="price"><?php echo $row['Currency'];?>
                            <span class="ticketPrice" id="ticketPrice"> <?php echo  $row['Price']; ?></span></span>
                        <p class="item-name">price for <?php echo $row['Name'] ?></p>
                        <p class="item-description"><?php echo $row['AdditionalInformation'] ?></p>
                    </div>
                    <div class="item">
                        <span class="price">
                            <input type="number" name="numberOfTicketFront" id="numberOfTicketFront" value="1"
                                onchange="CalculateTotal()" min="1">
                        </span>
                        <p class="item-name">number of ticket</p>
                        <p class="item-description">enter number of ticket that you need </p>
                    </div>
                    <div class="total"><span>Total</span><span class="price"><?php echo $row['Currency'];?> <span
                                class="totalPrice" id="totalPrice"> <?php echo  $row['Price']; ?> </span></span></div>
                </div>
                <div class="card-details">
                    <h3 class="title">Credit Card Details</h3>
                    <div class="form-row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="hidden" name="eventID" class="form-control" type="text"
                                    value="<?php echo  $row['ID']; ?>">
                                <input type="hidden" id="numberOfTicket" name="numberOfTicket" class="form-control"
                                    type="text" default="1" value="1">
                                <input type="hidden" name="Price" class="form-control" type="text"
                                    value="<?php echo  $row['Price']; ?>">
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="form-group"><label for="card-holder">Card Holder</label><input
                                    class="form-control" type="text" placeholder="Card Holder"></div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group"><label>Expiration date</label>
                                <div class="input-group expiration-date"><input class="form-control" type="text"
                                        placeholder="MM"><input class="form-control" type="text" placeholder="YY"></div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group"><label for="card-number">Card Number</label><input
                                    class="form-control" type="text" id="card-number" placeholder="Card Number"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group"><label for="cvc">CVC</label><input class="form-control" type="text"
                                    id="cvc" placeholder="CVC"></div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group"><button name="payment" class="btn btn-primary btn-block"
                                    type="submit">Proceed</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
// دالة لحساب السعر عندما يقوم المستخدم بتغيير عدد التذاكر المراد حجزها 
function CalculateTotal() {
    var ticketPrice = document.getElementById('ticketPrice');
    var totalPrice = document.getElementById('totalPrice');
    var numberOfTicketFront = document.getElementById('numberOfTicketFront');
    var numberOfTicket = document.getElementById('numberOfTicket');

    totalPrice.innerHTML = ticketPrice.textContent.valueOf() * numberOfTicketFront.value;
    numberOfTicket.value = numberOfTicketFront.value;
}
</script>
<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>