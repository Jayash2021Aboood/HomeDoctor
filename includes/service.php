<?php
// ====================================================
// ====================================================
// ======================= Start Service Part ===========

class Service
{
	public $id;
	public $engineer_id;
	public $service_type_id;
	public $name;
	public $price;
	public $detail;
	public $image;

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
			$this->service_type_id = $row[2];
			$this->name = $row[3];
			$this->price = $row[4];
			$this->detail = $row[5];
			$this->image = $row[6];
		}
	}

}

function getAllServices()
{
	return selectAndOrder("select * from service","id","desc");
}

function getServiceById($id)
{
	return selectById("*","service", $id);
}

function getServiceByName($search)
{
	return select("SELECT * FROM service WHERE name like '%$search%' and active = 1");
}

function addService( $engineer_id, $service_type_id, $name, $price, $detail, $image)
{
    $sql = 
		"INSERT INTO service VALUES(null,
$engineer_id,$service_type_id,'$name',$price,'$detail','$image')";	return query($sql);
}

function updateService( $id, $engineer_id, $service_type_id, $name, $price, $detail, $image)
{
    $sql = 
		"UPDATE service SET 
		engineer_id = $engineer_id
,		service_type_id = $service_type_id
,		name = '$name'
,		price = $price
,		detail = '$detail'
,		image = '$image'
		WHERE id = $id ";
    return query($sql);
}

function deleteService($id)
{   
     return query("DELETE FROM service WHERE id = $id");
}
?>


