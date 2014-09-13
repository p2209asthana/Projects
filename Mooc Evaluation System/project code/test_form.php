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
$question_count=0;
$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();
mysql_select_db("project_db",$con);


echo "<form name='test_form' method='POST' action='test_details.php' onsubmit='return checknumQuestions()'>";
echo"<input type='hidden' id='hiddenexamid' name= 'exam_id' value='".$_REQUEST['exam_id']."'>";
echo"<input type='hidden' id='hiddennumquesid' name= 'num_questions' value=''>";
echo"<input type='hidden' id='hiddenmaximmarksid' name= 'maximum_marks' value=''>";

echo"Course Name<input type='text' value='".$_REQUEST['course_name']. "'  disabled><hr>";
echo"<div id='display'></div>";
echo"<div id='target_divid'></div>";
echo"<input type='button' id='addnewquesbtnid' style='width: 200px; margin-left: 0px ;automargin-right:auto;'value='Add New Question' onclick='openQuesForm()'>";
echo"<div id='quesformid'></div>";
echo"<input type='submit' style='width: 300px; margin-left: 500px ;automargin-right:auto;' value='No more Questions..Submit Test'>";
echo"</form>";

}
?>
</body>
</html>