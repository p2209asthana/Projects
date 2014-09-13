<?php 
require_once 'b_serverinfo.php';
require_once 'b_session_handler.php';
checkSession();

function getSanitizedInput(){
global $db;
global $class,$school_id;
$class=@$db->real_escape_string($_POST['class']);
$a=getSessionDetails();if(!$a) throw new Exception ('An Error Occured. Please try again or login again');
$a=$a['user_school_id'];
$school_id=@$db->real_escape_string($a);
if(!isset($class) or empty($class))throw new Exception('No class mentioned');
if(!isset($school_id) or empty($school_id))throw new Exception('School Id Not Received');
}

function getStudentList(){
global $db;global $school_id,$class;
$stmt = $db->stmt_init();
$stmt->prepare("Select enrollment_student_id from enrollments where enrollment_school_id=? and exit_date = NULL");
$stmt->bind_param('i',$school_id);
if(!$stmt->execute())throw new Exception($db->error);
$stmt->bind_result($student_id);
$result=array();
$i=0;
while($stmt->fetch()){
	$result[$i]=array("id"=>$student_id);
	$i=$i+1;
}
$stmt->close();$i=0;
while($i<count($result)){
$stmt = $db->stmt_init();
$stmt->prepare("Select first_name,last_name,middle_name,dob_day,dob_month,dob_year from students where student_id=?");
$stmt->bind_param('i',$result[$i]['id']);
if(!$stmt->execute())throw new Exception($db->error);
$stmt->bind_result($first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year);
while($stmt->fetch()){
	$student_id=$result[$i]['id'];
	if($middle_name===null or $middle_name==='')$name=$first_name." ".$last_name;
	else $name=$first_name ." ".$middle_name." ".$last_name; 
	$dob=$dob_day."-".$dob_month."-".$dob_year;
	$result[$i]=array("id"=>$student_id,"name"=>$name,"dob"=>$dob);
}
$stmt->close();
$i=$i+1;
}
return $result;
}

try{
$db = new mysqli($server,$server_uname,$server_pwd,$dbname);
if(!$db)throw new Exception($db->error);
getSanitizedInput();
$list=getStudentList();
echo json_encode($list);
}
catch (Exception $e) { 
			echo 'Search failed: Error Code='.$e->getCode();
			echo	$e->getMessage();
			$db->close();
		}
?>