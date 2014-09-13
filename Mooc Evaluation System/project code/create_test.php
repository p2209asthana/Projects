<?php session_start();
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
$status=mysql_query("INSERT INTO exam_table (master_id)
			VALUES ('".
			$_REQUEST['master_id']."')");
if($status)
{
$exam_id=mysql_insert_id();
header("location:test_form.php?course_name=". urlencode($_REQUEST['course_name'])."&exam_id=".urlencode($exam_id));die();
}
else
{
echo "-1";
}
}
?>