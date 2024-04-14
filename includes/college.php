<?php
// ====================================================
// ====================================================
// ======================= Start College Part ===========

class College
{
	public $id;
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
			$this->name = $row[1];
		}
	}

}

function getAllColleges()
{
	return selectAndOrder("select * from college","id","desc");
}

function getCollegeById($id)
{
	return selectById("*","college", $id);
}

function getCollegeByName($search)
{
	return select("SELECT * FROM college WHERE name like '%$search%' and active = 1");
}

function addCollege( $name)
{
    $sql = 
		"INSERT INTO college VALUES(null,
'$name')";	return query($sql);
}

function updateCollege( $id, $name)
{
    $sql = 
		"UPDATE college SET 
		name = '$name'
		WHERE id = $id ";
    return query($sql);
}

function deleteCollege($id)
{   
     return query("DELETE FROM college WHERE id = $id");
}
?>


