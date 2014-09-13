<?php
require_once 'b_serverinfo.php';
require_once 'b_session_handler.php';
checkSession();

function getSanitizedInput(){
global $db;
global $student_id,$score,$status,$school_id,$class;
$student_id=@$db->real_escape_string($_POST['student_id']);
$score=@$db->real_escape_string($_POST['score']);
$status=@$db->real_escape_string($_POST['status']);
$class=@$db->real_escape_string($_POST['class']);
$school_id=@getSessionDetails()['user_school_id'];
if(!isset($student_id)or empty($student_id))throw new Exception('Student Id not Received');
if(!isset($score)or empty($score))throw new Exception('Percentage Score not received');
if(!isset($status)or empty($status))throw new Exception('Status not received');
if(!isset($status)or empty($status))throw new Exception('Class not received');
if(!isset($school_id)or empty($school_id))throw new Exception('An Error Occured. Please try again or login again');
}

function handleStatus(){
$session_year=date('Y')-1;

$stmt = $db->stmt_init();
$stmt->prepare("UPDATE results set status=?,score=? where result_student_id=? and class=? and session_year=?");
$stmt->bind_param('isiii',$student_id,$class,$session_year,$status,$score);
if(!$stmt->execute())throw new Exception($db->error);
$stmt->close();

if($status=='Passed and Stayed'){
$stmt = $db->stmt_init();
$stmt->prepare("INSERT into results (result_student_id,class,session_year) VALUES (?,?,?)");
$stmt->bind_param('iii',$student_id,$class+1,$session_year+1);
if(!$stmt->execute())throw new Exception($db->error);
$stmt->close();
}
elseif($status=='Failed and Stayed'){
$stmt = $db->stmt_init();
$stmt->prepare("INSERT into results (result_student_id,class,session_year) VALUES (?,?,?)");
$stmt->bind_param('iii',$student_id,$class,$session_year+1);
if(!$stmt->execute())throw new Exception($db->error);
$stmt->close();
}
elseif($status=='Passed/Failed and left'){
$exit_date=date("Y-m-d");
$stmt = $db->stmt_init();
$stmt->prepare("UPDATE enrollments set exit_date=? where enrollment_student_id=? and enrollment_school_id=? and exit_date=?");
$stmt->bind_param('sii',$exit_date,$student_id,$school_id,Null);

}
}
try{
$db = new mysqli($server,$server_uname,$server_pwd,$dbname);
if(!$db)throw new Exception($db->error);
getSanitizedInput();
handleStatus();
}
catch (Exception $e) { 
			echo 'Updating result failed: Error Code='.$e->getCode();
			echo	$e->getMessage();
			$db->close();
		}
?>