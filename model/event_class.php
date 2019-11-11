<?php
require_once('database_connection.php');
require_once('datalib.php');
 
class Event
{
	public function __Construct()
	{}
	
	public function getAllEvent()
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM event";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
	
	public function getEvent($eventId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM event
				WHERE eventId = '$eventId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
	
	public function displayEvent($eventId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM event
				WHERE eventId = '$eventId'";
		$query = mysqli_query($Con,$sql) or die ();
		$num = mysqli_num_rows($query);
		
		$result = mysqli_fetch_array($query);
		$img = $result['eventPhoto'];
		echo '<img src="data: image;base64,'.$img.'">';
	}
	
	public function deleteEvent($id)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sqla = "DELETE FROM event 
				WHERE eventId='$id'";
		//echo $sql; exit();
		$result1 = mysqli_query($Con,$sql) or die ();
		if($result1)
		{
			$sqla = "DELETE FROM participation 
					WHERE eventId='$id'";
			$result2 = mysqli_query($Con,$sql) or die ();
			
			if($result2)
				return $result2;
		}
		return $result1;
		mysqli_close($Con);
	}
	
	public function addEvent($eventName, $eventDate, $eventTime, $eventVenue, $eventCategory, $eventDesc, $image, $name)
	{
		$Data = new Datalib();
		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "INSERT INTO event(eventName, eventDate, eventTime, eventVenue, eventCategory, eventDesc, eventPhoto, eventPhotoName)
				VALUES('".$eventName."','".$eventDate."','".$eventTime."','".$eventVenue."','".$eventCategory."', '".$eventDesc."','".$image."', '".$name."')";
		//echo $sql; exit();
		$result=$Data->int_db_insertion($sql);
		return $result;
		mysqli_close($Con);
	}
	
	public function getNo($eventName)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT No
				FROM event
				WHERE eventName = '$eventName'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		$row = mysqli_fetch_object($result);
		return $row->No;
		mysqli_close($Con);
	}
	
	public function updateId($id, $eventName)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "UPDATE event
				SET eventId = '$id' 
				WHERE eventName = '$eventName'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ("QUERY FAILED");
		return $result;
		mysqli_close($Con);
	}
	
	public function getListOfParticipant($eventId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM participation A, user B
				WHERE A.eventId = '$eventId' 
				AND A.userId = B.userID";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
	public function getListOfEvent($userId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM participation A, event B
				WHERE A.userId = '$userId' 
				AND A.eventId = B.eventId";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
	
	public function editEvent($eventId, $eventName, $eventDate, $eventTime, $eventVenue, $eventDesc, $eventCategory)
	{		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "UPDATE event
				SET eventName='$eventName', eventDate = '$eventDate', eventTime = '$eventTime', eventVenue='$eventVenue', eventDesc= '$eventDesc', eventCategory='$eventCategory'
				WHERE eventId = '$eventId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ("QUERY FAILED");
		return $result;
		mysqli_close($Con);
    }
	
	public function displayPE($eventId)
	{
		$con=mysqli_connect("localhost", "root", "", "one");
		$sql = "select * from event WHERE eventId = '$eventId'";
		$query = mysqli_query($con, $sql);
		$num = mysqli_num_rows($query);
	
		$result = mysqli_fetch_array($query);
		$img = $result['eventPhoto'];
		echo '<img  width="100%"  src="data: image;base64,'.$img.'">';
	
	}
	
	public function jointEvent($eventId, $userId, $currentDate)
	{
		$Data = new Datalib();
		
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "INSERT INTO participation(eventId, userId, dateOfParticipation)
				VALUES('".$eventId."','".$userId."','".$currentDate."')";
		//echo $sql; exit();
		$result=$Data->int_db_insertion($sql);
		return $result;
		mysqli_close($Con);
	}
	
	public function checkParticipation($userId, $eventId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "SELECT *
				FROM participation
				WHERE userId = '$userId'
				AND eventId = '$eventId'";
		//echo $sql; exit();		
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
	
	public function declineEvent($eventId, $userId)
	{
		$Con = mysqli_connect('localhost','root', '', 'one');
		$sql = "DELETE FROM participation 
				WHERE eventId='$eventId'
				AND userId = '$userId'";
		//echo $sql; exit();
		$result = mysqli_query($Con,$sql) or die ();
		return $result;
		mysqli_close($Con);
	}
}