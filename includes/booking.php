<?php
// ====================================================
// ====================================================
// ======================= Start Booking Part ===========

class Booking
{
	public $id;
	public $engineer_id;
	public $service_id;
	public $customer_id;
	public $card_number;
	public $service_price;
	public $paid_price;
	public $detail;
	public $booking_date;
	public $state;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->engineer_id = $row[1];
			$this->service_id = $row[2];
			$this->customer_id = $row[3];
			$this->card_number = $row[4];
			$this->service_price = $row[5];
			$this->paid_price = $row[6];
			$this->detail = $row[7];
			$this->booking_date = $row[8];
			$this->state = $row[9];
		}
	}

}

function getAllBookings()
{
	return selectAndOrder("select * from booking","id","desc");
}

function getBookingById($id)
{
	return selectById("*","booking", $id);
}

function getBookingByName($search)
{
	return select("SELECT * FROM booking WHERE name like '%$search%' and active = 1");
}

function addBooking( $engineer_id, $service_id, $customer_id, $card_number, $service_price, $paid_price, $detail, $booking_date, $state)
{
    $sql = 
		"INSERT INTO booking VALUES(null,
$engineer_id,$service_id,$customer_id,'$card_number',$service_price,$paid_price,'$detail','$booking_date','$state')";	return query($sql);
}

function updateBooking( $id, $engineer_id, $service_id, $customer_id, $card_number, $service_price, $paid_price, $detail, $booking_date, $state)
{
    $sql = 
		"UPDATE booking SET 
		engineer_id = $engineer_id
,		service_id = $service_id
,		customer_id = $customer_id
,		card_number = '$card_number'
,		service_price = $service_price
,		paid_price = $paid_price
,		detail = '$detail'
,		booking_date = '$booking_date'
,		state = '$state'
		WHERE id = $id ";
    return query($sql);
}

function deleteBooking($id)
{   
     return query("DELETE FROM booking WHERE id = $id");
}
?>


