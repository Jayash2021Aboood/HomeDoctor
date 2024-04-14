<?php
// ====================================================
// ====================================================
// ======================= Start Student Part ===========

class Student
{
	public $id;
	public $name;
	public $phone;
	public $email;
	public $password;
	public $department_id;
	public $level_id;
	public $state;
	public $active;

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
			$this->department_id = $row[5];
			$this->level_id = $row[6];
			$this->state = $row[7];
			$this->active = $row[8];
		}
	}

}

function getAllStudents()
{
	return selectAndOrder("select * from student","id","desc");
}

function getStudentById($id)
{
	return selectById("*","student", $id);
}

function getStudentByName($search)
{
	return select("SELECT * FROM student WHERE name like '%$search%' and active = 1");
}

function addStudent( $name, $phone, $email, $password, $department_id, $level_id, $state, $active)
{
    $sql = 
		"INSERT INTO student VALUES(null,
'$name','$phone','$email','$password',$department_id,$level_id,'$state',$active)";	return query($sql);
}

function updateStudent( $id, $name, $phone, $email, $password, $department_id, $level_id, $state, $active)
{
    $sql = 
		"UPDATE student SET 
		name = '$name'
,		phone = '$phone'
,		email = '$email'
,		password = '$password'
,		department_id = $department_id
,		level_id = $level_id
,		state = '$state'
,		active = $active
		WHERE id = $id ";
    return query($sql);
}

function deleteStudent($id)
{   
     return query("DELETE FROM student WHERE id = $id");
}
?>


