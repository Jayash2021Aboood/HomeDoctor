<?php
// ====================================================
// ====================================================
// ======================= Start Book Part ===========

class Book
{
	public $id;
	public $name;
	public $number_copies;
	public $publish_date;
	public $detail;
	public $book_image;
	public $book_file;
	public $author_id;
	public $publisher_id;
	public $section_id;
	public $language_id;

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
			$this->number_copies = $row[2];
			$this->publish_date = $row[3];
			$this->detail = $row[4];
			$this->book_image = $row[5];
			$this->book_file = $row[6];
			$this->author_id = $row[7];
			$this->publisher_id = $row[8];
			$this->section_id = $row[9];
			$this->language_id = $row[10];
		}
	}

}

function getAllBooks()
{
	return selectAndOrder("select * from book","id","desc");
}

function getBookById($id)
{
	return selectById("*","book", $id);
}

function getBookByName($search)
{
	return select("SELECT * FROM book WHERE name like '%$search%' and active = 1");
}

function addBook( $name, $number_copies, $publish_date, $detail, $book_image, $book_file, $author_id, $publisher_id, $section_id, $language_id)
{
    $sql = 
		"INSERT INTO book VALUES(null,
'$name',$number_copies,'$publish_date','$detail','$book_image','$book_file',$author_id,$publisher_id,$section_id,$language_id)";	return query($sql);
}

function updateBook( $id, $name, $number_copies, $publish_date, $detail, $book_image, $book_file, $author_id, $publisher_id, $section_id, $language_id)
{
    $sql = 
		"UPDATE book SET 
		name = '$name'
,		number_copies = $number_copies
,		publish_date = '$publish_date'
,		detail = '$detail'
,		book_image = '$book_image'
,		book_file = '$book_file'
,		author_id = $author_id
,		publisher_id = $publisher_id
,		section_id = $section_id
,		language_id = $language_id
		WHERE id = $id ";
    return query($sql);
}

function deleteBook($id)
{   
     return query("DELETE FROM book WHERE id = $id");
}
?>


