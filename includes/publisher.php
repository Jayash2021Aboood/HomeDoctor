<?php
// ====================================================
// ====================================================
// ======================= Start Publisher Part ===========

class Publisher
{
	public $id;
	public $name;
	public $phone;
	public $email;
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
			$this->address = $row[4];
		}
	}

}

function getAllPublishers()
{
	return selectAndOrder("select * from publisher","id","desc");
}

function getPublisherById($id)
{
	return selectById("*","publisher", $id);
}

function getPublisherByName($search)
{
	return select("SELECT * FROM publisher WHERE name like '%$search%' and active = 1");
}

function addPublisher( $name, $phone, $email, $address)
{
    $sql = 
		"INSERT INTO publisher VALUES(null,
'$name','$phone','$email','$address')";	return query($sql);
}

function updatePublisher( $id, $name, $phone, $email, $address)
{
    $sql = 
		"UPDATE publisher SET 
		name = '$name'
,		phone = '$phone'
,		email = '$email'
,		address = '$address'
		WHERE id = $id ";
    return query($sql);
}

function deletePublisher($id)
{   
     return query("DELETE FROM publisher WHERE id = $id");
}
?>


