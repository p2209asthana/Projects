<?php
echo "<html><body>";
if(empty($_REQUEST['exam_key']))//if no exam key return to main with errot message
header('location:main.php?msg="Please enter exam passkey provided by your instructor"');

else if((empty($_POST['name']))||(empty($_POST['email_id'])))//if any student details missing get it filled first
header('location:student_detail.php?msg="Enter your details first"');
else
{
$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();
echo $_POST['exam_key'];
mysql_select_db("project_db",$con);

$data=mysql_query("select * from exam_table where exam_key='".$_POST['exam_key']."'");
$row=mysql_fetch_array($data);
$exam_id=$row['exam_id'];
	

$sql=mysql_query("INSERT INTO result_table
	(exam_id,email_id,name)
	VALUES ('"
		.$exam_id.			"','"	.$_POST['email_id'].			"','"
		.$_POST['name'].	"')");
		
if($sql)
{
	$result_id=mysql_insert_id();
	header("location:take_test.php?result_id='".$result_id."'&exam_key='".$_POST['exam_key']."'");
}
}
?>