<?php
// ====================================================
// ====================================================
// ======================= Start Appointment Part ===========

class Appointment
{
	public $id;
	public $detail;
	public $patient_id ;
	public $doctor_id;
	public $nurse_id;
	public $appointment_date;
	public $price;
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
			$this->detail = $row[1];
			$this->patient_id  = $row[2];
			$this->doctor_id = $row[3];
			$this->nurse_id = $row[4];
			$this->appointment_date = $row[5];
			$this->price = $row[6];
			$this->state = $row[7];
		}
	}

}

function getAllAppointments()
{
	return selectAndOrder("select * from appointment","id","desc");
}

function getAppointmentById($id)
{
	return selectById("*","appointment", $id);
}

function getAppointmentByName($search)
{
	return select("SELECT * FROM appointment WHERE name like '%$search%' and active = 1");
}

function addAppointment( $detail, $patient_id , $doctor_id, $nurse_id, $appointment_date, $price, $state)
{
    $sql = 
		"INSERT INTO appointment VALUES(null,
'$detail',$patient_id ,$doctor_id,$nurse_id,'$appointment_date',$price,'$state')";	return query($sql);
}

function updateAppointment( $id, $detail, $patient_id , $doctor_id, $nurse_id, $appointment_date, $price, $state)
{
    $sql = 
		"UPDATE appointment SET 
		detail = '$detail'
,		patient_id  = $patient_id 
,		doctor_id = $doctor_id
,		nurse_id = $nurse_id
,		appointment_date = '$appointment_date'
,		price = $price
,		state = '$state'
		WHERE id = $id ";
    return query($sql);
}

function deleteAppointment($id)
{   
     return query("DELETE FROM appointment WHERE id = $id");
}
?>


