<?php
// ====================================================
// ====================================================
// ======================= Start BookingNote Part ===========

class BookingNote
{
	public $id;
	public $booking_id;
	public $engineer_id;
	public $customer_id;
	public $note;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->booking_id = $row[1];
			$this->engineer_id = $row[2];
			$this->customer_id = $row[3];
			$this->note = $row[4];
		}
	}

}

function getAllBookingNotes()
{
	return selectAndOrder("select * from booking_note","id","desc");
}

function getBookingNoteById($id)
{
	return selectById("*","booking_note", $id);
}

function getBookingNoteByName($search)
{
	return select("SELECT * FROM booking_note WHERE name like '%$search%' and active = 1");
}

function addBookingNote( $booking_id, $engineer_id, $customer_id, $note)
{
    $sql = 
		"INSERT INTO booking_note VALUES(null,
$booking_id,$engineer_id,$customer_id,'$note')";	return query($sql);
}

function updateBookingNote( $id, $booking_id, $engineer_id, $customer_id, $note)
{
    $sql = 
		"UPDATE booking_note SET 
		booking_id = $booking_id
,		engineer_id = $engineer_id
,		customer_id = $customer_id
,		note = '$note'
		WHERE id = $id ";
    return query($sql);
}

function deleteBookingNote($id)
{   
     return query("DELETE FROM booking_note WHERE id = $id");
}
?>


