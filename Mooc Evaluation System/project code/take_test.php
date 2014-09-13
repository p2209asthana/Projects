<html>
<script language='javascript'>
function clearTrueFalseField(id)
{
document.getElementById("Q"+id+"radiobtn1").checked=false;
document.getElementById("Q"+id+"radiobtn2").checked=false;
}
function clearSingleCorrectField(id)
{
document.getElementById("Q"+id+"radiobtn1").checked=false;
document.getElementById("Q"+id+"radiobtn2").checked=false;
document.getElementById("Q"+id+"radiobtn3").checked=false;
document.getElementById("Q"+id+"radiobtn4").checked=false;
}
function clearMultipleCorrectField(id)
{
document.getElementById("Q"+id+"checkbox1").checked=false;
document.getElementById("Q"+id+"checkbox2").checked=false;
document.getElementById("Q"+id+"checkbox3").checked=false;
document.getElementById("Q"+id+"checkbox4").checked=false;

}


</script>
<?php


if(empty ($_REQUEST['result_id']))
header("location:student_detail.php?msg='Enter your details first'");

$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();

mysql_select_db("project_db",$con);
$data=mysql_query("select * from exam_table where exam_key=".$_REQUEST['exam_key']."");
if(!$data)
{
header("location:main.php?msg='Invalid Key'");
}
else
{
$row=mysql_fetch_array($data);
$exam_id=$row['exam_id'];
$data=mysql_query("select * from question_table where exam_id='".$exam_id."'");
echo "<form name='result_form' method='GET' action='get_score.php'>";
echo"<input type='hidden' name='result_id' value=".$_REQUEST['result_id'].">";
echo"<input type='hidden' name='exam_key' value=".$_REQUEST['exam_key'].">";
$count=1;
while($row=mysql_fetch_array($data))
{
	echo"Q".$count.":<font color='red'>".$row['title']."</font><br>";
	echo "<font color='green'>Positive marks: +".$row['positive_marks']."\t Negative marks:".$row['negative_marks']."</font><br>";
	if($row['type']=="truefalse")
	{	echo"<div style='float:right'><input type='button' id=".$count." onclick='clearTrueFalseField(this.id)' value='Clear All'></div>";
		echo"<input type='radio'id='Q".$count."radiobtn1'name='Q".$count."radiobtn' value='1'>True<br>";
		echo"<input type='radio'id='Q".$count."radiobtn2'name='Q".$count."radiobtn' value='0'>False<br>";
	}
	else if ($row['type']=="multiplecorrect")
	{
		echo"<div style='float:right'><input type='button' id=".$count." onclick='clearMultipleCorrectField(this.id)' value='Clear All'></div>";
		echo"<input type='checkbox'id='Q".$count."checkbox1'name='Q".$count."checkbox[]' value='1'>";
		echo $row['option1']."<br>";
		echo"<input type='checkbox'id='Q".$count."checkbox2'name='Q".$count."checkbox[]' value='2'>";
		echo $row['option2']."<br>";
		echo"<input type='checkbox'id='Q".$count."checkbox3'name='Q".$count."checkbox[]' value='3'>";
		echo $row['option3']."<br>";
		echo"<input type='checkbox'id='Q".$count."checkbox4'name='Q".$count."checkbox[]' value='4'>";
		echo $row['option4']."<br>";
	}
	else if ($row['type']=="singlecorrect")
	{
	echo"<div style='float:right'><input type='button' id=".$count." onclick='clearSingleCorrectField(this.id)' value='Clear All'></div>";
		
		echo"<input type='radio'id='Q".$count."radiobtn1'name='Q".$count."radiobtn' value='1'>";
		echo $row['option1']."<br>";
		echo"<input type='radio'id='Q".$count."radiobtn2'name='Q".$count."radiobtn' value='2'>";
		echo $row['option2']."<br>";
		echo"<input type='radio'id='Q".$count."radiobtn3'name='Q".$count."radiobtn' value='3'>";
		echo $row['option3']."<br>";
		echo"<input type='radio'id='Q".$count."radiobtn4'name='Q".$count."radiobtn' value='4'>";
		echo $row['option4']."<br>";
	}
	$count=$count+1;
	echo "<hr>";
}
echo "<input type='submit' value='Submit Test'>";
echo"</form>";
}

?>