<?php
// ====================================================
// ====================================================
// ======================= Start Setting Part ===========

class Setting
{
	public $id;
	public $appointment_price;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->appointment_price = $row[1];
		}
	}

}

function getAllSettings()
{
	return selectAndOrder("select * from setting","id","desc");
}

function getSettingById($id)
{
	return selectById("*","setting", $id);
}

function getSettingByName($search)
{
	return select("SELECT * FROM setting WHERE name like '%$search%' and active = 1");
}

function addSetting($appointment_price)
{
    $sql = 
		"INSERT INTO setting VALUES(null,
$appointment_price)";	return query($sql);
}

function updateSetting( $id, $appointment_price)
{
    $sql = 
		"UPDATE setting SET 
		 appointment_price = $appointment_price
		 WHERE id = $id ";
    return query($sql);
}


function AddOrUpdateSetting($appointment_price)
{
	$setting = GetSetting();
	if(is_null($setting) || empty($setting) || count($setting) == 0){
		$sql = 
			"INSERT INTO setting VALUES(null,
			$appointment_price)";
	}
	else{
		$sql = "UPDATE setting 
			SET appointment_price = $appointment_price
			WHERE id = " . $setting[0]['id'] . ";";
	}
    return query($sql);
}

function GetSetting() 
{
    return select("SELECT * From setting LIMIT 1;");
}

?>