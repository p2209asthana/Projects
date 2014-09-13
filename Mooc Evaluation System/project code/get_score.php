<?php
echo "<html><body>";

if(empty($_GET['exam_key']))
header('location:main.php');
else
if(empty ($_GET['result_id']))
header("location:student_detail.php");
 
else
{

$con=mysql_connect('localhost','root','');
if(!$con)
echo "Unable to connect".mysql_error();

mysql_select_db("project_db",$con);
$data=mysql_query("select * from exam_table where exam_key='".$_REQUEST['exam_key']."'");
if(!$data)
{
header("location:main.php?msg='Invalid Key'");
}
else
{
$row=mysql_fetch_array($data);
$exam_id=$row['exam_id'];
$data=mysql_query("select * from question_table where exam_id='".$exam_id."'");
$count=1;
$score=0;
$delta_score=0;
while($row=mysql_fetch_array($data))
{
	if($row['type']=="truefalse")
	{
		$number=count(@$_GET["Q".$count."radiobtn"]);
		if($number==0)
		$delta_score=0;
		else if($_GET["Q".$count."radiobtn"]==$row['tf_flag'])
		$delta_score=$row['positive_marks'];
		else
		$delta_score=$row['negative_marks'];
	}
	else if ($row['type']=="multiplecorrect")
	{
		$sum=$row['option1_flag']+$row['option2_flag']+$row['option3_flag']+$row['option4_flag'];
		$number=count(@$_GET["Q".$count."checkbox"]);
		if($number==0)
		$delta_score=0;
		else if($sum!=$number)
		$delta_score=$row['negative_marks'];
		else
		{
			$check=0;
			for($i=0;$i<$number;$i++)
			{
				$j=$_GET["Q".$count."checkbox"][$i];
				if($row['option'.$j.'_flag']==1)
				$check=$check+1;
			}
			if($check==$sum)
			$delta_score=$row['positive_marks'];
			else
			$delta_score=$row['negative_marks'];
		}
	}
	else if ($row['type']=="singlecorrect")
	{
		$number=count(@$_GET["Q".$count."radiobtn"]);
		if($number==0)
		$delta_score=0;
		else
		{
			$tick=$_GET["Q".$count."radiobtn"];
			if($row['option'+$tick+'_flag']==1)
			$delta_score=$row['positive_marks'];
			else
			$delta_score=$row['negative_marks'];
		}
	}
	$score=$score+$delta_score;
	$count=$count+1;
}
echo"<br><br><center><fieldset>";
echo "<h1>Your score :<font color='red'> ".$score."</font></h1>";
echo "<a href='main.php'>Return to Home Page</a>";

}



}
echo "</body></html>";

?>