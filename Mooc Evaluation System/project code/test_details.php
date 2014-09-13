<html>
<body>
<script language='javascript' src='question.js'></script>
<script  src='jquery.js'></script>
<a href ='logout.php' ><h3><p align='right'>signout</p></h3></a>
<?php

session_start();
if(empty($_SESSION['sessionid']))//check throguh cookies here
{
//echo "<center><h1>Please sign in to continue"."<br>"."redirecting in 2 s"."</h1><center>";
header('location:main.php');
}
else
{
echo"<form method='POST' action='get_passkey.php'>";
echo"<input type=hidden name= 'num_questions' value='" .$_POST['num_questions']. "'>";
echo"<input type=hidden name= 'exam_id'value='".$_POST['exam_id']."'>";
echo"<input type=hidden name= 'maximum_marks'value='".$_POST['maximum_marks']."'>";
echo"<br><br><center><fieldset>Mention Deadline<input type='datetime-local' name='deadline'>";
echo "<input type='submit' value='Done'>";
echo"</form>";

}
