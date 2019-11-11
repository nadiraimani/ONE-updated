<?php
require_once("../model/profile_class.php");

$Profile = new Profile();

$activity = $_GET['activity'];

if($activity=="saveProfile")
{
	$userId=$_POST["uid"];
	$newfullName=$_POST["fname"];
	$newPass=$_POST["newpassword"];
	$newEmail=$_POST["email"];	
	$newPhone=$_POST["phone"];	
	$newAddress=$_POST["address"];	
	$userTypeId=$_POST["utype"];	
	
	//$name=addslashes($_FILES['image']['name']);
	//$image=base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));
	
	if($userTypeId==2){
		$result=$Profile->updateProfileP($userId, $newfullName, $newPass, $newEmail, $newPhone, $newAddress);
		//$result=$Profile->updateProfileP($userId, $newfullName, $newPass, $newEmail, $newPhone, $newAddress, $name, $image);	
	}else	{
		$result=$Profile->updateProfileA($userId, $newfullName, $newPass, $newEmail, $newPhone, $newAddress);
		//$result=$Profile->updateProfileA($userId, $newfullName, $newPass, $newEmail, $newPhone, $newAddress, $name, $image);
	}
	
	if($result==true)
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The profile is updated SUCCESSFULLY!');
		window.location.href='../home.php';</script>";  
	}
	else
	{
		echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The profile can not be updated. Try again');
		window.history.back();</script>"; 	
	}
}
?>