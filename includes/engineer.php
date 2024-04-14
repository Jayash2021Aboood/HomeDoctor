<?php
// ====================================================
// ====================================================
// ======================= Start Engineer Part ===========

class Engineer
{
	public $id;
	public $first_name;
	public $last_name;
	public $phone;
	public $email;
	public $password;
	public $city;
	public $specialty;
	public $date_of_graduate;
	public $experience_years;
	public $cv;
	public $image1;
	public $image2;
	public $image3;
	public $image4;
	public $image5;
	public $image6;
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
			$this->first_name = $row[1];
			$this->last_name = $row[2];
			$this->phone = $row[3];
			$this->email = $row[4];
			$this->password = $row[5];
			$this->city = $row[6];
			$this->specialty = $row[7];
			$this->date_of_graduate = $row[8];
			$this->experience_years = $row[9];
			$this->cv = $row[10];
			$this->image1 = $row[11];
			$this->image2 = $row[12];
			$this->image3 = $row[13];
			$this->image4 = $row[14];
			$this->image5 = $row[15];
			$this->image6 = $row[16];
			$this->state = $row[17];
		}
	}

}

function getAllEngineers()
{
	return selectAndOrder("select * from engineer","id","desc");
}

function getEngineerById($id)
{
	return selectById("*","engineer", $id);
}

function getEngineerByName($search)
{
	return select("SELECT * FROM engineer WHERE name like '%$search%' and active = 1");
}

function addEngineer( $first_name, $last_name, $phone, $email, $password, $city, $specialty, $date_of_graduate, $experience_years, $cv, $image1, $image2, $image3, $image4, $image5, $image6, $state)
{
    $sql = 
		"INSERT INTO engineer VALUES(null,
'$first_name','$last_name','$phone','$email','$password','$city','$specialty','$date_of_graduate','$experience_years','$cv','$image1','$image2','$image3','$image4','$image5','$image6','$state')";	return query($sql);
}

function updateEngineer( $id, $first_name, $last_name, $phone, $email, $password, $city, $specialty, $date_of_graduate, $experience_years, $cv, $image1, $image2, $image3, $image4, $image5, $image6, $state)
{
    $sql = 
		"UPDATE engineer SET 
		first_name = '$first_name'
,		last_name = '$last_name'
,		phone = '$phone'
,		email = '$email'
,		password = '$password'
,		city = '$city'
,		specialty = '$specialty'
,		date_of_graduate = '$date_of_graduate'
,		experience_years = '$experience_years'
,		cv = '$cv'
,		image1 = '$image1'
,		image2 = '$image2'
,		image3 = '$image3'
,		image4 = '$image4'
,		image5 = '$image5'
,		image6 = '$image6'
,		state = '$state'
		WHERE id = $id ";
    return query($sql);
}

function deleteEngineer($id)
{   
     return query("DELETE FROM engineer WHERE id = $id");
}
?>


