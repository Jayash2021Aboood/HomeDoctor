<?php
// ====================================================
// ====================================================
// ======================= Start Doctor Part ===========

class Doctor
{
	public $id;
	public $first_name;
	public $last_name;
	public $phone;
	public $email;
	public $password;
	public $location;
	public $specialty;
	public $date_of_graduate;
	public $experience_years;
	public $cv;
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
			$this->location = $row[6];
			$this->specialty = $row[7];
			$this->date_of_graduate = $row[8];
			$this->experience_years = $row[9];
			$this->cv = $row[10];
			$this->state = $row[11];
		}
	}

}

function getAllDoctors()
{
	return selectAndOrder("select * from doctor","id","desc");
}

function getDoctorById($id)
{
	return selectById("*","doctor", $id);
}

function getDoctorByName($search)
{
	return select("SELECT * FROM doctor WHERE name like '%$search%' and active = 1");
}

function addDoctor( $first_name, $last_name, $phone, $email, $password, $location, $specialty, $date_of_graduate, $experience_years, $cv, $state)
{
    $sql = 
		"INSERT INTO doctor VALUES(null,
'$first_name','$last_name','$phone','$email','$password','$location','$specialty','$date_of_graduate','$experience_years','$cv','$state')";	return query($sql);
}

function updateDoctor( $id, $first_name, $last_name, $phone, $email, $password, $location, $specialty, $date_of_graduate, $experience_years, $cv, $state)
{
    $sql = 
		"UPDATE doctor SET 
		first_name = '$first_name'
,		last_name = '$last_name'
,		phone = '$phone'
,		email = '$email'
,		password = '$password'
,		location = '$location'
,		specialty = '$specialty'
,		date_of_graduate = '$date_of_graduate'
,		experience_years = '$experience_years'
,		cv = '$cv'
,		state = '$state'
		WHERE id = $id ";
    return query($sql);
}

function deleteDoctor($id)
{   
     return query("DELETE FROM doctor WHERE id = $id");
}
?>