<?php
session_start();
if(empty($_SESSION['sessionid']))//check throguh cookies here
{
//echo "<center><h1>Please sign in to continue"."<br>"."redirecting in 2 s"."</h1><center>";
header('location:main.php');
}
else
{
$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();

mysql_select_db("project_db",$con);
if(($_POST['type']=="singlecorrect")||($_POST['type']=="multiplecorrect"))
{
	$sql=mysql_query("INSERT INTO question_table
	(exam_id,title,type,
	option1,option2,option3,option4,
	option1_flag,option2_flag,option3_flag,option4_flag,positive_marks,negative_marks)
	VALUES ('"
		.$_POST['exam_id'].			"','"	.$_POST['title'].			"','"
		.$_POST['type'].			"','"	.$_POST['option1'].			"','"	
		.$_POST['option2'].			"','"	.$_POST['option3'].			"','"
		.$_POST['option4'].			"','"	.$_POST['option1_flag'].	"','"
		.$_POST['option2_flag'].	"','"	.$_POST['option3_flag'].	"','"
		.$_POST['option4_flag'].	"','"	.$_POST['positive_marks'].	"','"
		.$_POST['negative_marks'].	"')");
	if($sql)
	echo $exam_id=mysql_insert_id();
	else echo "-1";

}
else if($_POST['type']=="truefalse")
{
	$sql=mysql_query("INSERT INTO question_table
		(exam_id,title,type,tf_flag,positive_marks,negative_marks)
		VALUES ('"
			.$_POST['exam_id'].			"','"	.$_POST['title'].			"','"
			.$_POST['type'].			"','"	.$_POST['tf_flag'].			"','"
			.$_POST['positive_marks'].	"','"	.$_POST['negative_marks'].	"')");
	if($sql)
	echo $exam_id=mysql_insert_id();
	else echo "-1";
	
}
}


?>