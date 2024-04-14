<?php
// ====================================================
// ====================================================
// ======================= Start Author Part ===========

class Author
{
	public $id;
	public $name;
	public $phone;
	public $email;
	public $address;
	public $nationality;

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
			$this->nationality = $row[5];
		}
	}

}

function getAllAuthors()
{
	return selectAndOrder("select * from author","id","desc");
}

function getAuthorById($id)
{
	return selectById("*","author", $id);
}

function getAuthorByName($search)
{
	return select("SELECT * FROM author WHERE name like '%$search%' and active = 1");
}

function addAuthor( $name, $phone, $email, $address, $nationality)
{
    $sql = 
		"INSERT INTO author VALUES(null,
'$name','$phone','$email','$address','$nationality')";	return query($sql);
}

function updateAuthor( $id, $name, $phone, $email, $address, $nationality)
{
    $sql = 
		"UPDATE author SET 
		name = '$name'
,		phone = '$phone'
,		email = '$email'
,		address = '$address'
,		nationality = '$nationality'
		WHERE id = $id ";
    return query($sql);
}

function deleteAuthor($id)
{   
     return query("DELETE FROM author WHERE id = $id");
}
?>


