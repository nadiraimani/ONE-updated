<?php
require_once('database_connection.php');
require_once('datalib.php');
 
class About
{
	public function __Construct()
	{}
	
	public function getAllHigh()
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM admin
				WHERE userTypeId = '3'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
}