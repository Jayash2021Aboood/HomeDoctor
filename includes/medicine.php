<?php
// ====================================================
// ====================================================
// ======================= Start Medicine Part ===========

class Medicine
{
	public $id;
	public $appointment_id ;
	public $name;
	public $detail;

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
			$this->name = $row[2];
			$this->detail = $row[3];
		}
	}

}

function getAllMedicines()
{
	return selectAndOrder("select * from medicine","id","desc");
}

function getMedicineById($id)
{
	return selectById("*","medicine", $id);
}

function getMedicineByName($search)
{
	return select("SELECT * FROM medicine WHERE name like '%$search%' and active = 1");
}

function addMedicine( $appointment_id , $name, $detail)
{
    $sql = 
		"INSERT INTO medicine VALUES(null,
$appointment_id ,'$name','$detail')";	return query($sql);
}

function updateMedicine( $id, $appointment_id , $name, $detail)
{
    $sql = 
		"UPDATE medicine SET 
		appointment_id  = $appointment_id 
,		name = '$name'
,		detail = '$detail'
		WHERE id = $id ";
    return query($sql);
}

function deleteMedicine($id)
{   
     return query("DELETE FROM medicine WHERE id = $id");
}
?>


