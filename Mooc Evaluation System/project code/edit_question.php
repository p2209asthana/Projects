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
{$sql=mysql_query("update question_table set  
						title = '" 			.$_POST['title'] .
			    "', 	option1 = '"		.$_POST['option1'].
				"', 	option2 = '"		.$_POST['option2'].
				"', 	option3 = '"		.$_POST['option3'].
				"', 	option4 = '"		.$_POST['option4'].
				"', 	option1_flag = '"	.$_POST['option1_flag'].
			    "', 	option2_flag = '"	.$_POST['option2_flag'].
			    "', 	option3_flag = '"	.$_POST['option3_flag'].
			    "', 	option4_flag = '"	.$_POST['option4_flag'].
			    "', 	positive_marks= '" .$_POST['positive_marks'].
			    "', 	negative_marks ='"	.$_POST['negative_marks'].
				"' 		where question_id='"	.$_POST['question_id'].		"'");
}
else if ($_POST['type']=="truefalse")
{$sql=mysql_query("update question_table set  
						title = '" 			.$_POST['title'] .
			    "', 	tf_flag = '"		.$_POST['tf_flag'].
			    "', 	positive_marks= '"	.$_POST['positive_marks'].
			    "', 	negative_marks ='"	.$_POST['negative_marks'].
				"' 		where question_id='"	.$_POST['question_id'].		"'");
}
if($sql) echo 1;
else echo -1;				
}
?>