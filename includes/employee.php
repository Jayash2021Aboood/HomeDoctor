<?php
// ====================================================
// ====================================================
// ======================= Start Employee Part ===========

class Employee
{
	public $id;
	public $name;
	public $phone;
	public $email;
	public $password;
	public $address;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->name = $row[1];
			$this->phone = $row[2];
			$this->email = $row[3];
			$this->password = $row[4];
			$this->address = $row[5];
		}
	}

}

function getAllEmployees()
{
	return selectAndOrder("select * from employee","id","desc");
}

function getEmployeeById($id)
{
	return selectById("*","employee", $id);
}

function getEmployeeByName($search)
{
	return select("SELECT * FROM employee WHERE name like '%$search%' and active = 1");
}

function addEmployee( $name, $phone, $email, $password, $address)
{
    $sql = 
		"INSERT INTO employee VALUES(null,
'$name','$phone','$email','$password','$address')";	return query($sql);
}

function updateEmployee( $id, $name, $phone, $email, $password, $address)
{
    $sql = 
		"UPDATE employee SET 
		name = '$name'
,		phone = '$phone'
,		email = '$email'
,		password = '$password'
,		address = '$address'
		WHERE id = $id ";
    return query($sql);
}

function deleteEmployee($id)
{   
     return query("DELETE FROM employee WHERE id = $id");
}
?>


