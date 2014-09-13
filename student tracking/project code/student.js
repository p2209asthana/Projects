function validatePasskey()
{
if(document.getElementById('exam_keyid').value=='')
{
	alert('Exam Key Not Valid');
	return false;
}
return true;
}

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
function validateStudentForm()
{
	var emailid = document.getElementById('studentemailid');
	if(validateEmail(emailid))
	{
		var name=document.getElementById('studentname');
		if(validateName(name))
			return true;
		
	}
	return false;

}
