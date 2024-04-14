<?php
// ====================================================
// ====================================================
// ======================= Start Department Part ===========

class Department
{
	public $id;
	public $college_id;
	public $name;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->college_id = $row[1];
			$this->name = $row[2];
		}
	}

}

function getAllDepartments()
{
	return selectAndOrder("select * from department","id","desc");
}

function getDepartmentById($id)
{
	return selectById("*","department", $id);
}

function getDepartmentByName($search)
{
	return select("SELECT * FROM department WHERE name like '%$search%' and active = 1");
}

function addDepartment( $college_id, $name)
{
    $sql = 
		"INSERT INTO department VALUES(null,
$college_id,'$name')";	return query($sql);
}

function updateDepartment( $id, $college_id, $name)
{
    $sql = 
		"UPDATE department SET 
		college_id = $college_id
,		name = '$name'
		WHERE id = $id ";
    return query($sql);
}

function deleteDepartment($id)
{   
     return query("DELETE FROM department WHERE id = $id");
}
?>


