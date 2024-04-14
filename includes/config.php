<?php
	$localhost = "localhost";
	$DBusername = "root";
	$dbname = "bayda_library";
	$pwd="";

	$mysqlilink = @mysqli_connect($localhost,$DBusername,$pwd)or die('<center><div>wrong in connect with server</div>'.mysqli_connect_error()."</center>");


	@mysqli_select_db($mysqlilink,$dbname)or die('<center><div>wrong in connect with database</div>'.mysqli_connect_error($mysqlilink)."</center>");

	@mysqli_set_charset($mysqlilink,"UTF8")or die('<center><div>wrong </div>'.mysqli_connect_error($mysqlilink)."</center>");


	//  ======================  Start Path ============================
	//  ====================== =========== ============================

	// HTTP
	// define('HTTP_SERVER', 'http://localhost/BaydaLibrary/admin/');
	$PATH_SERVER 			= 'http://localhost/BaydaLibrary/';
	$PATH_PHOTOES 			= $PATH_SERVER . 'photoes/';
	$PATH_ATTACHMENTS 		= $PATH_SERVER . 'attachments/';

	$PATH_ADMIN 			= $PATH_SERVER . 'admin/';
	// $PATH_CUSTOMER 			= $PATH_SERVER . 'customer/';
	$PATH_STUDENT 			= $PATH_SERVER . 'student/';
	$PATH_EMPLOYEE 			= $PATH_SERVER . 'employee/';

	$PATH_EMPLOYEE_AUTHOR = $PATH_EMPLOYEE . 'author/';
	$PATH_EMPLOYEE_BOOK = $PATH_EMPLOYEE . 'book/';
	$PATH_EMPLOYEE_COLLEGE = $PATH_EMPLOYEE . 'college/';
	$PATH_EMPLOYEE_DEPARTMENT = $PATH_EMPLOYEE . 'department/';
	$PATH_EMPLOYEE_EMPLOYEE = $PATH_EMPLOYEE . 'employee/';
	$PATH_EMPLOYEE_FINE = $PATH_EMPLOYEE . 'fine/';
	$PATH_EMPLOYEE_ISSUE = $PATH_EMPLOYEE . 'issue/';
	$PATH_EMPLOYEE_LANGUAGE = $PATH_EMPLOYEE . 'language/';
	$PATH_EMPLOYEE_LEVEL = $PATH_EMPLOYEE . 'level/';
	$PATH_EMPLOYEE_LIBRARY = $PATH_EMPLOYEE . 'library/';
	$PATH_EMPLOYEE_PUBLISHER = $PATH_EMPLOYEE . 'publisher/';
	$PATH_EMPLOYEE_SECTION = $PATH_EMPLOYEE . 'section/';
	$PATH_EMPLOYEE_SETTING = $PATH_EMPLOYEE . 'setting/';
	$PATH_EMPLOYEE_STUDENT = $PATH_EMPLOYEE . 'student/';

	$PATH_ENGINEER 			= $PATH_SERVER . 'engineer/';
	$PATH_ENGINEER_BOOKING 			= $PATH_ENGINEER . 'booking/';
	$PATH_ENGINEER_SERVICE 			= $PATH_ENGINEER . 'service/';

	$PATH_ADMIN_ADMIN 	= $PATH_ADMIN . 'admin/';
	$PATH_ADMIN_SCHOOL 	= $PATH_ADMIN . 'school/';

	$PATH_ADMIN_ADMIN = $PATH_ADMIN . 'admin/';
	$PATH_ADMIN_BOOKING = $PATH_ADMIN . 'booking/';
	$PATH_ADMIN_CUSTOMER = $PATH_ADMIN . 'customer/';
	$PATH_ADMIN_ENGINEER = $PATH_ADMIN . 'engineer/';
	$PATH_ADMIN_RATING = $PATH_ADMIN . 'rating/';
	$PATH_ADMIN_SERVICE = $PATH_ADMIN . 'service/';
	$PATH_ADMIN_SERVICE_TYPE = $PATH_ADMIN . 'service_type/';

	$PATH_ADMIN_AUTHOR = $PATH_ADMIN . 'author/';
	$PATH_ADMIN_BOOK = $PATH_ADMIN . 'book/';
	$PATH_ADMIN_COLLEGE = $PATH_ADMIN . 'college/';
	$PATH_ADMIN_DEPARTMENT = $PATH_ADMIN . 'department/';
	$PATH_ADMIN_EMPLOYEE = $PATH_ADMIN . 'employee/';
	$PATH_ADMIN_FINE = $PATH_ADMIN . 'fine/';
	$PATH_ADMIN_ISSUE = $PATH_ADMIN . 'issue/';
	$PATH_ADMIN_LANGUAGE = $PATH_ADMIN . 'language/';
	$PATH_ADMIN_LEVEL = $PATH_ADMIN . 'level/';
	$PATH_ADMIN_LIBRARY = $PATH_ADMIN . 'library/';
	$PATH_ADMIN_PUBLISHER = $PATH_ADMIN . 'publisher/';
	$PATH_ADMIN_SECTION = $PATH_ADMIN . 'section/';
	$PATH_ADMIN_SETTING = $PATH_ADMIN . 'setting/';
	$PATH_ADMIN_STUDENT = $PATH_ADMIN . 'student/';
	
	
	$PATH_ADMIN_INCLUDES 			= $PATH_ADMIN . 'includes/';
	$PATH_ADMIN_TEMPLATE 			= $PATH_ADMIN . 'template/';
	$PATH_ADMIN_PHOTOES 			= $PATH_ADMIN . 'photoes/';
	$PATH_ADMIN_LANG 			    = $PATH_ADMIN . 'lang/';
	

	// DIR
	define('DIR_APPLICATION', 'C:/xampp/htdocs/BaydaLibrary/');
	define('DIR_ADMIN', 'C:/xampp/htdocs/BaydaLibrary/admin/');
	define('DIR_ADMIN_INCLUDES', 'C:/xampp/htdocs/BaydaLibrary/admin/includes/');
	define('DIR_ADMIN_TEMPLATE', 'C:/xampp/htdocs/BaydaLibrary/admin/template/');
	define('DIR_ADMIN_PHOTOES', 'C:/xampp/htdocs/BaydaLibrary/admin/photoes/');
	define('DIR_PHOTOES', 'C:/xampp/htdocs/BaydaLibrary/photoes/');
	define('DIR_LANG', 'C:/xampp/htdocs/BaydaLibrary/lang/');
	define('DIR_ATTACHMENTS', 'C:/xampp/htdocs/BaydaLibrary/attachments/');



	//  ======================  End  Path =============================
	//  ====================== =========== ============================


	//  ======================  Start Function ============================
	//  ====================== =============== ============================
	function getTitle() {

		global $pageTitle;

		if (isset($pageTitle)) {

			echo $pageTitle;

		} else {

			echo 'Default';

		}
	}


  function checkAdminSession($path = "http://localhost/BaydaLibrary/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'a')
			{
				header('Location:'. $path . $page);
			}
  }

  function checkEmployeeSession($path = "http://localhost/BaydaLibrary/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'e')
			{
				header('Location:'. $path . $page);
			}
  }

  function checkStudentSession($path = "http://localhost/BaydaLibrary/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 's')
			{
				header('Location:'. $path . $page);
			}
  }

  function isLogin()
  {
	if(isset($_SESSION['user']))
	{
		if(isset($_SESSION['userType']))
		{
			if($_SESSION['userType'] == 'a' || $_SESSION['userType'] == 's' || $_SESSION['userType'] == 'e')
			{
				return true;
			}
		}
	}
	return false;	
  }

  function getLoginType()
  {
	if(isLogin())
	{
		return $_SESSION['userType'];
	}
	else
	{
		return null;
	}
  }

  function isAdmin() { if(getLoginType() == 'a') return true; }
//   function isEngineer() { if(getLoginType() == 'e') return true; }
  function isEmployee() { if(getLoginType() == 'e') return true; }
//   function isCustomer() { if(getLoginType() == 'c') return true; }
  function isStudent() { if(getLoginType() == 's') return true; }
  function getLoginEmail() { return $_SESSION['user'] ;}

//   function checkAdminSession($path = "http://localhost/BaydaLibrary/" , $page = "login.php")
//   {
// 	// global $PATH_ADMIN;
//     // if(isset($loginRequire))
//     // {
//     //     if($loginRequire == true)
//     //     {
//             if (!(isset($_SESSION['adminID'])) || !(isset($_SESSION['adminName']))) 
//             {
//                 //header('Location:'. $path .'login.php');
//                 header('Location:'. $path . $page);
//                 //echo $_SESSION['adminID'];
//                 //echo '<script> window.location.replace("login.php"); </script>';
//             }
//     //     }
//     // }
//   }
	//  ======================  End Function ============================
	//  ====================== ============= ============================
?>