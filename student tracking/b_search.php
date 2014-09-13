<?php
require_once 'b_serverinfo.php';
require_once 'b_session_handler.php';
checkSession();
function search()
{
global $db,$reg_no,$name,$dob;
global $result;

$name_arr=preg_split('/\s+/ ',trim($name));
$len=count($name_arr);
/*echo $len;
die();*/
if($len>0){
	if($len==1){$first_name=$name_arr[0];$last_name=Null;$middle_name=Null;}
	else if($len==2){$first_name=$name_arr[0];$last_name=$name_arr[1];$middle_name=Null;}
	else{$first_name=$name_arr[0];$last_name=$name_arr[2];$middle_name=$name_arr[1];}
}
	
$dob_arr = date_parse_from_format("d-m-Y", $dob);
$dob_year=$dob_arr['year'];
$dob_month=$dob_arr['month'];
$dob_day=$dob_arr['day'];
	
 if((isset($name) and !empty($name))or (isset($dob) and !empty($dob) and !($dob=='--')))//$dob=='--' check is important as -- is for default in date.
 {	
	$stmt = $db->stmt_init();
	$stmt->prepare("
					(
					SELECT students.student_id,students.first_name,students.last_name,students.middle_name,students.dob_day,students.dob_month,students.dob_year
					from students  where students.first_name= ? OR students.last_name=? OR (students.middle_name=? and students.middle_name NOT IN (' ', NULL))OR students.dob_day=? OR students.dob_month=? OR students.dob_year=? 
					ORDER 		BY 		
								a=(CASE WHEN students.first_name=? THEN 1 ELSE 0 END 
							+ 	CASE WHEN students.last_name=? THEN 1 ELSE 0 END 
							+	CASE WHEN students.middle_name=? THEN 1 ELSE 0 END 
							+ 	CASE WHEN students.dob_day=? THEN 1 ELSE 0 END 
							+	CASE WHEN students.dob_month=? THEN 1 ELSE 0 END 
							+ 	CASE WHEN students.dob_year=? THEN 1 ELSE 0 END ) DESC
					)		
					UNION
					(SELECT students.student_id,students.first_name,students.last_name,students.middle_name,students.dob_day,students.dob_month,students.dob_year
					from students RIGHT JOIN enrollments ON students.student_id=enrollments.enrollment_student_id where enrollments.reg_no=?
					 
					ORDER BY
							b=(CASE WHEN enrollments.reg_no=? THEN 1 ELSE 0 END) DESC
					 )
						
							
							");
	$stmt->bind_param('sssiiisssiiiss',$first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year,$first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year,$reg_no,$reg_no);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($student_id,$first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year);
	$result=array();
	$i=0;
	while($stmt->fetch()){
		$name=$first_name." ".$middle_name." ".$last_name;
		$dob=$dob_day."-".$dob_month."-".$dob_year;
		$result[$i]=array("id"=>$student_id,"name"=>$name,"dob"=>$dob);
		$i=$i+1;
	}
	if($i==0)$result=0;
	$stmt->close();
}/*
else if(isset($name) and  !empty($name)){
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT student_id,dob_day,dob_month,dob_year from students  where first_name= ? AND last_name=? AND middle_name=?");
	$stmt->bind_param('sss',$first_name,$last_name,$middle_name);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($student_id,$dob_day,$dob_month,$dob_year);
	$result=array();
	$i=0;
	while($stmt->fetch()){
		$dob=$dob_day."-".$dob_month."-".$dob_year;
		$result[$i]=array("id"=>$student_id,"name"=>$name,"dob"=>$dob);
		$i=$i+1;
	}if($i==0)$result=0;
	$stmt->close();

}
else if(isset($dob)and !empty($dob)and !($dob=='--')){
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT student_id,first_name,last_name,middle_name from students  where dob_day=? AND dob_month=? AND dob_year=?");
	$stmt->bind_param('iii',$dob_day,$dob_month,$dob_year);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($student_id,$first_name,$last_name,$middle_name);
	$result=array();
	$i=0;
	while($stmt->fetch()){
		$name=$first_name." ".$middle_name." ".$last_name;
		$result[$i]=array("id"=>$student_id,"name"=>$name,"dob"=>$dob);
		$i=$i+1;
	}if($i==0)$result=0;
	$stmt->close();
}*/
else
{

$result=0;
}
return $result;
}



function getSanitizedInput(){
	global $db;
	global $reg_no,$name,$first_name,$last_name,$middle_name,$dob;
	$reg_no=@$db->real_escape_string($_POST['reg_id']);
	$name=@$db->real_escape_string($_POST['name']);
	$name=$name.' ';
	$dob=@$db->real_escape_string($_POST['dob']);
	//conert date into yyyy-mm-dd format
	

}

try{
$reg_no=0;
$first_name=0;$last_name=0;$dob=0;
$db = new mysqli($server,$server_uname,$server_pwd,$dbname);
if(!$db) throw new Exception ($db->error);
getSanitizedInput();
$result=search();
echo json_encode($result);
}
catch (Exception $e) { 
			echo 'Search failed: Error Code='.$e->getCode();
			echo	$e->getMessage();
			$db->close();
			}

?>