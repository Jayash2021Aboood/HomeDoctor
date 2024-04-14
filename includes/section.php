<?php
// ====================================================
// ====================================================
// ======================= Start Section Part ===========

class Section
{
	public $id;
	public $parent_id;
	public $number;
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
			$this->parent_id = $row[1];
			$this->number = $row[2];
			$this->name = $row[3];
		}
		else if(is_null($row))
		{
			$this->id = 0;
			$this->parent_id = null;
			$this->number = "";
			$this->name = "";
		}
	}

}

function getAllSections()
{
	return selectAndOrder("select * from section","id","desc");
}

function getSectionById($id)
{
	if(isset($id) && !is_null($id))
		return selectById("*","section", $id);
	else
		return array( (array) new Section(null)) ;
}

function getSectionByName($search)
{
	return select("SELECT * FROM section WHERE name like '%$search%' and active = 1");
}

function addSection( $parent_id, $number, $name)
{
	// adding Validation by Dewi Method
	
	// 1- check if there is no 10 brothers sections have the same parent
	if(is_null( $parent_id )){
		$rows = select("SELECT * FROM section WHERE parent_id is NULL;");
		$parent_id = "NULL";
		if(count($rows) >= 10){
			throw new Exception(lang("you cannot add more than 10 main sibiling sections as Dewi Role"));
		}
	}
	else{
		$rows = select("SELECT * FROM section WHERE parent_id = $parent_id;");
		if(count($rows) >= 10){
			throw new Exception(lang("you cannot add more than 10 sub sibiling sections as Dewi Role"));
		}
	}
	
    $sql = "INSERT INTO section VALUES(null, $parent_id,'$number','$name')";
	return query($sql);
}

function updateSection( $id, $parent_id, $number, $name)
{
    $sql = 
		"UPDATE section SET 
		parent_id = $parent_id
,		number = '$number'
,		name = '$name'
		WHERE id = $id ";
    return query($sql);
}

function deleteSection($id)
{   
     return query("DELETE FROM section WHERE id = $id");
}
?>