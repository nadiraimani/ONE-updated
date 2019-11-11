<?php
require_once("../model/event_class.php");

$Event = new Event();

$activity = $_GET['activity'];

if($activity=="deleteEvent")
{
	$id=$_GET['id'];
	
	$result=$Event->deleteEvent($id);	
	
	if($result==true)
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event is deleted');
		window.location.href='../view/event.php';</script>";  
	}
	else
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event can not be deleted. Try again');
		window.history.back();</script>"; 	
	}
}

if($activity=="addEvent")
{
	$eventName = $_POST['nameEvent'];
	$eventDate = $_POST['dateEvent'];
	$eventTime = $_POST['time'];
	$eventVenue = $_POST['venue'];
	$eventDesc = $_POST['desc'];
	$eventCategory = $_POST['category'];
	
	$name=addslashes($_FILES['image']['name']);
	$image=base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));
	
	if ($eventCategory=="")
	{	echo "<script language='JavaScript'>alert('Please choose from the radio button. Thank You.');window.location='../index.php?val=noradio';</script>";	
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
		window.location.href='../view/event.php';</script>";  	
	}
}

if($activity=="editEvent")
{
	$eventId = $_POST['eventId'];
	$eventName = $_POST['eventName'];
	$eventDate = $_POST['eventDate'];
	$eventTime = $_POST['eventTime'];
	$eventVenue = $_POST['eventVenue'];
	$eventDesc = $_POST['desc'];
	$eventCategory = $_POST['category'];
	
	$result=$Event->editEvent($eventId, $eventName, $eventDate, $eventTime, $eventVenue, $eventDesc, $eventCategory);	
	
	if($result==true)
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event is updated SUCCESSFULLY!');
		window.location.href='../view/event.php';</script>";  
	}
	else
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event can not be updated. Try again');
		window.history.back();</script>"; 	
	}
}

if($activity=="joinEvent")
{
	$eventId = $_POST['eventId'];
	$userId = $_POST['userId'];
	$currentDate = date("Y-m-d");
	
	$result=$Event->jointEvent($eventId, $userId, $currentDate);	
	
	if($result==true)
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Your participation is updated SUCCESSFULLY!');
		window.location.href='../view/event.php';</script>";  
	}
	else
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Your participation can not be updated. Try again');		
		window.history.back();</script>"; 	
	}
}

if($activity=="declineEvent")
{
	$eventId = $_POST['eventId'];
	$userId = $_POST['userId'];
	
	$result=$Event->declineEvent($eventId, $userId);	
	
	if($result==true)
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Your cancellation is updated SUCCESSFULLY!');
		window.location.href='../view/event.php';</script>";  
	}
	else
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Your cancellation can not be updated. Try again');		
		window.history.back();</script>"; 	
	}
}
?>