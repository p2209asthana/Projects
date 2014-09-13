<html>
<body>
<script language='javascript'>

function validateEmail(emailid)
{ 
   var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;   
   if ((emailid.value=='')||(!emailid.value.match(mailformat))) 
   {
       alert("Please enter valid email ID");
       emailid.focus() ;
       return false;
   }
   return true ;
}
function validateName(name)
{
	var letters = /^[A-Za-z]+$/;
	if((name.value=='')||(!name.value.match(letters)))
	{
		alert("Please enter a valid name");
		name.focus() ;
		return false;
	} 				
return true;
}
function validateForm()
{
	var emailid = document.getElementById('emailid');
	if(validateEmail(emailid))
	{
		var name=document.getElementById('name');
		if(validateName(name))
			if(document.getElementById('password').value=="")
			{
				alert("Please enter a password");
				document.getElementById('password').focus() ;
				return false;
			}
			else
			return true;
		
	}
	return false;

}
</script>
<form method='POST' action='create_instructor.php' onsubmit='return validateForm()'>
Name:<input type='text' id='name'name='name' ><br>
Email id<input type='text' id='emailid' name='email_id' ><br>
Password<input type='password' id='password'name='password' ><br>
Qualifications<input type='textarea' id='qual'name='qualifications' ><br>
Areas of Interest<input type='textarea' id='aoi'name='areas_of_interest' ><br>
<input type='submit' value='Done'>
</form>
</html>
</body>