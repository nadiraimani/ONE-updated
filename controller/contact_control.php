<?php
require_once("../model/contact_class.php");

$Contact = new Contact();

$activity = $_GET['activity'];

if($activity=="feedback")
{	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	
	$result = $Contact->addFeedback($name, $email, $message);
	
	if($result==true)
	{
		$no=$Contact->getNo($name, $email, $message);
		$id = "FB0" . $no;	
		
		$createID=$Contact->updateID($id,$no);
		
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The message is sent SUCCESSFULLY.');
		window.location.href='../view/contactUs.php';</script>";  
	}
	else
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The event can not be added. Try again');
		window.history.back();</script>"; 	
	}
}
?>