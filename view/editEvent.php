<html>
<title>ONE</title>
<link rel="shortcut icon" href="../images/eureka.ico" >
<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
require_once('../model/event_class.php');
require_once('../model/database_connection.php');
require_once('../model/profile_class.php');

if ($_SESSION['userId']=="" || $_SESSION['userName']=="" || $_SESSION['userFullname']=="")
{	
	session_destroy();
	echo "<script language='JavaScript'>alert('You have to login to access this page.');parent.location.href='login.php';</script>";
}

//object declaration
$Event = new Event();
$Profile = new Profile();

$eventId=$_GET['id'];
$userName=$_SESSION['userName'];
$userId = $_SESSION['userId'];
$userRole = $_SESSION['userRole'];

$singleEvent = $Event->getEvent($eventId);
if($singleEvent)
{	
	foreach($singleEvent as $row)
	{	
		$eventId = $row ['eventId'];
		$eventName = $row ['eventName'];
	 	$eventDate = $row ['eventDate'];
		$eventTime = $row ['eventTime'];
		$eventVenue = $row ['eventVenue'];
		$eventDesc = $row ['eventDesc'];
		$eventCategory = $row ['eventCategory'];
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
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 80%;
  margin-left: 100px;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.main {
  max-width: 1000px;
  margin: auto;
}

.btn {
  background-color: #f4511e;
  border: none;
  color: white;
  padding: 10px 20px;
  text-align: center;
  font-size: 16px;
  margin: 4px 670px;
  opacity: 0.6;
  transition: 0.3s;
  border-radius: 4px;
}

.btn:hover {opacity: 1}

.img-circle {
    border-radius: 50%;
}
</style>

<script language="JavaScript" type="text/javascript" src="js/event.js"></script>

<body class="w3-content" style="max-width:1300px">

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-light-gray w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="w3-container w3-display-container w3-padding-16">
    <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
    <h3 class="w3-wide"><b>ONE</b></h3>
    <br>
     <?php 
	if($userRole==2)
		$Profile->displayPP($userId); 
	else
		$Profile->displayPA($userId);	
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
    <p class="w3-left">Edit Event</p>
    <p class="w3-right">Hello, <?php echo $_SESSION['userFullname'] ?>!</p>
  </header>
  
  <div class="main">
  <form name="editEvent" id="editEvent" method="post" enctype="multipart/form-data">
  <table>
  <col width="60">
  <col width="20">
  <tr>
  	<td colspan="2" bgcolor="81B44D"><h4><input type="text" id="eventName" name="eventName" value="<?php echo $eventName; ?>" style="width:100%"></h4></td>
    <input type="hidden" id="eventId" name="eventId" value="<?php echo $eventId; ?>">
  </tr>
  <tr>
    <td>Date:</td>
    <td><input type="date" id="eventDate" name="eventDate" value="<?php echo $eventDate;?>"/></td>
  </tr>
  <tr>
    <td>Venue:</td>
    <td><input type="text" id="eventVenue" name="eventVenue" value="<?php echo $eventVenue;?>" style="width:100%"/></td>
  </tr>
  <tr>
    <td>Time: </td>
    <td><input type="text" id="eventTime" name="eventTime" value="<?php echo $eventTime;?>" style="width:100%"></td>
  </tr>
  <tr>
    <td>Category:</td>
    <td><input type="radio" name="category" id="catKG" value="KG"<?php echo ($eventCategory=='KG')?'checked':'' ?>>KGSM</input><br>
     	<input type="radio" name="category" id="catAK" value="AK" <?php echo ($eventCategory=='AK')?'checked':'' ?>>Aqiqah dan Korban</input><br>
        <input type="radio" name="category" id="catJWJ" value="JWJ" <?php echo ($eventCategory=='JWJ')?'checked':'' ?>>Jejak Warisan Jawi</input><br>
     	<input type="radio" name="category" id="catS7" value="S7" <?php echo ($eventCategory=='S7')?'checked':'' ?>>Semangat 7</input><br>
        <input type="radio" name="category" id="catSG" value="SG" <?php echo ($eventCategory=='SG')?'checked':'' ?>>Sirih Pulang ke Gagang</input><br>
     	<input type="radio" name="category" id="catMQ" value="MQ" <?php echo ($eventCategory=='MQ')?'checked':'' ?>>Mimbar Qaseh</input><br>
        <input type="radio" name="category" id="catKB" value="KB" <?php echo ($eventCategory=='KB')?'checked':'' ?>>Kursus dan Bengkel</input></td>
  </tr>
  <tr>
    <td>Description:</td>
    <td><input type="text" id="desc" name="desc" style="width:100%" value="<?php echo $eventDesc;?>"/></td>
  </tr>
</table>
	<input type="button" class="btn" style="width: 23%" name="saveEvent" id="saveEvent" value="Save" onClick="eventWork('editEvent');"/>
	<button onClick="goBack()" class="btn" style="width: 23%">Back</button>
</div>
</form>
</html>

<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 2000); // Change image every 2 seconds
}

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
document.getElementById("myBtn").click();


// Open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
  
function goBack() {
  window.history.back();
}
}
</script>

</body>
</html>