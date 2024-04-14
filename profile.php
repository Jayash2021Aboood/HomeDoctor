<?php
// لاستخدام الجلسات في الصفحة 
  session_start();

// التأكد من ان المستخدم مسجل دخول او يتم تحويلة للصفحة الرئيسية
  if (!(isset($_SESSION['userID']))) {
		echo $_SESSION['userID'];
    header('Location:'. $PATH_SERVER . 'index.php');
	}

  //    استدعاء الملف المحتوي الدوال لأستخدامها في الصفحة
  include('includes/lib.php');


  $pageTitle = "My Profile";
  $row = new User(null);
  //  استدعاء رأس الصفحة 
  include('template/header.php'); 
  $errors = array();

// اذا كان الدخول للصفحة عن طريق الرابط يتم جلب بيانات المستخدم وعرضها 
  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_SESSION['userID']))
    {
      $_SESSION["message"] = '';
      $id = $_SESSION['userID'];
      $result = getUserById($id);

      if( count( $result ) > 0)
        $row = $result[0];
      else
      {
        $_SESSION["message"] = ' There is No data for this id';
      }

      
    }
    else
    {
      $_SESSION["message"] = 'No data for display';
    }
  }

  // اذا كان الدخول للصفحة عن طريق الفورم يتم تحديث بيانات اليوز في قاعدة البيانات
  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['updateUser']))
    {


      $id = $_POST['id'];
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $active = ( isset( $_POST['active']))? 1:0;


      // يتم فحص القيم والتأكد من سلامتها
      if( empty($name))
        $errors[] = "Name is requierd.";
  
      if( empty($email))
        $errors[] = "Email is requierd.";

      if( empty($username))
        $errors[] = "Username is requierd.";
  
      if( empty($password))
        $errors[] = "Password is requierd.";
      
      if(count($errors) == 0)
      {


        // جلب المستخدم وتحدبث بياناته
        $result = getUserById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateUser($id, $name, $email, $phone, $username, $password,$active);
        if($update ==  true)
        {
  
          $_SESSION["message"] = "User Updated successfuly!";
          header('Location:'. $PATH_SERVER .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = "Error when Update Data";
          $errors[] = "Error when Update Data";
        }
        
      }
  
    }
  }
?>
<!-- استدعاء القائمة العلوية -->
<?php include('template/navbar.php'); ?>


<!-- محتوى الصفحة -->
<main class="page registration-page">
    <section class="clean-block clean-form dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="text-info">My Profile</h2>
            </div>
            <form action="" method="POST">
                <?php
                if(count($errors) > 0)
                {
                  // عرض الاخطاء ان وجدت
                    echo '<div id="errors" class="form-group text-danger" > <ul>';
                    foreach($errors as $error)
                    {
                    echo "<li> $error </>";
                    }      
                    echo '</ul> </div>';
                }
                ?>
                <div class="form-group"><label for="id"></label><input class="form-control item" type="hidden" id="id"
                        name="id" value="<?php echo $row['ID'];?>"></div>
                <div class="form-group"><label for="name">Name</label><input class="form-control item" type="text"
                        id="name" name="name" value="<?php echo $row['Name'];?>"></div>
                <div class="form-group"><label for="email">Email</label><input class="form-control item" type="email"
                        id="email" name="email" value="<?php echo $row['Email'];?>"></div>
                <div class="form-group"><label for="phone">Phone</label><input class="form-control item" type="phone"
                        id="phone" name="phone" value="<?php echo $row['Phone'];?>"></div>
                <div class="form-group"><label for="username">Username</label><input class="form-control item"
                        type="text" id="username" name="username" value="<?php echo $row['Username'];?>"></div>
                <div class="form-group"><label for="password"
                        value="<?php echo $row['Password'];?>">Password</label><input class="form-control item"
                        type="password" id="password" name="password"></div>
                <div class="form-group"><label for="repeatPassword">Repeat Password</label><input
                        class="form-control item" type="Password" id="repeatPassword" name="repeatPassword"
                        value="<?php echo $row['Password'];?>"></div>
                <div class="form-group"><label for="active"></label>
                    <input class="form-control item" type="hidden" id="active" name="active"
                        <?php if ($row['Active'] == 1) echo 'checked'; ?> placeholder="Active">
                </div>
                <button name="updateUser" class="btn btn-primary btn-block" type="submit">Update</button>
            </form>
        </div>
    </section>
</main>

<!-- اسندعاء الفوتر (القائمة السفلية)  -->
<?php include('template/footer.php'); ?>