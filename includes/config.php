<?php
	$localhost = "localhost";
	$DBusername = "root";
	$dbname = "homedoctor";
	$pwd="";

	$mysqlilink = @mysqli_connect($localhost,$DBusername,$pwd)or die('<center><div>wrong in connect with server</div>'.mysqli_connect_error()."</center>");


	@mysqli_select_db($mysqlilink,$dbname)or die('<center><div>wrong in connect with database</div>'.mysqli_connect_error($mysqlilink)."</center>");

	@mysqli_set_charset($mysqlilink,"UTF8")or die('<center><div>wrong </div>'.mysqli_connect_error($mysqlilink)."</center>");


	//  ======================  Start Path ============================
	//  ====================== =========== ============================

	// HTTP
	// define('HTTP_SERVER', 'http://localhost/HomeDoctor/admin/');
	$PATH_SERVER 			= 'http://localhost/HomeDoctor/';
	$PATH_PHOTOES 			= $PATH_SERVER . 'photoes/';
	$PATH_ATTACHMENTS 		= $PATH_SERVER . 'attachments/';

	$PATH_ADMIN 			= $PATH_SERVER . 'admin/';
	$PATH_PATIENT 			= $PATH_SERVER . 'patient/';
	$PATH_DOCTOR 			= $PATH_SERVER . 'doctor/';
	$PATH_NURSE 			= $PATH_SERVER . 'nurse/';

	$PATH_ADMIN_ADMIN 	= $PATH_ADMIN . 'admin/';
	$PATH_ADMIN_APPOINTMENT = $PATH_ADMIN . 'appointment/';
	$PATH_ADMIN_DOCTOR = $PATH_ADMIN . 'doctor/';
	$PATH_ADMIN_NURSE = $PATH_ADMIN . 'nurse/';
	$PATH_ADMIN_MEDICINE = $PATH_ADMIN . 'medicine/';
	$PATH_ADMIN_PATIENT = $PATH_ADMIN . 'patient/';
	$PATH_ADMIN_PAYMENT = $PATH_ADMIN . 'payment/';
	$PATH_ADMIN_SETTING = $PATH_ADMIN . 'setting/';
	
	
	$PATH_ADMIN_INCLUDES 			= $PATH_ADMIN . 'includes/';
	$PATH_ADMIN_TEMPLATE 			= $PATH_ADMIN . 'template/';
	$PATH_ADMIN_PHOTOES 			= $PATH_ADMIN . 'photoes/';
	$PATH_ADMIN_LANG 			    = $PATH_ADMIN . 'lang/';
	

	// DIR
	define('DIR_APPLICATION', 'C:/xampp/htdocs/HomeDoctor/');
	define('DIR_ADMIN', 'C:/xampp/htdocs/HomeDoctor/admin/');
	define('DIR_ADMIN_INCLUDES', 'C:/xampp/htdocs/HomeDoctor/admin/includes/');
	define('DIR_ADMIN_TEMPLATE', 'C:/xampp/htdocs/HomeDoctor/admin/template/');
	define('DIR_ADMIN_PHOTOES', 'C:/xampp/htdocs/HomeDoctor/admin/photoes/');
	define('DIR_PHOTOES', 'C:/xampp/htdocs/HomeDoctor/photoes/');
	define('DIR_LANG', 'C:/xampp/htdocs/HomeDoctor/lang/');
	define('DIR_ATTACHMENTS', 'C:/xampp/htdocs/HomeDoctor/attachments/');



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


  function checkAdminSession($path = "http://localhost/HomeDoctor/" , $page = "login.php")
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

  function checkPatientSession($path = "http://localhost/HomeDoctor/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'p')
			{
				header('Location:'. $path . $page);
			}
  }

  function checkDoctorSession($path = "http://localhost/HomeDoctor/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'd')
			{
				header('Location:'. $path . $page);
			}
  }

  function checkNurseSession($path = "http://localhost/HomeDoctor/" , $page = "login.php")
  {
            if (!isset($_SESSION['user']))
            {
				header('Location:'. $path . $page);
            }
			if (!(isset($_SESSION['userType'])))
			{
				header('Location:'. $path . $page);
			} 
			if($_SESSION['userType'] != 'n')
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
			if($_SESSION['userType'] == 'a' || 
			   $_SESSION['userType'] == 'p' ||
			   $_SESSION['userType'] == 'd' ||
			   $_SESSION['userType'] == 'n' 
			   )
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
  function isPatient() { if(getLoginType() == 'p') return true; }
  function isDoctor() { if(getLoginType() == 'd') return true; }
  function isNurse() { if(getLoginType() == 'n') return true; }
  function getLoginEmail() { return $_SESSION['user'] ;}

//   function checkAdminSession($path = "http://localhost/HomeDoctor/" , $page = "login.php")
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