<?php

include("config.php");
include('myFunctions.php');




// ====================================================
// ====================================================
// ====================  Genral Method ==============

function select($statment)
{
    global $mysqlilink;
    $query = $statment;
    $res = mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>"); 

	$list = [];
    while($row=mysqli_fetch_array($res,MYSQLI_BOTH))
    {
      $list[] = $row;
	} 

	 return $list;
}

function selectByCondition($columns ,$table, $where = "")
{   
    return select("select $columns from $table $where");
}

function selectById($columns ,$table, $id)
{   
    return selectByCondition($columns, $table, "where id = $id");
}

function selectAndOrder($statment ,$columns = "id" , $type = "asc")
{   
    return select("$statment order by $columns $type");
}




function insert($statment)
{
    global $mysqlilink;
    $query = $statment;
    return  mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>".'<p>'.$statment.'</p>' );

}

function query($statment)
{
    global $mysqlilink;
    $query = $statment;
    $result =  mysqli_query($mysqlilink,$query) or die('<center><div>wrong in connect with server</div>'.mysqli_error($mysqlilink)."</center>".'<p>'.$statment.'</p>' );
	
	if($result == false)
		echo mysqli_error($mysqlilink);
	return $result;
}


// ====================================================
// ====================================================
// ====================  Login Method ==============


function loginAdmin($username, $password)
{
	return select("SELECT * FROM admin WHERE username LIKE '$username' AND password LIKE '$password'");
}

// ====================================================
// ====================================================
// ====================  Addtional Method ==============


function isUserExist($email)
{
    $webusers =  select("SELECT COUNT(id) as total FROM webuser WHERE email = '$email';");
    $admins =  select("SELECT COUNT(id) as total FROM admin WHERE email = '$email';");
    $patients =  select("SELECT COUNT(id) as total FROM patient WHERE email = '$email';");
    $doctors =  select("SELECT COUNT(id) as total FROM doctor WHERE email = '$email';");
    $nurses =  select("SELECT COUNT(id) as total FROM nurse WHERE email = '$email';");

    if( $webusers[0]["total"] > 0  ||
        $admins[0]["total"] > 0 ||
        $doctors[0]["total"] > 0||
        $nurses[0]["total"] > 0||
        $patients[0]["total"] > 0
        ) 
    {
        return true;
    }
    else
    {
        return false;
    }
}

?>