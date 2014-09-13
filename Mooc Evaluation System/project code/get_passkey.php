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
else{
}
$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();
mysql_select_db("project_db",$con);

$key = hash_init('md5');
hash_update($key, $_POST['exam_id']);
hash_update($key, 'jumped over the lazy dog.');
$exam_key=hash_final($key); 
$sql=mysql_query("update exam_table set  num_questions = '" . $_POST['num_questions'] .
			     "', complete = '". "1" .
				 "', exam_key = '". $exam_key.
			     "', maximum_marks= '" .  $_POST['maximum_marks'].
				 "', deadline=	'"		. $_POST['deadline'].
				"' where exam_id ='".$_POST['exam_id']."'");
if($sql)
echo "<br><br><center><fieldset>Your passkey for exam = <font color='red'>".$exam_key;
else
echo "Error";
 


?>