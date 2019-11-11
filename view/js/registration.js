function validateUser(activity)
{
	if (activity == "signUp")
	{
		var fullname = document.getElementById("fname").value;
		var username= document.getElementById("uname").value;
		var psw = document.getElementById("psw").value;
		var psw2 = document.getElementById("psw2").value;
		var email = document.getElementById("email").value;
		var phone = document.getElementById("phoneno").value;
		var add = document.getElementById("address").value;
		
		if( psw != psw2 )
		{	
			alert("Password not matched!");
			return false; 
		}
			
		if (username.length == 0 || psw.length == 0 || psw2.length == 0 || fullname.length == 0 || email.length == 0 || phone.length == 0 || add.length == 0 )
		{  alert("Please fill in every column.");return false; }
		
		document.forms[0].action = '../ONE/controller/authorization_control.php?activity='+activity;	
		document.forms["signupForm"].submit();
	}	
	
	if (activity == "login")
	{	
		var username= document.getElementById("userName").value;
		var pwd = document.getElementById("userPass").value;
			
		if (username.length == 0 || pwd.length == 0)
		{  alert('Please fill in every column.');document.getElementById("destination").focus();return false; }
		
		document.forms[0].action = '../ONE/controller/authorization_control.php?activity='+activity;	
		document.forms["loginForm"].submit();
	}	
	
	
}