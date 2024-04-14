<?php
// ====================================================
// ====================================================
// ======================= Start Patient Part ===========

class Patient
{
	public $id;
	public $first_name;
	public $last_name;
	public $phone;
	public $email;
	public $password;
	public $location;
	public $date_of_birth;
	public $height;
	public $weight;
	public $has_chronic_disease;
	public $what_are_diseases;
	public $has_allergic_to_anything;
	public $what_are_things;

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
			$this->date_of_birth = $row[7];
			$this->height = $row[8];
			$this->weight = $row[9];
			$this->has_chronic_disease = $row[10];
			$this->what_are_diseases = $row[11];
			$this->has_allergic_to_anything = $row[12];
			$this->what_are_things = $row[13];
		}
	}

}

function getAllPatients()
{
	return selectAndOrder("select * from patient","id","desc");
}

function getPatientById($id)
{
	return selectById("*","patient", $id);
}

function getPatientByName($search)
{
	return select("SELECT * FROM patient WHERE name like '%$search%' and active = 1");
}

function addPatient( $first_name, $last_name, $phone, $email, $password, $location, $date_of_birth, $height, $weight, $has_chronic_disease, $what_are_diseases, $has_allergic_to_anything, $what_are_things)
{
    $sql = 
		"INSERT INTO patient VALUES(null,
'$first_name','$last_name','$phone','$email','$password','$location','$date_of_birth',$height,$weight,$has_chronic_disease,'$what_are_diseases',$has_allergic_to_anything,'$what_are_things')";	return query($sql);
}

function updatePatient( $id, $first_name, $last_name, $phone, $email, $password, $location, $date_of_birth, $height, $weight, $has_chronic_disease, $what_are_diseases, $has_allergic_to_anything, $what_are_things)
{
    $sql = 
		"UPDATE patient SET 
		first_name = '$first_name'
,		last_name = '$last_name'
,		phone = '$phone'
,		email = '$email'
,		password = '$password'
,		location = '$location'
,		date_of_birth = '$date_of_birth'
,		height = $height
,		weight = $weight
,		has_chronic_disease = $has_chronic_disease
,		what_are_diseases = '$what_are_diseases'
,		has_allergic_to_anything = $has_allergic_to_anything
,		what_are_things = '$what_are_things'
		WHERE id = $id ";
    return query($sql);
}

function deletePatient($id)
{   
     return query("DELETE FROM patient WHERE id = $id");
}
?>


