<?php session_start();?>
<html>
<title>instructor_home</title>
<body bgcolor= "b4dec1">
<a href ='instructor_home.php' ><h3><p align='right'>Return to Home Page</p></h3></a>
<a href ='logout.php' ><h3><p align='right'>Signout</p></h3></a>
<?php
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
$data1=mysql_query("select * from instructor_table where instructor_id='".$_POST['instructor_id']."'");
$row=mysql_fetch_array($data1);
$instructor_id=$row['instructor_id'];
echo "<h3>Hello ".$row['name']."!!!</h3>";

$data2=mysql_query("select * from course_table where course_id='".$_POST['course_id']."'");
$row=mysql_fetch_array($data2);
$course_name=$row['course_name'];
echo "Course:".$row['course_name']."<br>";

$data3=mysql_query("select * from master_table where course_id='".$_POST['course_id']."'");
$number= $row['current_version'];
if($number>1)
	echo "<h4>Previous Versions</h4>";
for($i=0;$i<$number-1;$i++)
{
$row=mysql_fetch_array($data3);
echo"Version #".($i+1);
}

echo "<hr>";
$row=mysql_fetch_array($data3);
echo "<h4>Latest Version</h4>";
echo "Version #".($number);
/*$data4=mysql_query("select * from exam_table where master_id=".$row['master_id']."and complete=0" );
while($row1=mysql_fetch_array($data4))
{

}
*/
echo "<a href='create_test.php?course_name=".urlencode($course_name)."&master_id=".urlencode($row['master_id'])."'>"."Create new test </a>";
}
?>