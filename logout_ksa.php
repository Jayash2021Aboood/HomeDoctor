<?php

    session_start();
    session_destroy();
    unset($_SESSION["userID"]);
    unset($_SESSION["user"]);
    unset($_SESSION["userType"]);
    $_SESSION["message"] = "You are Logged Out!";
    header('location: login.php');
    
// // لاستخدام الجلسات في الصفحة 
//     session_start();
//     // حذف بيانات الجلسة
//     session_destroy();
//     unset($_SESSION["userID"]);
//     unset($_SESSION["userName"]);
//     unset($_SESSION["userUsername"]);
//     $_SESSION["message"] = "You are Logged Out!";
//     // تحويل المستخدم لصفحة تسجيل الدخول
//     header('location: login.php');




?>