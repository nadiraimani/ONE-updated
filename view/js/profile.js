function profile(activity)
{
	if (activity == "saveProfile")
	{
		var name = document.getElementById("fname").value;
		var phone= document.getElementById("phone").value;
		var email = document.getElementById("email").value;
		var address = document.getElementById("address").value;
		var pass1 = document.getElementById("password").value;
		var pass2 = document.getElementById("newpassword").value;
		
		if (pass1 != pass2)
		{
			alert("Password not matched!");
			return false; 
		}
		
		if (name.length == 0 || phone.length == 0 || email.length == 0 || address.length == 0 || pass1.length == 0 || pass2.length == 0)
		{  alert('Please fill in every column.');document.getElementById("destination").focus();return false; }
		
		document.forms[0].action = '../controller/profile_control.php?activity='+activity;	
		document.forms["editProfileForm"].submit();
	}
}