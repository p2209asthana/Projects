<?php
$connection=mysql_connect('localhost','root','');
if(!$connection)
echo "Unable to connect".mysql_error();
mysql_select_db("project_db",$connection);

$sql=mysql_query("INSERT INTO instructor_table
	(name,email_id,password,qualifications,areas_of_interest)
	VALUES ('"
		.$_POST['name'].			"','"	.$_POST['email_id'].			"','"
		.$_POST['password'].			"','"	.$_POST['qualifications'].			"','"	
		.$_POST['areas_of_interest'].	"')");
//echo"<html><body>".$sql."<html><body>";
if($sql)
{
	session_start();
	$instructor_id=mysql_insert_id();
$_SESSION['sessionid']=$instructor_id;
header('location: instructor_home.php');
}
else
header('location:main.php?msg="Error in Signup. Retry"');
?>