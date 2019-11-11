function eventWork(activity)
{
	if (activity == "addEvent")
	{
		var name = document.getElementById("nameEvent").value;
		var date= document.getElementById("dateEvent").value;
		var time = document.getElementById("time").value;
		var venue = document.getElementById("venue").value;
		var desc = document.getElementById("desc").value;
		var cat = document.getElementsByName("category");
		
		if (name.length == 0 || date.length == 0 ||time.length == 0 || venue.length == 0 || desc.length == 0 || cat.length == 0)
		{  alert('Please fill in every column.');document.getElementById("destination").focus();return false; }
		
		var filename = document.getElementById("image").value;
		if (filename == "")
		{ alert('Please insert a picture.');return false; }
		
		document.forms[0].action = '../controller/event_control.php?activity='+activity;	
		document.forms["addEventForm"].submit();
	}
	
	if (activity == "editEvent")
	{
		var name = document.getElementById("eventName").value;
		var date= document.getElementById("eventDate").value;
		var time = document.getElementById("eventTime").value;
		var venue = document.getElementById("eventVenue").value;
		var desc = document.getElementById("desc").value;
		
		if (name.length == 0 || date.length == 0 ||time.length == 0 || venue.length == 0 || desc.length == 0)
		{  alert('Please fill in every column.');document.getElementById("destination").focus();return false; }
		
		document.forms[0].action = '../controller/event_control.php?activity='+activity;	
		document.forms["editEvent"].submit();
	}
	
	if (activity == "joinEvent")
	{
		var c = window.confirm('Are you sure want to join this event?');
		if(c==1)
		{
			var eventId = document.getElementById("eventId").value;
			var userId = document.getElementById("userId").value;
		
			document.forms[0].action = '../controller/event_control.php?activity='+activity;	
			document.forms["joinForm"].submit();
		}
		else
		{
			alert('Hopefully you join us later!.');document.getElementById("destination").focus();return false; 
		}
	}
	
	if (activity == "declineEvent")
	{
		var c = window.confirm('Are you sure want to cancel this event?');
		if(c==1)
		{
			alert('Hopefully you join us later!.');
			document.forms[0].action = '../controller/event_control.php?activity='+activity;	
			document.forms["joinForm"].submit();
			 
		}
	}
}