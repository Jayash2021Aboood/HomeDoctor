<?php
// ====================================================
// ====================================================
// ======================= Start Rating Part ===========

class Rating
{
	public $id;
	public $engineer_id;
	public $customer_id;
	public $rate;

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
			$this->customer_id = $row[2];
			$this->rate = $row[3];
		}
	}

}

function getAllRatings()
{
	return selectAndOrder("select * from rating","id","desc");
}

function getRatingById($id)
{
	return selectById("*","rating", $id);
}

function getRatingByName($search)
{
	return select("SELECT * FROM rating WHERE name like '%$search%' and active = 1");
}

function addRating( $engineer_id, $customer_id, $rate)
{
    $sql = 
		"INSERT INTO rating VALUES(null,
$engineer_id,$customer_id,$rate)";	return query($sql);
}

function updateRating( $id, $engineer_id, $customer_id, $rate)
{
    $sql = 
		"UPDATE rating SET 
		engineer_id = $engineer_id
,		customer_id = $customer_id
,		rate = $rate
		WHERE id = $id ";
    return query($sql);
}

function deleteRating($id)
{   
     return query("DELETE FROM rating WHERE id = $id");
}
?>


