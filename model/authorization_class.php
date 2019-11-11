<?php
require_once('database_connection.php');
require_once('crypto_class.php');
require_once('datalib.php');

$Data = new Datalib();
$Crypto = new Crypto();

class Authorization
{
	public function __Construct()
	{		}
	
	public function AuthenticateLogin($loginName,$loginPass)
	{
		$Con = mysqli_connect("localhost", "root", "", "one");
		$Data = new Datalib();
		$Crypto = new Crypto();

		$checkAccUser=$this->checkExistAccount_user($loginName);//Check acc user
		$checkAccAdmin=$this->checkExistAccount_admin($loginName);//Check acc admin
		$loginName=mysqli_real_escape_string($Con, $loginName);
		$loginPass=mysqli_real_escape_string($Con, $loginPass);
		
		if(($checkAccUser==false) && ($checkAccAdmin==false))
		{
			echo "<script language='JavaScript'> alert('You are not yet our member. Lets sign up first!!'); window.location.href='../login.php?val=true'; </script>";
		}
			
		if($checkAccUser)
		{
			$encryptPass=$Crypto->combination_encrypt($loginPass);
			$sql = "SELECT * FROM user WHERE username='$loginName' AND userPass='$encryptPass'";
			$result=mysqli_query($Con, $sql) or die ('Query Failed' . mysqli_error($Con));
			$row=mysqli_fetch_array($result, MYSQLI_BOTH);
				
			if (mysqli_num_rows($result)==1) 
			{
				session_start();	
				$_SESSION['auth']=true;					
				$_SESSION['userRole']=$row['userTypeID'];
				$_SESSION['userRoleDesc']=$row['userTypeDesc'];
				$_SESSION['userId']=$row['userID'];
				$_SESSION['userName']=$row['username'];
				$_SESSION['userFullname']=$row['userFullname'];
				$_SESSION['userEmail']=$row['userEmail'];	
				$_SESSION['userPhone']=$row['userPhone'];	
				$_SESSION['userAddress']=$row['userAddress'];
				$_SESSION['userPhoto']=$row['userPhoto'];	
				$_SESSION['userPhotoName']=$row['userPhotoName'];		
					
				
				$sql2 = "UPDATE user SET userStatus='ACTIVE' WHERE username='$loginName' AND userPass='$encryptPass'";
				$result=mysqli_query($Con, $sql) or die ('Query Failed' . mysqli_error($Con));
				
				if($result)
				{
					echo "<script language='JavaScript'>alert('Login SUCCESS. Status UPDATED.');window.location.href='../home.php?val=true';</script>";		
				}
				
			}
			else 
			{	
				echo "<script language='JavaScript'>alert('Login FAILED.');window.location.href='../login.php?val=true';</script>";	
			}
		}
		
		if($checkAccAdmin)
		{
			$encryptPass=$Crypto->combination_encrypt($loginPass);
			$sql = "SELECT * 
					FROM admin
					WHERE adminName='$loginName' 
					AND adminPass='$encryptPass'";
					
			$result=mysqli_query($Con, $sql) or die ('Query Failed' . mysqli_error($Con));
			$row=mysqli_fetch_array($result, MYSQLI_BOTH);
				
			if (mysqli_num_rows($result)==1) 
			{
				session_start();	
				$_SESSION['auth']=true;					
				$_SESSION['userRole']=$row['userTypeID'];
				$_SESSION['userRoleDesc']=$row['userTypeDesc'];
				$_SESSION['userId']=$row['adminID'];
				$_SESSION['userName']=$row['adminName'];
				$_SESSION['userFullname']=$row['adminFullname'];
				$_SESSION['userEmail']=$row['adminEmail'];	
				$_SESSION['userPhone']=$row['adminPhone'];	
				$_SESSION['userAddress']=$row['adminAddress'];	
				$_SESSION['userPhoto']=$row['userPhoto'];	
				$_SESSION['userPhotoName']=$row['userPhotoName'];	
					
				$sql2 = "UPDATE user SET userStatus='ACTIVE' WHERE adminName='$loginName' AND adminPass='$encryptPass'";
				$result=mysqli_query($Con, $sql) or die ('Query Failed' . mysqli_error($Con));
				
				if($result)
				{
					echo "<script language='JavaScript'>alert('Login SUCCESS. Status UPDATED.');window.location.href='../home.php?val=true';</script>";	
				}
			}		
			else 
			{	
				echo "<script language='JavaScript'>alert('Login FAILED.');window.location.href='../login.php?val=true';</script>";	
			}
		}
	}
	
	public function AuthenticateSignup($loginName,$loginPass, $fullName, $email, $address, $phoneNo, $image, $name)
	{
		$Con = mysqli_connect("localhost", "root", "", "one");
		$Data = new Datalib();
		$Crypto = new Crypto();

		$checkAcc=$this->checkExistAccount_user($loginName);	
		$loginName=mysqli_real_escape_string($Con, $loginName);
		$loginPass=mysqli_real_escape_string($Con, $loginPass);
			
		if ($checkAcc==true)//Acc already exist
		{	
			echo "<script LANGUAGE='JavaScript' type='text/javascript'>window.alert('You already a member!!');
		window.location.href='../login.php';</script>"; 
		}
		else if ($checkAcc==false)//Acc not exist yet
		{
			$encryptPass=$Crypto->combination_encrypt($loginPass);
			$sql = "INSERT INTO user(username, userPass, userFullname, userEmail, userPhone, userAddress, userPhotoName, userPhoto, userStatus, userTypeID)
					VALUES('".$loginName."','".$encryptPass."', '".$fullName."', '".$email."', '".$phoneNo."',  '".$address."', '".$name."',  '".$image."', 'ACTIVE', '2')";
			/**$sql = "INSERT INTO admin(adminName, adminPass, adminFullname, adminEmail, adminPhone, adminAddress, userPhotoName, userPhoto, userStatus, userTypeID, userTypeDesc)
					VALUES('".$loginName."','".$encryptPass."', '".$fullName."', '".$email."', '".$phoneNo."',  '".$address."', '".$name."',  '".$image."', 'ACTIVE', '1', 'Administrator')";*/
			$result_insert=$Data->int_db_insertion($sql);
			return $result_insert;
		}
		
	}
	
	private function checkExistAccount_user($loginName)
	{	
		$Con = mysqli_connect("localhost", "root", "", "one");
		
		$sql="SELECT userID FROM user WHERE username='$loginName' ";		
		$result=mysqli_query($Con, $sql) or die ('Query Failed checkExistAccount_user' . mysqli_error($Con));
		$row=mysqli_fetch_array($result, MYSQLI_BOTH);
		if (mysqli_num_rows($result)==1) 
		{
			return true;
		}
 
 		else 
		{
			return false;
		}
	}	
	
	private function checkExistAccount_admin($loginName)
	{	
		$Con = mysqli_connect("localhost", "root", "", "one");
		
		$sql="SELECT adminID FROM admin WHERE adminName='$loginName' ";		
		$result=mysqli_query($Con, $sql) or die ('Query Failed checkExistAccount_admin' . mysqli_error($Con));
		$row=mysqli_fetch_array($result, MYSQLI_BOTH);
		if (mysqli_num_rows($result)==1) 
		{
			return true;
		}
 
 		else 
		{
			return false;
		}
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
