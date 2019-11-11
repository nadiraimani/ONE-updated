<?php
require_once('../model/database_connection.php');
require_once('../model/event_class.php');

$Event = new Event();

$eventName = $_POST['nameEvent'];
$eventDate = $_POST['dateEvent'];
$eventTime = $_POST['time'];
$eventVenue = $_POST['venue'];
$eventDesc = $_POST['desc'];
$eventCategory = $_POST['category'];
	
$name=addslashes($_FILES['image']['name']);
$image=base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));
	
if ($eventCategory=="")
{	
	echo "<script language='JavaScript'>alert('Please choose from the radio button. Thank You.');window.location='../index.php?val=noradio';</script>";	
}
	
$result=$Event->addEvent($eventName, $eventDate, $eventTime, $eventVenue, $eventCategory, $eventDesc, $image, $name);	
	
if($result==true)
{
	$no=$Event->getNo($eventName);
	$id = "WA0" . $no;	
		
	$createID=$Event->updateID($id,$eventName);
		
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event is added SUCCESSFULLY.');
		window.location.href='../view/event.php';</script>";  
}
else
{
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event can not be added. Try again');
		window.history.back();</script>"; 	
}
?>