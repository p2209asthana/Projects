<?php
include 'header.php';
session_start();
if(!isset($_SESSION['sessionid']))
{header('location:logout.php');
exit();}
require_once 'serverinfo.php';
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
<style>
    
    .student-record{
        margin-top: 100px;
    }
    .col-sm-2{
        
        text-align: right;
    }
    .right{
        text-align: left;
    }
    .row{
        margin-bottom: 10px;
    }
    #left-panel{
        float: left;
        width:70%;
    }
    #right-panel{
        float:left;
        
    }
</style>

<body>    
    <div class="banner">
        <div class="banner-content">
            <h1>Student Tracking System</h1>
        </div>
        
    </div>
    <div class="container">
        <div class="student-record">
            <div class="row">
                <div class="col-sm-2">
                    <a href="index.php#searchRecord"><button class="btn btn-primary"><span class="glyphicon glyphicon-chevron-left"></span> &nbsp; Go Back</button></a>
                </div>
                
                <div class="col-sm-3"></div>
                <div class="col-sm-2">
                    <a href="update_record.php?id=<?php echo $student_id;?>"><button class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> &nbsp; Edit Record</button></a>
                </div>
               
            </div>    
                
            <br>
            <div class="row">
                <label class="col-sm-2 control-label">Registration No.</label>
                <label class="col-sm-2 control-label right"><?php echo $reg_no;?></label>
                <label class="col-sm-1 control-label" style="margin-left:-20px">Entry No.</label>
                <label class="col-sm-2 control-label right" style="margin-left:-20px"><?php echo $entry_no;?></label>
                <label class="col-sm-2 control-label" style="margin-left:-110px">Admission Date:</label>
                <label class="col-sm-2 control-label right"style="margin-left:-20px"><?php echo $date_admssn;?></label>
            </div>
            
            
            
            <div class="row">
                <label class="col-sm-2 control-label">School:</label>
                <label class="control-label col-sm-4 right">Government Sn. Sec. School, Roopnagar</label>
                <label class="control-label col-sm-3">Class: &nbsp;&nbsp;&nbsp;3</label>
            </div>
            
            <div class="row">
                
            
            <div id="left-panel">
                
            
                <div class="row">
                    <label class="col-sm-3 control-label" style="text-align: right">Student's Name: </label>
                    <label class="col-sm-3 control-label right"><?php echo $first_name." ".$middle_name." ".$last_name;?></label>
                    <label class="col-sm-2 control-label">Date of Birth:</label>
                    <label class="col-sm-2 control-label right"><?php echo $dob_day."-".$dob_month."-".$dob_year;?></label>
                </div>

                <div class="row">
                    <label class="col-sm-3 control-label" style= "text-align:right">Father's Name:</label>
                    <label class="col-sm-3 control-label right"><?php echo $father_first_name." ".$father_middle_name." ".$father_last_name;?></label>
                    <label class="col-sm-2 control-label">Contact No.</label>
                    <label class="col-sm-2 control-label right"><?php echo $father_phone;?></label>
                </div>

                <div class="row">
                    <label class="col-sm-3 control-label" style= "text-align:right">Mother's Name:</label>
                    <label class="col-sm-3 control-label right"><?php echo $mother_first_name." ".$mother_middle_name." ".$mother_last_name;?></label>
                    <label class="col-sm-2 control-label">Contact No.</label>
                    <label class="col-sm-2 control-label right"><?php echo $mother_phone;?></label>
                </div>

                <div class="row">
                    <label class="col-sm-3 control-label" style= "text-align:right">Bank's Acc. no.:</label>
                    <label class="col-sm-3 control-label right"><?php echo $bank_acc_no?></label>
                    <label class="col-sm-2 control-label">IFSC Code:</label>
                    <label class="col-sm-2 control-label right"><?php echo $bank_ifsc_code;?></label>
                </div>
                
                <div class="row">
                    <label class="col-sm-3 control-label" style="text-align:right">Name of Bank:</label>
                    <label class="col-sm-3 control-label right"><?php echo $bank_id;?></label>
                    <label class="col-sm-2 control-label">Branch:</label>
                    <label class="col-sm-2 control-label right"><?php echo $bank_branch;?></label>
                </div>


                <div class="row">
                    <label class="col-sm-3 control-label" style= "text-align:right">Aadhaar Card No.</label>
                    <label class="col-sm-2 control-label right"><?php ?></label>
                </div>
            
            </div>  
            
            <div id="right-panel">
                <img src="uploads/<?php echo $student_id.'.jpg'?>" width="150px" height="150px">
            </div>
                
            </div>    
            <div class="row">
                <label class="col-sm-2 control-label">Student's height:</label>
                <label class="col-sm-2 control-label right"><?php echo $height."mt";?></label>
                <label class="col-sm-2 control-label">Weight:</label>
                <label class="col-sm-2 control-label right"><?php echo $weight."kg";?></label>
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Correspondence Address:</label>
                <label class="col-sm-5 control-label right"><?php echo $c_line1." ".$c_line2." ".$c_city_vpo." ".$c_district."-".$c_pin_code." ".$c_state;?> </label>
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Permanent Address:</label>
                <label class="col-sm-5 control-label right"><?php echo $p_line1." ".$p_line2." ".$p_city_vpo." ".$p_district."-".$p_pin_code." ".$p_state;?> </label></label>
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Nationality:</label>
                <label class="col-sm-2 control-label right"><?php echo $country_id;?></label>
                <label class="col-sm-2 control-label">Religion:</label>
                <label class="col-sm-2 control-label right"><?php echo $religion_id; ?></label>
                <label class="col-sm-1 control-label" style="margin-left:-30px">Caste:</label>
                <label class="col-sm-1 control-label right" style="margin-left:-30px"><?php echo $caste_id;?></label>
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Sex:</label>
                <label class="col-sm-2 control-label right"><?php echo $sex;?></label>
                <label class="col-sm-2 control-label">Category:</label>
                <label class="col-sm-2 control-label right"><?php echo $category;?></label>
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Locality:</label>
                <label class="col-sm-2 control-label right"><?php echo $locality;?></label>
                <label class="col-sm-2 control-label">Handicapped:</label>
                <label class="col-sm-2 control-label right"><?php echo $is_handicapped." ".$type_handicap;?></label>
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Last School Attended:</label>
                <label class="col-sm-4 control-label right"><?php echo $last_school_name;?></label>
                <label class="col-sm-2 control-label">Type:</label>
                <label class="col-sm-2 control-label right"><?php echo $last_school_type;?></label>         
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Medium:</label>
                <label class="col-sm-2 control-label right"><?php echo $last_school_med;?></label>
                <label class="col-sm-2 control-label">Class:</label>
                <label class="col-sm-2 control-label right"><?php echo $last_class;?></label>
                
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Distance of new school from home:</label>
                <label class="col-sm-2 control-label right"><?php echo $dist_from_home;?></label>
                
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Father's qualification:</label>
                <label class="col-sm-2 control-label right"><?php echo $father_edu_qual_id;?></label>
                <label class="col-sm-2 control-label">Mother's qualification:</label>
                <label class="col-sm-2 control-label right"><?php echo $mother_edu_qual_id;?></label>
                
                
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Annual Income:</label>
                <label class="col-sm-2 control-label right"><?php echo $parents_income;?></label>
                
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Father's Occupation:</label>
                <label class="col-sm-2 control-label right"><?php echo $father_occupation_id;?></label>
                <label class="col-sm-2 control-label" style="">Mother's Occupation:</label>
                <label class="col-sm-2 control-label right"><?php echo $mother_occupation_id;?></label>
                
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Sports Achievements:</label>
                <label class="col-sm-4 control-label right">Cricket (state)</label>
                
            </div>
            
            <div class="row">
                <label class="col-sm-2 control-label">Co-curricular activities:</label>
                <label class="col-sm-4 control-label right"><?php echo $co_curricular_activity;?></label>
                
            </div>
        </div>  
    </div>
    
   
    