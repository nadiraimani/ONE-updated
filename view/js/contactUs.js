function contactUs(activity)
{
	if (activity == "feedback")
	{
		var name = document.getElementById("name").value;
		var email= document.getElementById("email").value;
		var msg = document.getElementById("message").value;
		
		if (name.length == 0 || email.length == 0 || msg.length == 0)
		{  alert('Please fill in every column.');document.getElementById("destination").focus();return false; }
		
		document.forms[0].action = '../controller/contact_control.php?activity='+activity;	
		document.forms["contactForm"].submit();
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
}