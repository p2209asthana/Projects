<?php

require_once 'b_serverinfo.php';
require_once 'b_session_handler.php';
checkSession();
function getCurrAddress($curr_address_id){
	global $db;
	global $c_line1,$c_line2,$c_city_vpo,$c_district,$c_state,$c_pin_code,$c_home_phone;
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT line1,line2,city_vpo,pin_code,home_phone,address_district_id from addresses where address_id= ?");
	$stmt->bind_param('i', $curr_address_id);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($c_line1,$c_line2,$c_city_vpo,$c_pin_code,$c_home_phone,$c_district_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT district,district_state_id from districts where district_id= ?");
	$stmt->bind_param('i', $c_district_id);
	if(!$stmt->execute())throw new Exception( $db->error);
	$stmt->bind_result($c_district,$c_state_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT state from states where state_id= ?");
	$stmt->bind_param('i', $c_state_id);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($c_state);
	$stmt->fetch();
	$stmt->close();
}
function getPermAddress($perm_address_id){
	global $db;
	global $p_line1,$p_line2,$p_city_vpo,$p_district,$p_state,$p_pin_code,$p_home_phone;
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT line1,line2,city_vpo,pin_code,home_phone,address_district_id from addresses where address_id= ?");
	$stmt->bind_param('i', $perm_address_id);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($p_line1,$p_line2,$p_city_vpo,$p_pin_code,$p_home_phone,$p_district_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT district,district_state_id from districts where district_id= ?");
	$stmt->bind_param('i', $p_district_id);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($p_district,$p_state_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT state from states where state_id= ?");
	$stmt->bind_param('i', $p_state_id);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($p_state);
	$stmt->fetch();
	$stmt->close();
}
function getStudentData(){
	global $db,$student_id;
	global $school_id,$reg_no,$entry_no,$date_admssn;
	global $first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year,$uid_no;
	global $father_first_name,$father_last_name,$father_middle_name,$father_phone,$father_emailid,$father_edu_qual_id,$father_occupation_id;
	global $mother_first_name,$mother_last_name,$mother_middle_name,$mother_phone,$mother_emailid,$mother_edu_qual_id,$mother_occupation_id;
	global $bank_acc_no,$bank_id,$bank_ifsc_code,$bank_branch; 
	global $c_line1,$c_line2,$c_city_vpo,$c_district,$c_state,$c_pin_code,$c_home_phone;
	global $p_line1,$p_line2,$p_city_vpo,$p_district,$p_state,$p_pin_code,$p_home_phone;
	global $height,$weight,$sex,$category,$locality,$is_handicapped,$type_handicap,$religion_id,$caste_id;
	global $last_school_name,$last_school_type,$last_school_med,$last_class;
	global $dist_from_home,$country_id,$co_curricular_activity,$parents_income;
	global $last_school_name,$last_school_type,$last_school_med,$last_class;
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT 
	first_name,last_name,middle_name,
	dob_day,dob_month,dob_year,
	uid_no,
	father_first_name,father_last_name,father_middle_name,father_phone,father_emailid,
	mother_first_name,mother_last_name,mother_middle_name,mother_phone,mother_emailid,
	bank_acc_no,student_bank_id,bank_ifsc_code,bank_branch,
	curr_address_id,perm_address_id,
	height,weight,sex,category,locality,is_handicapped,type_handicap,
	student_religion_id,student_caste_id,student_country_id,
	father_occupation_id,mother_occupation_id,
	father_edu_qual_id,mother_edu_qual_id,co_curricular_activity,
	parents_income,
	last_school_name,last_school_type,last_school_med,last_class,dist_from_home
	from students where student_id= ?");
	$stmt->bind_param('i',$student_id);
	if(!$stmt->execute())throw new Exception( $db->error);
	$stmt->bind_result(
	$first_name,$last_name,$middle_name,
	$dob_day,$dob_month,$dob_year,
	$uid_no,
	$father_first_name,$father_last_name,$father_middle_name,$father_phone,$father_emailid,
	$mother_first_name,$mother_last_name,$mother_middle_name,$mother_phone,$mother_emailid,
	$bank_acc_no,$bank_id,$bank_ifsc_code,$bank_branch,
	$curr_address_id,$perm_address_id,
	$height,$weight,$sex,$category,$locality,$is_handicapped,$type_handicap,
	$religion_id,$caste_id,$country_id,
	$father_occupation_id,$mother_occupation_id,
	$father_edu_qual_id,$mother_edu_qual_id,$co_curricular_activity,
	$parents_income,
	$last_school_name,$last_school_type,$last_school_med,$last_class,$dist_from_home);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	getCurrAddress($curr_address_id);
	getPermAddress($perm_address_id);
	/*echo $first_name."<br />".$last_name."<br />".$middle_name."<br />".$dob_day."<br />".$dob_month."<br />".$dob_year."<br />".$uid_no."<br />".$father_first_name."<br />".$father_last_name."<br />".$father_middle_name."<br />".$father_phone."<br />".$father_emailid."<br />".$mother_first_name."<br />".$mother_last_name."<br />".$mother_middle_name."<br />".$mother_phone."<br />".$mother_emailid."<br />".$bank_acc_no."<br />".$bank_id."<br />".$bank_ifsc_code."<br />".$bank_branch."<br />".$c_line1."<br />".$c_line2."<br />".$c_city_vpo."<br />".$c_district."<br />".$c_state."<br />".$perm_address_id."<br />".$height."<br />".$weight."<br />".$sex."<br />".$category."<br />".$locality."<br />".$is_handicapped."<br />".$type_handicap."<br />".$religion_id."<br />".$caste_id."<br />".$country_id."<br />".$father_occupation_id."<br />".$mother_occupation_id."<br />".	$father_edu_qual_id."<br />".$mother_edu_qual_id."<br />".$co_curricular_activity."<br />".
	$parents_income."<br />".	$last_school_name."<br />".$last_school_type."<br />".$last_school_med."<br />".$last_class;
	*/
	
}
try{
$db = new mysqli($server,$server_uname,$server_pwd,$dbname);
$student_id=$db->real_escape_string($_GET['id']);

if(!isset($student_id)||empty($student_id))
{header('location:index.php');exit();}//set return page here
else {getStudentData();}
}
catch (Exception $e) { 
			echo 'Fetching values failed: Error Code='.$e->getCode();
			echo $e->getMessage();
			$db->close();
		}


?>