<?php
require_once("model/authorization_class.php");
require_once('model/database_connection.php');
require_once('model/crypto_class.php');
require_once('model/datalib.php');

$Data = new Datalib();
$Crypto = new Crypto();
$Authorization = new Authorization();

$fullName=$_POST["fname"];
$loginName=$_POST['uname'];
$loginPass=$_POST['psw'];
$email=$_POST["email"];	
$phoneNo=$_POST["phoneno"];	
$address=$_POST["address"];		

$name=addslashes($_FILES['image']['name']);
$image=base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));

$Access=$Authorization->AuthenticateSignup($loginName,$loginPass, $fullName, $email, $address, $phoneNo, $image, $name);

if($Access==true)
{
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Sign up SUCCESS!! Please log in.');
	window.location.href='login.php?val=true';</script>";  
}
else
{
	echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('Sign up FAILEDD!! Please try again');
	window.location.href='login.php?val=true';</script>"; 	
}
?>