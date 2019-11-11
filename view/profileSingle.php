<html>
<title>ONE</title>
<link rel="shortcut icon" href="../images/eureka.ico" >
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);

require_once('../model/database_connection.php');
require_once('../model/profile_class.php');
require_once('../model/crypto_class.php');

if ($_SESSION['userId']=="" || $_SESSION['userName']=="" || $_SESSION['userFullname']=="")
{	
	session_destroy();
	echo "<script language='JavaScript'>alert('You have to login to access this page.');parent.location.href='../login.php';</script>";
}

//object declaration
$Profile = new Profile();
$Crypto = new Crypto();

$userId = $_GET['id'];
$userType = $_GET['type'];

$uId=$_SESSION['userId'];
$uRole=$_SESSION['userRole'];

if ($userType==2)
{
	$userData = $Profile->getUserData($userId);
	
	if($userData)
	{	
		foreach($userData as $row)
		{	
			$id= $row["userID"];
			$fullname= $row["userFullname"];
			$email= $row["userEmail"];	
			$phoneNo= $row["userPhone"];	
			$address= $row["userAddress"];	
			$decryptPW = trim($Crypto->combination_decrypt($row['userPass']));
			$status= $row["userStatus"];
		}
	}
	else
	{
		echo "<script language='JavaScript'>alert('Can not reach the data.');parent.location.href='../home.php';</script>";
	}
}
else
{
	$userData = $Profile->getAdminData($userId);
	
	if($userData)
	{	
		foreach($userData as $row)
		{	
			$id= $row["adminID"];
			$fullname= $row["adminFullname"];
			$email= $row["adminEmail"];	
			$phoneNo= $row["adminPhone"];	
			$address= $row["adminAddress"];	
			$decryptPW = trim($Crypto->combination_decrypt($row['adminPass']));
			$status= $row["userStatus"];
		}
	}
	else
	{
		echo "<script language='JavaScript'>alert('Can not reach the data.');parent.location.href='../home.php';</script>";
	}
}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.w3-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: "Montserrat", sans-serif;}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}
.row {
  width: 60%;
 padding: 0 16px;
 

}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
	
  }
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
}

.container {
  padding: 0 16px;
  border: 1px solid black;
  border-collapse: collapse;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.btn {
  background-color: #f4511e;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  font-size: 16px;
  margin: 4px 2px;
  opacity: 0.6;
  transition: 0.3s;
}
.btn:hover {opacity: 1}
  
.container:hover .overlay {
  opacity: 1;
}

.img-circle {
    border-radius: 50%;
}
.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 50%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}
</style>
<body class="w3-content" style="max-width:1300px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-light-gray w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>ONE</b></h3>
    <br>
    <?php 
	if($uRole==2)
		$Profile->displayPP($uId); 
	else
		$Profile->displayPA($uId);	
	?>
  </div>
  <div class="w3-padding-64 w3-large w3-text-grey" style="font-weight:bold">
    <a href="../home.php" class="w3-bar-item w3-button"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    <a href="../view/profile.php?id=<?php echo $_SESSION['userId']; ?>&type=<?php echo $_SESSION['userRole']; ?>" class="w3-bar-item w3-button"><i class="fa fa-user-circle" aria-hidden="true"></i> Profile</a>
    <a href="../view/event.php" class="w3-bar-item w3-button"><i class="fa fa-calendar" aria-hidden="true"></i> Event</a>
    <a href="../view/contactUs.php" class="w3-bar-item w3-button"><i class="fa fa-fw fa-envelope"></i> Contact</a> 
    <a href="../aboutUs.php" class="w3-bar-item w3-button"><i class="fa fa-users" aria-hidden="true"></i>
 About Us</a>
    <a href="../logout.php" class="w3-bar-item w3-button"><i style="font-size:24px" class="fa">&#xf08b;</i> Log out</a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
  <div class="w3-bar-item w3-padding-24 w3-wide">One</div>
  <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right" onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="w3-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
<header class="w3-container w3-xlarge">
    <p class="w3-left">Profile</p>
    <p class="w3-right">Hello, <?php echo $_SESSION['userFullname']; ?>!</p>
    </p>
  </header>
  <blockquote>
  <table style="width:85%"  >
  
  <tr>
    <td rowspan="2" width="35%"><div class="w3-container">
         <center><?php 
		if($userType==2)
			$Profile->displayPP($userId); 
		else
			$Profile->displayPA($userId);	
		?><center><br>
          <!-- Button -->
          <div class="controls">
           <center><a style="align:center" href="editProfile.php?id=<?php echo $userId?>&type=<?php echo $userType?>"><button class="btn edit_btn" name="btnedit" >Edit</button></center>
           
           <?php 
		   if($userRole==2)
		   {?>
           		<a style="align:center" href="listOfEvent.php?id=<?php echo $userId?>"><button class="btn list_btn" name="btnlist" >List of Events</button>
           		<?php 
		   } 
		   ?>
           </div>
         </div></td></tr><br>
		 <tr>
    <td rowspan="2">
         <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i>Name: <?php echo $fullname; ?></p>
         <p><i class="fa fa-phone fa-fw w3-margin-right w3-text-theme"></i> Phone No: <?php echo $phoneNo; ?></p>
         <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> Address: <?php echo $address; ?></p>
         <p><i class="fa fa-envelope fa-fw w3-margin-right w3-text-theme"></i> Email: <?php echo $email; ?></p>
         <p><i class="fa fa-key fa-fw w3-margin-right w3-text-theme"></i> Password: <?php echo $decryptPW; ?></p>
         <p><i class="fa fa-sticky-note fa-fw w3-margin-right w3-text-theme"></i> Status: <?php echo $status; ?></p>

        </div></td>
  
  </tr>
  
</table>
 </blockquote>     
      <br>
     
<script>
// Accordion 
function myAccFunc() {
  var x = document.getElementById("demoAcc");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

// Click on the "Jeans" link on page load to open the accordion for demo purposes
//document.getElementById("myBtn").click();


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>