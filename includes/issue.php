<?php
// ====================================================
// ====================================================
// ======================= Start Issue Part ===========

class Issue
{
	public $id;
	public $book_id;
	public $student_id;
	public $issue_date;
	public $due_date;
	public $return_date;
	public $fine_per_day;
	public $total_fine;

	function __construct($row)
	{
		$this->setData($row);
	}
	
	function setData($row)
	{
		if(is_array($row))
		{
			$this->id = $row[0];
			$this->book_id = $row[1];
			$this->student_id = $row[2];
			$this->issue_date = $row[3];
			$this->due_date = $row[4];
			$this->return_date = $row[5];
			$this->fine_per_day = $row[6];
			$this->total_fine = $row[7];
		}
	}

}

function getAllIssues()
{
	return selectAndOrder("select * from issue","id","desc");
}

function getIssueById($id)
{
	return selectById("*","issue", $id);
}

function getIssueByName($search)
{
	return select("SELECT * FROM issue WHERE name like '%$search%' and active = 1");
}

function addIssue( $book_id, $student_id, $issue_date, $due_date, $return_date, $fine_per_day, $total_fine)
{
    $sql = 
		"INSERT INTO issue VALUES(null,
$book_id,$student_id,'$issue_date','$due_date','$return_date',$fine_per_day,$total_fine)";	return query($sql);
}

function updateIssue( $id, $book_id, $student_id, $issue_date, $due_date, $return_date, $fine_per_day, $total_fine)
{
    $sql = 
		"UPDATE issue SET 
		book_id = $book_id
,		student_id = $student_id
,		issue_date = '$issue_date'
,		due_date = '$due_date'
,		return_date = '$return_date'
,		fine_per_day = $fine_per_day
,		total_fine = $total_fine
		WHERE id = $id ";
    return query($sql);
}

function deleteIssue($id)
{   
     return query("DELETE FROM issue WHERE id = $id");
}
?>


