<?php
require_once('database_connection.php');
require_once('datalib.php');
 
class Contact
{
	public function __Construct()
	{}
	
	public function addFeedback($name, $email, $message)
	{
		$Data = new Datalib();
		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "INSERT INTO feedback(name, email, message)
				VALUES('".$name."','".$email."','".$message."')";
		//echo $sql; exit();
		$result=$Data->int_db_insertion($sql);
		return $result;
		mysqli_close($Con);
	}
	
	public function getNo($name, $email, $message)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT No
				FROM feedback
				WHERE name = '$name' 
				AND email = '$email' 
				AND message = '".$message."'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		$row = mysqli_fetch_object($result);
		return $row->No;
		mysqli_close($Con);
	}
	
	public function updateId($id, $no)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "UPDATE feedback
				SET feedbackId = '$id' 
				WHERE No = '$no'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ("QUERY FAILED");
		return $result;
		mysqli_close($Con);
	}
}
?>