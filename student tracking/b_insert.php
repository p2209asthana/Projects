<?php 
require_once 'b_serverinfo.php';
require_once 'b_session_handler.php';
checkSession();
function getImage(){
	$fileStatus=$_FILES['s_img']['error'];
	$fileType = $_FILES['s_img']['type'];
	$fileSize = $_FILES['s_img']['size'];
	switch($fileStatus){
		case UPLOAD_ERR_INI_SIZE: 
			die("The uploaded file exceeds the upload_max_filesize directive in php.ini");
        case UPLOAD_ERR_FORM_SIZE: 
            die("The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form"); 
        case UPLOAD_ERR_PARTIAL: 
            die("The uploaded file was only partially uploaded"); 
        case UPLOAD_ERR_NO_FILE: 
           // die("No file was uploaded");
			return -1;
        case UPLOAD_ERR_NO_TMP_DIR: 
            die("Missing a temporary folder");      
        case UPLOAD_ERR_CANT_WRITE: 
            die( "Failed to write file to disk"); 
        case UPLOAD_ERR_EXTENSION: 
            die("File upload stopped by extension");
	}
	if($fileSize/1024 > '1024')	//FileSize Checking
		die ('Maximum Image Size allowed is 1 MB');
	if($fileType != 'image/png' && $fileType != 'image/jpg' && $fileType != 'image/jpeg')//file type checking ends here.
		die('Sorry this file type is not supported we accept only. jpg, jpeg, png');
	
	$timestamp=date('Y_m_d_H_i_s');//will not work if many users upload at same time
	$upFile = 'uploads/'.$timestamp.$_FILES['s_img']['name'];
	if(is_uploaded_file($_FILES['s_img']['tmp_name'])) {
		if(!move_uploaded_file($_FILES['s_img']['tmp_name'], $upFile))
			die('Problem could not move file to destination.');
	}else
		die('Problem: Possible file upload attack. Filename: ');
	$s_img = $upFile;

	//File upload ends here
	//echo $upFile;
	return $upFile;
}
function renameImage($image,$student_id){
	if($image==-1)return -1;
	if(strripos($image,".jpg"))//assuming image has only one extension i.e. it is not malicious
	$type="jpg";
	else if(strripos($image,".jpeg"))
	$type="jpeg";
	else if(strripos($image,".png"))
	$type="png";
	return rename($image,'uploads/'.$student_id.'.'.$type);	
}/*
function getSex(){
	global $sex;
	if(($sex=='Male')||($sex=='male')||($sex=='M')||($sex=='m'))
		return 0;
	else if (($sex=='Female')||($sex=='female')||($sex=='F')||($sex=='f'))
		return 1;
	else return 2;//other
}
function getReligionId(){
	global $db,$religion;
	$sql="SELECT * from religions  where religion='".$religion."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['religion_id'];
}
function getBankId(){
	global $db,$bank_name;
	$sql="SELECT * from banks  where bank_name='".$bank_name."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['bank_id'];
}
function getFatherEduQualId(){
	global $db,$father_edu_qual;
	$sql="SELECT * from education  where edu_qual='".$father_edu_qual."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['edu_qual_id'];
}
function getMotherEduQualId(){
	global $db,$mother_edu_qual;
	$sql="SELECT * from education  where edu_qual='".$mother_edu_qual."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['edu_qual_id'];
}
function getFatherOccupationId(){
	global $db,$father_occupation;
	$sql="SELECT * from occupations  where occupation='".$father_occupation."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['occupation_id'];
}
function getMotherOccupationId(){
	global $db,$mother_occupation;
	$sql="SELECT * from occupations  where occupation='".$mother_occupation."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['occupation_id'];
}
function getCountryId(){
	global $db,$country;
	$sql="SELECT * from countries  where country='".$country."'";
	$result=$db->query($sql);
	if($result==false){throw new Exception('Wrong SQL: ' . $sql . ' Error: ' . $db->error);
	}
	$row= $result->fetch_assoc();
	return $row['country_id'];
}*/
function insertCurrAdress(){
	global $db,$c_line1,$c_line2,$c_city_vpo,$c_pin_code,$c_home_phone,$c_state,$c_district;
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT state_id from states  where state= ?");
	$stmt->bind_param('s', $c_state);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($c_state_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT district_id from districts  where district_state_id= ? and district= ?");
	$stmt->bind_param('is', $c_state_id,$c_district);
	if(!$stmt->execute())throw new Exception( $db->error);
	$stmt->bind_result($c_district_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("INSERT INTO addresses(line1,line2,city_vpo,pin_code,address_district_id,home_phone) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param('sssiii', $c_line1,@$c_line2,$c_city_vpo,$c_pin_code,$c_district_id,@$c_home_phone);
	if(!$stmt->execute()){throw new Exception( $db->error);}
	$stmt->close();//dont forget to do it
	
	return mysqli_insert_id($db);
}
function isSameAddress(){
	global $c_line1,$c_line2,$c_city_vpo,$c_pin_code,$c_home_phone,$c_state,$c_district;
	global $p_line1,$p_line2,$p_city_vpo,$p_pin_code,$p_home_phone,$p_state,$p_district;
	if(($c_state==$p_state)and($c_district==$p_district)and($c_pin_code==$p_pin_code)and($c_city_vpo==$p_city_vpo)and($c_line1==$p_line1)and ($c_line2==$p_line2))
		return true;
	else return false;
}
function insertPermAdress(){
	global $db;
	global $curr_address_id;
	global $p_line1,$p_line2,$p_city_vpo,$p_pin_code,$p_home_phone,$p_state,$p_district;
	if(isSameAddress())
		return $curr_address_id;
		
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT state_id from states  where state= ?");
	$stmt->bind_param('s', $p_state);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->bind_result($p_state_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("SELECT district_id from districts  where district_state_id= ? and district= ?");
	$stmt->bind_param('is', $p_state_id,$p_district);
	if(!$stmt->execute())throw new Exception( $db->error);
	$stmt->bind_result($p_district_id);
	$stmt->fetch();
	$stmt->close();//dont forget to do it
	
	$stmt = $db->stmt_init();
	$stmt->prepare("INSERT INTO addresses(line1,line2,city_vpo,pin_code,address_district_id,home_phone) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param('sssiii', $p_line1,@$p_line2,$p_city_vpo,$p_pin_code,$p_district_id,@$p_home_phone);
	if(!$stmt->execute()){throw new Exception($db->error);}
	$stmt->close();//dont forget to do it
	
	return mysqli_insert_id($db);
}
function insertStudentRecord(){
	global $db;
	global $first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year,$uid_no;
	global $father_first_name,$father_last_name,$father_middle_name,$father_phone,$father_emailid,$father_occupation_id,$father_edu_qual_id;
	global $mother_first_name,$mother_last_name,$mother_middle_name,$mother_phone,$mother_emailid,$mother_occupation_id,$mother_edu_qual_id;
	global $bank_acc_no,$bank_id,$bank_ifsc_code,$bank_branch;
	global $curr_address_id,$perm_address_id;
	global $height,$weight,$sex,$category,$locality,$is_handicapped,$type_handicap,$religion_id,$caste_id,$country_id;
	global $last_school_name,$last_school_type,$last_school_med,$last_class,$dist_from_home;
	global $co_curricular_activity;
	global $parents_income;
	
	$stmt = $db->stmt_init();
	$stmt->prepare("INSERT INTO students(
	first_name,last_name,middle_name,
	dob_day,dob_month,dob_year,uid_no,
	father_first_name,father_last_name,father_middle_name,father_phone,father_emailid,
	mother_first_name,mother_last_name,mother_middle_name,mother_phone,mother_emailid,
	bank_acc_no,student_bank_id,bank_ifsc_code,bank_branch,
	curr_address_id,perm_address_id,
	height,weight,sex,category,locality,is_handicapped,type_handicap,
	student_religion_id,student_caste_id,student_country_id,
	father_occupation_id,mother_occupation_id,
	father_edu_qual_id,mother_edu_qual_id,co_curricular_activity,
	parents_income,
	last_school_name,last_school_type,last_school_med,last_class,dist_from_home)
	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$stmt->bind_param('sssiiissssissssisiissiiiiiiiisiiiiiiisisiiii',
	$first_name,$last_name,@$middle_name,
	$dob_day,$dob_month,$dob_year,@$uid_no,
	$father_first_name,$father_last_name,@$father_middle_name,@$father_phone,@$father_emailid,
	$mother_first_name,$mother_last_name,@$mother_middle_name,@$mother_phone,@$mother_emailid,
	$bank_acc_no,$bank_id,@$bank_ifsc_code,$bank_branch,
	$curr_address_id,$perm_address_id,
	$height,$weight,$sex,$category,$locality,$is_handicapped,$type_handicap,
	$religion_id,$caste_id,$country_id,
	$father_occupation_id,$mother_occupation_id,
	$father_edu_qual_id,$mother_edu_qual_id,$co_curricular_activity,
	$parents_income,$last_school_name,$last_school_type,$last_school_med,$last_class,$dist_from_home);
	
	if(!$stmt->execute()){throw new Exception($db->error);}
	$stmt->close();//dont forget to do it
	return mysqli_insert_id($db);
}
function insertEnrollmentRecord(){
	global $db,$school_id,$student_id,$reg_no,$entry_no,$date_admssn;
	$stmt = $db->stmt_init();
	$stmt->prepare("INSERT INTO enrollments
	(enrollment_student_id,enrollment_school_id,reg_no,entry_no,entry_date)VALUES (?,?,?,?,?)");
	$stmt->bind_param('iisss',$student_id,$school_id,@$reg_no,$entry_no,$date_admssn);
	if(!$stmt->execute())throw new Exception( $db->error);
	$stmt->close();//dont forget to do it
	//echo $date_admssn;
}
function insertResultRecord(){
	global $db,$student_id,$class,$date_admssn;
	$session_year=date_parse_from_format("Y-m-d", $date_admssn)['year'];
	$stmt = $db->stmt_init();
	$stmt->prepare("INSERT into results (result_student_id,class,session_year) VALUES (?,?,?)");
	$stmt->bind_param('iii',$student_id,$class,$session_year);
	if(!$stmt->execute())throw new Exception($db->error);
	$stmt->close();

}
function getSanitizedInput(){
global $db;
global $school_id,$class,$reg_no,$entry_no,$date_admssn;
global $first_name,$last_name,$middle_name,$dob_day,$dob_month,$dob_year,$uid_no;
global $father_first_name,$father_last_name,$father_middle_name,$father_phone,$father_emailid,$father_edu_qual_id,$father_occupation_id;
global $mother_first_name,$mother_last_name,$mother_middle_name,$mother_phone,$mother_emailid,$mother_edu_qual_id,$mother_occupation_id;
global $bank_acc_no,$bank_ifsc_code,$bank_branch,$bank_id; 
global $c_line1,$c_line2,$c_city_vpo,$c_district,$c_state,$c_pin_code,$c_home_phone;
global $p_line1,$p_line2,$p_city_vpo,$p_district,$p_state,$p_pin_code,$p_home_phone;
global $height,$weight,$religion_id,$caste_id,$sex,$category,$locality,$is_handicapped,$type_handicap;
global $last_school_name,$last_school_id,$last_school_type,$last_school_med,$last_class;
global $dist_from_home,$country,$country_id,$co_curricular_activity,$parents_income;

$school_id=getSessionDetails()['user_school_id'];
$class=@$db->real_escape_string($_POST['curr_class']);
$reg_no=@trim($db->real_escape_string($_POST['reg_no']));
$entry_no=@trim($db->real_escape_string($_POST['entry_no']));

$date_admssn=@$db->real_escape_string($_POST['date_admssn']);
//conert date into yyyy-mm-dd format
$date_admssn =@ date_parse_from_format("d-m-Y", $date_admssn);
$date_admssn =@ $date_admssn['year']."-".$date_admssn['month']."-".$date_admssn['day'];


$first_name=@trim($db->real_escape_string($_POST['st_fname']));
$last_name=@trim($db->real_escape_string($_POST['st_lname']));
$middle_name=@trim($db->real_escape_string($_POST['st_mname']));//optional
$dob_day=@$db->real_escape_string($_POST['dob_d']);
$dob_month=@$db->real_escape_string($_POST['dob_m']);
$dob_year=@$db->real_escape_string($_POST['dob_y']);
$uid_no=@trim($db->real_escape_string($_POST['adhar_no']));//optional

$father_first_name=@trim($db->real_escape_string($_POST['father_fname']));
$father_last_name=@trim($db->real_escape_string($_POST['father_lname']));
$father_middle_name=@trim($db->real_escape_string($_POST['father_mname']));//optional
$father_phone=@trim($db->real_escape_string($_POST['father_no']));//optional
$father_emailid=@trim($db->real_escape_string($_POST['father_mail']));//optional
$father_edu_qual_id=@$db->real_escape_string($_POST['father_qual']);//required later
$father_occupation_id=@$db->real_escape_string($_POST['father_occup']);//required later

$mother_first_name=@trim($db->real_escape_string($_POST['mother_fname']));
$mother_last_name=@trim($db->real_escape_string($_POST['mother_lname']));
$mother_middle_name=@trim($db->real_escape_string($_POST['mother_mname']));//optional
$mother_phone=@trim($db->real_escape_string($_POST['mother_no']));//optional
$mother_emailid=@trim($db->real_escape_string($_POST['mother_mail']));//optional
$mother_edu_qual_id=@$db->real_escape_string($_POST['mother_qual']);//required later
$mother_occupation_id=@$db->real_escape_string($_POST['mother_occup']);//required later

$bank_acc_no=@trim($db->real_escape_string($_POST['bank_accNo']));
$bank_ifsc_code=@trim($db->real_escape_string($_POST['bank_ifsc']));	//optional
$bank_branch=@trim($db->real_escape_string($_POST['bank_branch']));		
$bank_id=@$db->real_escape_string($_POST['bank_name']);//required later

$height=@trim($db->real_escape_string($_POST['s_height']));
$weight=@trim($db->real_escape_string($_POST['s_weight']));

//address
//current address
$c_line1=@trim($db->real_escape_string($_POST['c_adrs1']));
$c_line2=@trim($db->real_escape_string($_POST['c_adrs2']));
$c_city_vpo=@trim($db->real_escape_string($_POST['c_city']));
$c_district=@trim($db->real_escape_string($_POST['c_district']));
$c_state=@trim($db->real_escape_string($_POST['c_state']));
$c_pin_code=@trim($db->real_escape_string($_POST['c_postcode']));
$c_home_phone=@trim($db->real_escape_string($_POST['c_home_phone']));//optional
$curr_address_id=0;//required later

//permanent address
//may be same as current address
$p_line1=@trim($db->real_escape_string($_POST['p_adrs1']));
$p_line2=@trim($db->real_escape_string($_POST['p_adrs2']));
$p_city_vpo=@trim($db->real_escape_string($_POST['p_city']));
$p_district=@trim($db->real_escape_string($_POST['p_district']));
$p_state=@trim($db->real_escape_string($_POST['p_state']));
$p_pin_code=@trim($db->real_escape_string($_POST['p_postcode']));
$p_home_phone=@trim($db->real_escape_string($_POST['p_home_phone']));//optional
$perm_address_id=0;//required later

$religion_id=@$db->real_escape_string($_POST['s_religion']);;//required later
$caste_id=@$db->real_escape_string($_POST['s_caste']);
$sex=@$db->real_escape_string($_POST['s_sex']);
$category=@$db->real_escape_string($_POST['s_category']);
$locality=@$db->real_escape_string($_POST['s_locality']);
$is_handicapped=@$db->real_escape_string($_POST['s_handicap']);
$type_handicap=@trim($db->real_escape_string($_POST['s_disability']));

$last_school_name=@trim($db->real_escape_string($_POST['last_school_name']));
$last_school_type=@$db->real_escape_string($_POST['last_school_type']);
$last_school_med=@$db->real_escape_string($_POST['last_school_med']);
$last_class=@$db->real_escape_string($_POST['last_class']);

$dist_from_home=@trim($db->real_escape_string($_POST['dist_from_home']));
$country=@$db->real_escape_string($_POST['s_nation']);
$country_id=@$db->real_escape_string($_POST['s_nation']);//required later
$co_curricular_activity=@trim($db->real_escape_string($_POST['co_curri']));
$parents_income=@trim($db->real_escape_string($_POST['parent_income']));
}



{

$db = new mysqli($server,$server_uname,$server_pwd,$dbname);
getSanitizedInput();
/*------------------------------fetching input ends here--------------------------------*/
/*
echo count($_POST['s_sports']);
echo "<br />";
echo $_POST['s_sports'];
echo "<br />";*/
try{
	$db->autocommit(FALSE);
	$image_adrs=getImage();

	//$country_id=getCountryId();
	$curr_address_id=insertCurrAdress();
	$perm_address_id=insertPermAdress();
	$student_id=insertStudentRecord();
	insertEnrollmentRecord();
	insertResultRecord();
	$renamed_image_adrs=renameImage($image_adrs,$student_id);
	$db->commit();
	echo 'Transaction completed successfully!';
	$db->close();
	header('location:index.php');
	exit();
}
catch (Exception $e) { 
			echo 'Transaction failed: Error Code='.$e->getCode();
			echo	$e->getMessage();
			$db->rollback();
			$db->close();
			if(isset($image_adrs)and $image_adrs!=-1)unlink($image_adrs);//delete the uploaded image. It is an atomic step
			if(isset($renamed_image_adrs)and $renamed_image_adrs!=-1)unlink($renamed_image_adrs);//delete the uploaded image. It is an atomic step
		}
			
}	
?>