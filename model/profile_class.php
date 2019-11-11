<?php
require_once('database_connection.php');
require_once('datalib.php');
require_once('crypto_class.php');
 
class Profile
{
	public function __Construct()
	{}
	
	public function getUserData($userId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM user
				WHERE userID = '$userId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
	
	public function getAdminData($userId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM admin
				WHERE adminID = '$userId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
	
	public function updateProfileP($userId, $newfullName, $newPass, $newEmail, $newPhone, $newAddress)	
	{		
		$Crypto = new Crypto();
		$encryptPass=$Crypto->combination_encrypt($newPass);
		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "UPDATE user
				SET userFullname='$newfullName', userPass = '$encryptPass', userEmail = '$newEmail', userPhone = '$newPhone', userAddress = '$newAddress'
				WHERE userId = '$userId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ('Query Failed' . mysqli_error($Con));
		return $result;
		mysqli_close($Con);
    }
	
	public function updateProfileA($userId, $newfullName, $newPass, $newEmail, $newPhone, $newAddress)	
	{		
		$Crypto = new Crypto();
		$encryptPass=$Crypto->combination_encrypt($newPass);
		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "UPDATE admin
				SET adminFullname='$newfullName', adminPass = '$encryptPass', adminEmail = '$newEmail', adminPhone = '$newPhone', adminAddress = '$newAddress'
				WHERE adminId = '$userId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ('Query Failed' . mysqli_error($Con));
		return $result;
		mysqli_close($Con);
    }
	
	public function displayPP($userId)
	{
		$con=mysqli_connect("localhost", "root", "", "one");
		$sql = "select * from user WHERE userID = '$userId'";
		$query = mysqli_query($con, $sql);
		$num = mysqli_num_rows($query);
	
		$result = mysqli_fetch_array($query);
		$img = $result['userPhoto'];
		?>
        <style>	
        .img-circle {
    	border-radius: 50%;
		}
		</style>
        <?php
		echo '<img class="img-circle" width="120" height="120" src="data: image;base64,'.$img.'">';
	
	}
	
	public function displayPA($userId)
	{
		$con=mysqli_connect("localhost", "root", "", "one");
		$sql = "select * from admin WHERE adminID = '$userId'";
		$query = mysqli_query($con, $sql);
		$num = mysqli_num_rows($query);
	
		$result = mysqli_fetch_array($query);
		$img = $result['userPhoto'];
		?>
        <style>	
        .img-circle {
    	border-radius: 50%;
		}
		</style>
        <?php
		echo '<img class="img-circle" width="120" height="120" src="data: image;base64,'.$img.'">';
	}
}