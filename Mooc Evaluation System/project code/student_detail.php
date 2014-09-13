<html>
<body>
<script language='javascript' src='student.js'></script>
<?php

if(empty($_REQUEST['exam_key']))//if no exam key return to main with errot message
header('location:main.php?msg="Please enter exam passkey provided by your instructor"');
else
{
$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();
mysql_select_db("project_db",$con);
//echo $_POST['exam_key'];
$data=mysql_query("select * from exam_table where exam_key='".$_POST['exam_key']."'");
{
$row=mysql_fetch_array($data);

$a=strtotime("now");
$b=strtotime($row['deadline']);
//echo $a."  ".$b;
if($a>$b)header('location:main.php?msg="Invalid exam key or exam has been closed"');
else
{
echo"<center><fieldset><legend><h1><b>Enter Your Details Below</b></h1></legend><br><br><br>";?>
<div align='center'><font color='red'><?php echo @$_REQUEST['msg']?></font></div>
<?php
echo "<form name='student_form' method='POST' action='create_result.php' onsubmit='return validateStudentForm()'  >";
echo "<input type='hidden' name='exam_key' value='".$_POST['exam_key']."' />";
echo "Name<input type='textbox'  id='name' name='name' value='' /><br>";
echo"Email id<input type='textbox' id='emailid' name='email_id' value='' /><br>";
echo" <input type='submit' name='studentdetailbtn' value='Submit' />";
echo"</form>";
}
}}
?>
</body>
</html>

