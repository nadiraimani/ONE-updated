<?php
require_once("../model/authorization_class.php");

$Authorization = new Authorization();

$activity = $_GET['activity'];

if($activity=="login")
{
	$loginName=$_POST['userName'];
	$loginPass=$_POST['userPass'];
	
	$Access=$Authorization->AuthenticateLogin($loginName,$loginPass);	
}
?>

