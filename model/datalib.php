<?php
require_once('database_connection.php');


class DataLib 
{
	public function __Construct()
	{
	}
	
	public function int_db_insertion($strSQL)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$int = 0; 
		$result = mysqli_query($Con, $strSQL) or die ("Unable to insert : " . mysqli_error($Con));
		$query_data = mysqli_affected_rows($Con);
		$rownums = $query_data;
		if ($rownums > 0) 
		{
			$int = 1;
		}
		else
		{
			$int = 0;
		}
		return $int;
		mysqli_close();
	}

	public function int_db_update($strSQL)
	{		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$int = 0;
		$result = mysqli_query( $Con, $strSQL) or die ("Unable to update : " . mysqli_error($Con));
		$query_data = mysqli_affected_rows($Con);
		$rownums = $query_data;
		if ($rownums > 0) 
		{
			$int = 1;
		}
		else
		{
			$int = 0;
		}
		
		return $int;
		mysqli_close();
	}
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
