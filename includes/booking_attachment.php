<?php
// ====================================================
// ====================================================
// ======================= Start BookingAttachment Part ===========

class BookingAttachment
{
	public $id;
	public $booking_id;
	public $engineer_id;
	public $customer_id;
	public $attachment;

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
			$this->attachment = $row[4];
		}
	}

}

function getAllBookingAttachments()
{
	return selectAndOrder("select * from booking_attachment","id","desc");
}

function getBookingAttachmentById($id)
{
	return selectById("*","booking_attachment", $id);
}

function getBookingAttachmentByName($search)
{
	return select("SELECT * FROM booking_attachment WHERE name like '%$search%' and active = 1");
}

function addBookingAttachment( $booking_id, $engineer_id, $customer_id, $attachment)
{
    $sql = 
		"INSERT INTO booking_attachment VALUES(null,
$booking_id,$engineer_id,$customer_id,'$attachment')";	return query($sql);
}

function updateBookingAttachment( $id, $booking_id, $engineer_id, $customer_id, $attachment)
{
    $sql = 
		"UPDATE booking_attachment SET 
		booking_id = $booking_id
,		engineer_id = $engineer_id
,		customer_id = $customer_id
,		attachment = '$attachment'
		WHERE id = $id ";
    return query($sql);
}

function deleteBookingAttachment($id)
{   
     return query("DELETE FROM booking_attachment WHERE id = $id");
}
?>


