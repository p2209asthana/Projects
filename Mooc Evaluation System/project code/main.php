<?php 
session_start();
if(!empty($_SESSION['sessionid']))//check throguh cookies here
{
//echo "<center><h1>Please sign in to continue"."<br>"."redirecting in 2 s"."</h1><center>";
header('location:instructor_home.php');
}
?>
<html>
<body>
<script language='javascript' src='student.js'></script>
<script>

function validateEmail()
{ 
	var emailid=document.getElementById('emailid');
   var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;   
   if ((emailid.value=='')||(!emailid.value.match(mailformat))) 
   {
       alert("Please enter valid email ID");
       emailid.focus() ;
       return false;
   }
   return true ;
}
</script>
<div style="float:right">

<form name="log_form" method="POST" action="login_check.php" onsubmit='return validateEmail()'>
E-MAIL ID<input type="textbox" id='emailid'name="i_emailid" value="" /><br>
PASSWORD<input type="password" name="i_password" value="" /><br>
<input type="submit" name="loginbtn" value="login"/>
</form>
<font color='red'> new user? Sign up</font> <a href= 'signup.php'>here</a>
</div>
<br><br><br><br><br><br><hr>
<div align='center'><font color='red'><?php echo @$_REQUEST['msg']?></font></div>
<form name="passkey_form" method="POST" action="student_detail.php" align='center' onsubmit='return validatePasskey()'>
Enter Test Passkey To Take Test<input type="textbox" id='exam_keyid'name="exam_key" value="" /><br>
<input type="submit" name="passkeybtn" value="Go"/>
</form>
</body>
</html>