<?php session_start();?>
<html>
<title>instructor_home</title>
<body bgcolor= "b4dec1">
<script language='javascript' src='course.js'></script>
<script  src='jquery.js'></script>
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

	$data=mysql_query("select * from instructor_table where instructor_id='".$_SESSION['sessionid']."'");
	$row=mysql_fetch_array($data);
	$instructor_id=$row['instructor_id'];
	echo "<h1>Hello ".$row['name']."!!!</h1>";
	$data=mysql_query("select * from course_table where instructor_id='".$instructor_id."'");//extract all th course names
	
	echo "<input type='button' id='createbuttonid' value='Float New Course' onclick='createCourseForm()'><br>";
	echo"<input type='text' id='coursenameid' value='Course Name' disabled >";
	echo"<input type='button' id='cancelbuttonid' value='Cancel' onclick='clearForm()'disabled >";
	echo"<input type='button' id='okbuttonid' value='OK' onclick='createForm(".$instructor_id.")' disabled>";
	echo"<hr>";
	echo "<form name='test_form' method='POST' action='course_home.php'>";
	echo "<input type='hidden' name='instructor_id' value='".$instructor_id."'>";
	echo "Course Name". "<select id ='selectcourseid' name='course_id'>";
	while($row =mysql_fetch_array($data))
	{
		echo "<option value='".$row['course_id']."'>".$row['course_name']."</option>";
	}echo "</select>";
	
	echo "<input type='submit' name='gobtn' value='Go'>";
	echo "</form>";
}
?>
</body>
</html>