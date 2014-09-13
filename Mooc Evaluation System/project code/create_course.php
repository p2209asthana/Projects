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
$data=mysql_query("select * from course_table where instructor_id='".$_POST['instructor_id']."' AND course_name='".$_POST['course_name']."'");
//check for if course under same name already exists by same instructor
$row=mysql_fetch_array($data);
//$num=count($data);
if($row!=0)
echo -1;
else
{
$status1=mysql_query("INSERT INTO course_table (instructor_id,course_name)
			VALUES ('".
			$_POST['instructor_id']."','".$_POST['course_name']."')");
if($status1)
{
	$data=mysql_query("select * from course_table where course_name='".$_POST['course_name']."'");
	$row=mysql_fetch_array($data);
	$status2=mysql_query("INSERT INTO master_table (course_id,course_version)
				VALUES ('".
				$row['course_id']."','".$row['current_version']."')");
	if($status2)
	echo $row['course_id'];
	else//rollback insertion in course_table 
	{
		mysql_query("delete from course_table where course_id='".$row['course_id']."'");
		echo "0";
	}
			
}
else echo"0";


}

}
?>