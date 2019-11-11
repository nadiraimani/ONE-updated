<?php
require_once('../model/profile_class.php');
require_once('../model/database_connection.php');
require_once('../model/datalib.php');

$Data = new Datalib();
$Profile = new Profile();

$userId=$_POST["uId"];	
$userRole=$_POST["uRole"];	
$fullName=$_POST["fname"];
$email=$_POST["email"];	
$address=$_POST["address"];	
$phoneNo=$_POST["phone"];	
$pass1=$_POST["password"];
$pass2=$_POST["newpassword"];

if($pass1 != $pass2)
{
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Password does not match! Please try again.');
	window.location.href='../home.php?val=false';</script>"; 	
}

//$name=addslashes($_FILES['image']['name']);
//$image=base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));


if($userRole==2)
{
	$result=$Profile->updateProfileP($userId, $fullName, $pass1, $email, $phoneNo, $address);
}
else
{
	$result=$Profile->updateProfileA($userId, $fullName, $pass1, $email, $phoneNo, $address);
}

if($result==true)
{
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The profile is updated SUCCESSFULLY!');
		window.location.href='../home.php';</script>";    
}
else
{
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('The profile cannot be updated!);
	window.location.href='../home.php?val=false';</script>"; 
}
?>