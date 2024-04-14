<?php
// ====================================================
// ====================================================
// ======================= Start Level Part ===========

class Level
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

function getAllLevels()
{
	return selectAndOrder("select * from level","id","desc");
}

function getLevelById($id)
{
	return selectById("*","level", $id);
}

function getLevelByName($search)
{
	return select("SELECT * FROM level WHERE name like '%$search%' and active = 1");
}

function addLevel( $name)
{
    $sql = 
		"INSERT INTO level VALUES(null,
'$name')";	return query($sql);
}

function updateLevel( $id, $name)
{
    $sql = 
		"UPDATE level SET 
		name = '$name'
		WHERE id = $id ";
    return query($sql);
}

function deleteLevel($id)
{   
     return query("DELETE FROM level WHERE id = $id");
}
?>


