<?php
// ====================================================
// ====================================================
// ======================= Start Payment Part ===========

class Payment
{
	public $id;
	public $appointment_id ;
	public $paid_price;
	public $payment_method;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->appointment_id  = $row[1];
			$this->paid_price = $row[2];
			$this->payment_method = $row[3];
		}
	}

}

function getAllPayments()
{
	return selectAndOrder("select * from payment","id","desc");
}

function getPaymentById($id)
{
	return selectById("*","payment", $id);
}

function getPaymentByName($search)
{
	return select("SELECT * FROM payment WHERE name like '%$search%' and active = 1");
}

function addPayment( $appointment_id , $paid_price, $payment_method)
{
    $sql = 
		"INSERT INTO payment VALUES(null,
$appointment_id ,$paid_price,'$payment_method')";	return query($sql);
}

function updatePayment( $id, $appointment_id , $paid_price, $payment_method)
{
    $sql = 
		"UPDATE payment SET 
		appointment_id  = $appointment_id 
,		paid_price = $paid_price
,		payment_method = '$payment_method'
		WHERE id = $id ";
    return query($sql);
}

function deletePayment($id)
{   
     return query("DELETE FROM payment WHERE id = $id");
}
?>