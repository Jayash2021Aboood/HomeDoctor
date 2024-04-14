<?php
// ====================================================
// ====================================================
// ======================= Start Library Part ===========

class Library
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

function getAllLibrarys()
{
	return selectAndOrder("select * from library","id","desc");
}

function getLibraryById($id)
{
	return selectById("*","library", $id);
}

function getLibraryByName($search)
{
	return select("SELECT * FROM library WHERE name like '%$search%' and active = 1");
}

function addLibrary( $name)
{
    $sql = 
		"INSERT INTO library VALUES(null,
'$name')";	return query($sql);
}

function updateLibrary( $id, $name)
{
    $sql = 
		"UPDATE library SET 
		name = '$name'
		WHERE id = $id ";
    return query($sql);
}

function deleteLibrary($id)
{   
     return query("DELETE FROM library WHERE id = $id");
}
?>


