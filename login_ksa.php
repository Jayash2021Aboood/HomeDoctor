<?php
// لاستخدام الجلسات في الصفحة 
  session_start();
//  اذا كان المستخدم مسجل دخول من قبل يتم تحويلة للثفحة الرئيسية 
  $pageTitle = "Login";
  if (isset($_SESSION['userID'])) {
		header('Location: index.php');
	}
  
//    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');

  
  $errors = array();

  $username = "";
  $password = "";
  //  التأكد من ان بينات تسجيل الدخول تم ادخالها من الفورم
  if(isset($_POST['login_user']))
  {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //  فحص اسم المستخدم وكلمة المرو انهم ليسوا فارغين
    if( empty($username))
      $errors[] = "Username is requierd.";

    if( empty($password))
      $errors[] = "Passowrd is requierd.";
    
    if(count($errors) == 0)
    {
      
      // التأكد من المستخدم موجود 
      $logins = loginUser($username, $password);
      if(count($logins) > 0)
      {
        // التأكد من ان المستخدم مفعل
        if($logins[0]['Active'] == false)
        {
          $errors[] = "This Account is Locked !";
        }
        else
        {
// انشاء جليى للمستخدم وتحويلة للثفحة الرئيسية
          $_SESSION["userID"] = $logins[0]['ID'];
          $_SESSION["userName"] = $logins[0]['Name'];
          $_SESSION["userUsername"] = $logins[0]['Username'];
          $_SESSION["message"] = "login successfuly!";
          header('location: index.php');
          exit();
        }
      }
      else
      {
        $_SESSION["message"] = "Username Or Password Not Correct!";
        $errors[] = "Username Or Password Not Correct!";
      }
      
    }

    
  }
?>
<!-- استدعاء رأس الصفحة -->
<?php include('template/header.php'); ?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>

<!-- محتوى الصفحة -->
<main class="page login-page">
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">Log In</h2>
            </div>
            <form action="" method="POST">
                <?php
                // طباعة الاخطاء للمستخدم ان وجدت اخطاء
                    if(count($errors) > 0)
                    {
                    echo '<div id="errors" class="form-group text-danger" > <ul>';
                    foreach($errors as $error)
                    {
                        echo "<li> $error </>";
                    }      
                    echo '</ul> </div>';
                    }
                ?>
                <div class="form-group"><label for="username">UserName</label><input class="form-control item"
                        type="username" id="username" name="username"></div>
                <div class="form-group"><label for="password">password</label><input class="form-control"
                        type="password" id="password" name="password"></div>
                <div class="form-group">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="checkbox"><label
                            class="form-check-label" for="checkbox">Remember me</label></div>
                </div><button name="login_user" class="btn btn-primary btn-block" type="submit">Log In</button><a
                    class="btn btn-primary btn-block" role="button" href="registration.php">Registration<br></a>
            </form>
        </div>
    </section>
</main>
<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php') ?>