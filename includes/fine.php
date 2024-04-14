<?php
// ====================================================
// ====================================================
// ======================= Start Fine Part ===========

class Fine
{
	public $id;
	public $issue_id;
	public $student_id;
	public $amount;
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
			$this->issue_id = $row[1];
			$this->student_id = $row[2];
			$this->amount = $row[3];
			$this->state = $row[4];
		}
	}

}

function getAllFines()
{
	return selectAndOrder("select * from fine","id","desc");
}

function getFineById($id)
{
	return selectById("*","fine", $id);
}

function getFineByName($search)
{
	return select("SELECT * FROM fine WHERE name like '%$search%' and active = 1");
}

function addFine( $issue_id, $student_id, $amount, $state)
{
    $sql = 
		"INSERT INTO fine VALUES(null,
$issue_id,$student_id,$amount,'$state')";	return query($sql);
}

function updateFine( $id, $issue_id, $student_id, $amount, $state)
{
    $sql = 
		"UPDATE fine SET 
		issue_id = $issue_id
,		student_id = $student_id
,		amount = $amount
,		state = '$state'
		WHERE id = $id ";
    return query($sql);
}

function deleteFine($id)
{   
     return query("DELETE FROM fine WHERE id = $id");
}
?>


