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
 
    .form-contents{
        padding: 0px;
    }
    th{
        text-align: center;
    }
    
    .left-content{
        width: 100%;
        float: right;
        margin-top: 10px;
    }
    .left-panel{
        float: left;
        width: 65%;
    }
    .right-panel{
        float:left;
            width:35%;
    }
    .glyphicon-plus{
        position: absolute;
        margin-left: 10px;
        margin-top: 5px;
        cursor: pointer
    }
    
    .glyphicon-minus{
        position: absolute;
        margin-left: 25px;
        margin-top:5px;    
        cursor: pointer
    }
     .ui-datepicker{
        font-size: 95%;
    }
    
</style>

<body>    
    <div class="banner">
        <div class="banner-content">
            <h1>Student Tracking System</h1>
        </div>
        
    </div>
    
    <div class="container">
    <form method="post" action="update.php" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-contents">
            <div class="form-group" style="margin-top:90px;">
                <div class="left-panel">
                    <div class="left-content">
                        <label for="regno" class="col-sm-3 control-label">Registration No.<br> (if any)</label>
                        <div class="col-sm-2" style="position:absolute;margin-left: 190px">
                            <input type="text" name="reg_no" id="regno" class="form-control" value="<?php echo $reg_no;?>">
                        </div>
                    </div>
                    <div class="left-content">
                        <label class="col-sm-2 control-label" style="margin-left:65px">Entry No.</label>
                        <div class="col-sm-3">
                            <input type="text" name="entry_no" class="form-control" value="<?php echo $entry_no;?>">
                        </div>
                        <label class="col-sm-3 control-label" style="margin-left:-18px">Admission Date</label>
                        <div class="col-sm-2" style="width:150px;margin-left: -25px">
                            <div class="input-append date">
                                <input class="span2 form-control"  size="16" type="text" name="date_admssn" id="admssndate" value="<?php echo $date_admssn;?>" readonly>   
                                <span class="add-on" id="dp"><i class="glyphicon glyphicon-calendar" style="float:right;margin-top: -25px"></i></span>
                            </div>
                        </div>
                    </div>        
                    <div class="left-content">
                        <label class="col-sm-3 control-label">Name of School</label>
                        <div class="col-sm-5">
                            <label style="margin-top:7px">Government Sn. Sec. School, RoopNagar</label>
                        </div>
                        <label class="col-sm-1 control-label" style="margin-left:25px">Class</label>
                        <div class="col-sm-1" style="margin-left:-10px">
                            <select id="lastclass" name="last_class" class="form-control " style="width:65px;">
                                
                                <?php 
                                $i=1;
                                while($i<=12){
                                ?><option value="<?php echo $i;?>"><?php echo $i++; ?></option>
                                <?php
                                }    
                                ?>
                            </select>
                        </div>
                    </div>  
                </div>
                <div class="right-panel">
                    <div class="fileinput fileinput-new" data-provides="fileinput" style="margin-left:40px">
                        <div class="fileinput-new thumbnail" style="width:150px;height:150px;">
                             <!--<div style="background-color: #DCDCD1;height: 140px;padding: 10px"><p style="margin-top: 30px">Upload Passport <br>size photo<br><b>35mm x 45mm</b></div> -->
							<img src="uploads/<?php echo $student_id.'.jpg';?>">
                        </div>    
                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width:150px;max-height:150px;min-height: 100px">    
                        </div>
                        <div style="text-align:center">
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Select Image</span><span class="fileinput-exists">Change</span><input type="file" accept="image/*" name="s_img"></span>
                            <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-2 control-label">Student's Name</label>
                <div class="col-sm-5">
                <input type="text" name="st_fname" class="form-control alpha-only" id="inputName3" style="position: absolute; float:left;width:33%" value="<?php echo $first_name;?>" required>
                <input type="text" name="st_mname" class="form-control alpha-only"  style="position: absolute;float:left;margin-left: 165px;width:33%;padding: 3px" value="<?php echo $last_name;?>">
                <input type="text" name="st_lname" class="form-control alpha-only"  style="position: absolute;float:left;margin-left: 330px;width:33%" value="<?php echo $last_name;?>" required>
                </div>
               
            </div>
            
            <div class="form-group">
                <label for="inputdob" class="col-sm-2 control-label">Date of Birth</label>
                <div class="col-sm-1">
                    <select id="inputdob" name="dob_d" class="form-control " style="width:75px;" required>
                        <option value="">Day</option>
                        <?php 
                        $i=1;
                        while($i<=31){
                        ?><option value="<?php echo $i;?>" <?php if($i==$dob_day) echo 'selected='.'"selected"'?>><?php echo $i++; ?></option>
                        <?php
                        }    
                        ?>
                        
                    </select>
                </div>
                <div class="col-sm-1">
                    <select id="inputdob" name="dob_m" class="form-control " style="width:90px;" required>
                        <option value="">Month</option>
                        <option value="1" <?php if($dob_month==1) echo 'selected='.'"selected"'?>>Jan</option>
                        <option value="2" <?php if($dob_month==2) echo 'selected='.'"selected"'?>>Feb</option>
                        <option value="3" <?php if($dob_month==3) echo 'selected='.'"selected"'?>>Mar</option>
                        <option value="4" <?php if($dob_month==4) echo 'selected='.'"selected"'?>>Apr</option>
                        <option value="5" <?php if($dob_month==5) echo 'selected='.'"selected"'?>>May</option>
                        <option value="6" <?php if($dob_month==6) echo 'selected='.'"selected"'?>>Jun</option>
                        <option value="7" <?php if($dob_month==7) echo 'selected='.'"selected"'?>>Jul</option>
                        <option value="8" <?php if($dob_month==8) echo 'selected='.'"selected"'?>>Aug</option>
                        <option value="9" <?php if($dob_month==9) echo 'selected='.'"selected"'?>>Sep</option>
                        <option value="10" <?php if($dob_month==10) echo 'selected='.'"selected"'?>>Oct</option>
                        <option value="11" <?php if($dob_month==11) echo 'selected='.'"selected"'?>>Nov</option>
                        <option value="12" <?php if($dob_month==12) echo 'selected='.'"selected"'?>>Dec</option>
                    </select>
                </div>
                <div class="col-sm-1">
                    <select id="inputdob" name="dob_y" class="form-control " style="width:80px;margin-left: 18px;" required>
                        <option value="">Year</option>
                        <?php 
                        $i=1990;
                        while($i<=2014){
                        ?><option value="<?php echo $i;?>"<?php if($i==$dob_year) echo 'selected='.'"selected"'?>><?php echo $i++; ?></option>
                        <?php
                        }    
                        ?>  
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputfName3" class="col-sm-2 control-label">Father's Name</label>
                <div class="col-sm-5">
                <input type="text" name="father_fname" class="form-control alpha-only" id="inputName3" style="position: absolute; float:left;width:33%" value="<?php echo $father_first_name;?>" required>
                <input type="text" name="father_mname" class="form-control"  style="position: absolute;float:left;margin-left: 165px;width:33%;padding: 3px" value="<?php echo $father_middle_name;?>">
                <input type="text" name="father_lname" class="form-control"  style="position: absolute;float:left;margin-left: 330px;width:33%" value="<?php echo $father_last_name;?>" required>
                </div>
                <label for="inputfNo3" class="col-sm-2 control-label" style="position: absolute;text-align: left;margin-left: 30px;">Contact</label>
                <div class="col-sm-2" style="margin-left: 90px">
                    <input type="text" name="father_no" class="form-control num-only" id="inputfNo3" style=" width:80%;float:left;" value="<?php echo $father_phone;?>">
                <input type="email" name="father_mail" class="form-control" id="inputfNo3" style="position: absolute;float:left;margin-left: 140px;" value="<?php echo $father_emailid;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputmName3" class="col-sm-2 control-label">Mother's Name</label>
                <div class="col-sm-5">
                <input type="text" name="mother_fname" class="form-control alpha-only" id="inputName3" style="position: absolute; float:left;width:33%" value="<?php echo $mother_first_name;?>" required>
                <input type="text" name="mother_mname" class="form-control"  style="position: absolute;float:left;margin-left: 165px;width:33%;padding: 3px" value="<?php echo $mother_middle_name;?>">
                <input type="text" name="mother_lname" class="form-control"  style="position: absolute;float:left;margin-left: 330px;width:33%" value="<?php echo $mother_last_name;?>" required>
                </div>
                <label for="inputfNo3" class="col-sm-2 control-label" style="position: absolute;text-align: left;margin-left: 30px">Contact</label>
                <div class="col-sm-2" style="margin-left: 90px">
                <input type="text" name="mother_no" class="form-control num-only" id="inputfNo3" style="width:80%;float: left;" value="<?php echo $mother_phone;?>">
                <input type="email" name="mother_mail" class="form-control" id="inputfNo3" style="position: absolute;float:left;margin-left: 140px;" value="<?php echo $mother_emailid;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputbank" class="col-sm-2 control-label">Bank Acc. no.(if any)</label>
                <div class="col-sm-5">
                    <input type="text" name="bank_accNo" class="form-control" id="inputbank" value="<?php echo $bank_acc_no;?>">
                </div>
                <label for="ifsc" class="col-sm-2 control-label" style="text-align: left">IFSC CODE</label>
                <div class="col-sm-2" style="margin-left: -100px;">
                    <input type="text" name="bank_ifsc" class="form-control" id="ifsc" value="<?php echo $bank_ifsc_code;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="bankname" class="col-sm-2 control-label">Name of Bank</label>
                <div class="col-sm-5"> <?php $bank_id=12;?>
                    <select name="bank_name" class="form-control" id="bankname">
                        <option value="">Select</option>
                        <option value="1" <?php if($bank_id==1) echo 'selected='.'"selected"'?>>State Bank of India</option>
                        <option value="2" <?php if($bank_id==2) echo 'selected='.'"selected"'?>>HDFC Bank</option>
                        <option value="3" <?php if($bank_id==3) echo 'selected='.'"selected"'?>>Punjab National Bank</option>
                        <option value="4" <?php if($bank_id==4) echo 'selected='.'"selected"'?>>ICICI Bank</option>
                        <option value="5" <?php if($bank_id==5) echo 'selected='.'"selected"'?>>Yes Bank</option>
                        <option value="6" <?php if($bank_id==6) echo 'selected='.'"selected"'?>>Bank of India</option>
                        <option value="7" <?php if($bank_id==7) echo 'selected='.'"selected"'?>>Axis Bank</option>
                        <option value="8" <?php if($bank_id==8) echo 'selected='.'"selected"'?>>Allahabad Bank</option>
                        <option value="9" <?php if($bank_id==9) echo 'selected='.'"selected"'?>>Andhra Bank</option>
                        <option value="10" <?php if($bank_id==10) echo 'selected='.'"selected"'?>>Canara Bank</option>
                        <option value="11" <?php if($bank_id==11) echo 'selected='.'"selected"'?>>Syndicate Bank</option>
                        <option value="12" <?php if($bank_id==12) echo 'selected='.'"selected"'?>>Co-operative Bank</option>
                        <option value="13" <?php if($bank_id==13) echo 'selected='.'"selected"'?>>Other</option>
                        
                    </select>
                </div>
                <label for="bankbranch" class="col-sm-2 control-label" style="text-align: left;margin-left: 30px">Branch</label>
                <div class="col-sm-2" style="margin-left: -130px">
                    <input type="text" name="bank_branch" class="form-control" id="bankbranch" value="<?php echo $bank_branch;?>">
                </div>
            </div>
            
            <div class="form-group">
                <label for="adhar" class="col-sm-2 control-label">Student's Adhar (if any)</label>
                <div class="col-sm-5">
                    <input type="text" name="adhar_no" class="form-control" id="adhar" value="">
                </div>
            </div>
            
            <div class="form-group">
                <label for="height" class="col-sm-2 control-label">Student's height (in mt)</label>
                <div class="col-sm-1">
                    <input type="text" name="s_height" class="form-control dec-only" id="height" value="<?php echo $height;?>"required>
                </div>
                <label for="weight" class="col-sm-2 control-label"> Weight (in kgs)</label>
                <div class="col-sm-1">
                    <input type="text" name="s_weight" class="form-control num-only" id="weight" value="<?php echo $weight;?>"required>
                </div>    
            </div>
            
            <div class="form-group">
                <label for="correspond" class="col-sm-2 control-label">Correspondence Address</label>
                <div class="col-sm-8">
                    <input type="text" name="c_adrs1" class="form-control" id="c_adrs1" style="position: absolute; float:left;width: 45%" value="<?php echo $c_line1;?>" required>
                    <input type="text" name="c_adrs2" class="form-control" id="c_adrs2" style="float:left;width: 50%;margin-left: 380px" value="<?php echo $c_line2;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <input type="text" name="c_city" class="form-control" id="c_city"  style="position: absolute;float:left;width:20%" value="<?php echo $c_city_vpo;?>" required>
                    <input type="text" name="c_district" class="form-control" id="c_district" style="position: absolute;float:left;margin-left: 195px;width:20%" value="<?php echo $c_district;?>" required>
                    <input type="text" name="c_state" class="form-control" id="c_state" style="position: absolute;float:left;margin-left: 380px;width:20%" value="<?php echo $c_state;?>" required>
                    <input type="text" name="c_postcode" class="form-control num-only" id="c_postcode" maxlength="6" style="float:left;margin-left: 550px;width:20%" value="<?php echo $c_pin_code;?>" required >
                    
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-5">
                    <div class="checkbox">
                        <label><input type="checkbox" id="is_same_adrs">Permanent address same as Correspondence Address</label>
                    </div>
                </div>
                
            </div>
            
            <div class="form-group">
                <label for="correspond" class="col-sm-2 control-label">Permanent Address</label>
                <div class="col-sm-8">
                    <input type="text" name="p_adrs1" class="form-control" id="p_adrs1" style="position: absolute; float:left;width: 45%" value="<?php echo $p_line1;?>" required>
                    <input type="text" name="p_adrs2" class="form-control" id="p_adrs2" style="float:left;width: 50%;margin-left: 380px" value="<?php echo $p_line2;?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <input type="text" name="p_city" class="form-control" id="p_city" style="position: absolute;float:left;width:20%" value="<?php echo $p_city_vpo;?>" required>
                    <input type="text" name="p_district" class="form-control" id="p_district" style="position: absolute;float:left;margin-left: 195px;width:20%" value="<?php echo $p_district;?>" required>
                    <input type="text" name="p_state" class="form-control" id="p_state" style="position: absolute;float:left;margin-left: 380px;width:20%" value="<?php echo $p_state;?>" required>
                    <input type="text" name="p_postcode" class="form-control num-only" id="p_postcode" maxlength="6" style="float:left;margin-left: 550px;width:20%" value="<?php echo $p_pin_code;?>" required >
                    
                </div>
            </div>
            
            
            
            <div class="form-group">
                <label for="nation" class="col-sm-2 control-label">Nationality</label>
                <div class="col-sm-2">
                    <select name="s_nation" id="nation"class="form-control" required>
                        <option value="">Select</option>
                        <option value="1" <?php if($country_id==1) echo 'selected='.'"selected"'?>>India</option>
                        <option value="2" <?php if($country_id==2) echo 'selected='.'"selected"'?>>Pakistan</option>
                        <option value="3" <?php if($country_id==3) echo 'selected='.'"selected"'?>>Other</option>
                    </select>
                </div>
                
                <label for="religion" class="col-sm-2 control-label" style="text-align: left; margin-left: 50px">Religion</label>
                <div class="col-sm-2">
                    <select name="s_religion" class="form-control" style="margin-left: -125px;"id="religion" required>
                        <option value="">Select</option>
                        <option value="1" <?php if($religion_id==1) echo 'selected='.'"selected"'?>>Hindu</option>
                        <option value="2" <?php if($religion_id==2) echo 'selected='.'"selected"'?>>Sikh</option>
                        <option value="3" <?php if($religion_id==3) echo 'selected='.'"selected"'?>>Muslim</option>
                        <option value="4" <?php if($religion_id==4) echo 'selected='.'"selected"'?>>Christian</option>
                        <option value="5" <?php if($religion_id==5) echo 'selected='.'"selected"'?>>Jain</option>
                        <option value="6" <?php if($religion_id==6) echo 'selected='.'"selected"'?>>Parsi</option>
                        <option value="7" <?php if($religion_id==7) echo 'selected='.'"selected"'?>>Buddhist</option>
                        <option value="8" <?php if($religion_id==8) echo 'selected='.'"selected"'?>>No Religion</option>
                        <option value="9" <?php if($religion_id==9) echo 'selected='.'"selected"'?>>Other</option>
                    </select>
                </div>
                
                <label for="caste" class="col-sm-2 control-label" style="text-align: left;margin-left: -100px">Caste</label>
                <div class="col-sm-2">
                    <select name="s_caste"class="form-control" style="margin-left: -140px"id="caste" required>
                        <option value="">Select</option>
                        <option value="1" <?php if($caste_id==1) echo 'selected='.'"selected"'?>>Agarwal</option>
                        <option value="2" <?php if($caste_id==2) echo 'selected='.'"selected"'?>>Arora</option>
                        <option value="3" <?php if($caste_id==3) echo 'selected='.'"selected"'?>>Rajput</option>
                        <option value="4" <?php if($caste_id==4) echo 'selected='.'"selected"'?>>Khatri</option>
                        <option value="5" <?php if($caste_id==5) echo 'selected='.'"selected"'?>>Jat</option>
                        <option value="6" <?php if($caste_id==6) echo 'selected='.'"selected"'?>>Bhatia</option>
                        <option value="7">Other</option>    
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="sex" class="col-sm-2 control-label">Sex</label>
                <div class="col-sm-2">
                    <select name="s_sex" class="form-control">
                        <option>Select</option>
                        <option value="0" <?php if($sex==0) echo 'selected='.'"selected"'?>>Male</option>
                        <option value="1" <?php if($sex==1) echo 'selected='.'"selected"'?>>Female</option>
                        <option value="2" <?php if($sex==2) echo 'selected='.'"selected"'?>>Other</option>
                    </select>
                </div>
                
                <label for="category" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-3">
                    <div class="radio" style="float:left">
                        <label><input type="radio" name="s_category" value="0" <?php if($category==0) echo 'checked';?>>General</label>                        
                    </div>    
                    <div class="radio" style="float: left; margin-left: 60px">  
                        <label><input type="radio" name="s_category" value="1" <?php if($category==1) echo 'checked';?>>OBC</label>
                    </div>
                    <div class="radio" style="margin-left: 260px">  
                        <label><input type="radio" name="s_category" value="2" <?php if($category==2) echo 'checked';?>>SC/ST</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="locality" class="col-sm-2 control-label">Locality</label>
                <div class="col-sm-2">
                    <div class="radio" style="float: left">
                        <label><input type="radio" name="s_locality" value="0" <?php if($category==0) echo 'checked';?>>Urban</label>
                    </div>
                    <div class="radio" style="margin-left: 100px;">
                        <label><input type="radio" name="s_locality" value="1" <?php if($category==1) echo 'checked';?>>Rural</label>
                    </div>
                </div>
                
                <label for="handicap" class="col-sm-2 control-label">Handicapped</label>
                <div class="col-sm-3">
                    <div class="radio" style="float:left">
                        <label><input type="radio" name="s_handicap" value="0" <?php if($is_handicapped==0) echo 'checked';?>>Yes</label>                        
                    </div>    
                    <div class="radio" style="float: left; margin-left:87px">  
                        <label><input type="radio" name="s_handicap" value="1" <?php if($is_handicapped==1) echo 'checked';?>>No</label>
                    </div>
                    <div style="margin-left: 200px;width:130px">  
                    <input type="text" name="s_disablity" id="disability" class="form-control" value="<?php echo $type_handicap;?>" disabled>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="lastschool" class="col-sm-2 control-label">Name of last school attended</label>
                <div class="col-sm-5">
                    <input type="text" name="last_school_name" class="form-control" id="lastschool" value="<?php echo $last_school_name;?>"> 
                </div>
                <div class="radio" style="float: left; margin-left: 50px">
                    <label><input type="radio" name="last_school_type" value="0" <?php if($last_school_type==0) echo 'checked';?>>Govt.</label>
                </div>
                <div class="radio" style="float: left; margin-left: 75px">
                    <label><input type="radio" name="last_school_type" value="1" <?php if($last_school_type==1) echo 'checked';?>>Private</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="lastschoolmed" class="col-sm-2 control-label">Medium of school last attended</label>
                <div class="col-sm-5">
                    <div class="radio" style="float: left">
                        <label><input type="radio" name="last_school_med" value="1" <?php if($last_school_med==1) echo 'checked';?>>English</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 35px">
                        <label><input type="radio" name="last_school_med" value="2" <?php if($last_school_med==2) echo 'checked';?>>Punjabi</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 45px">
                        <label><input type="radio" name="last_school_med" value="3" <?php if($last_school_med==3) echo 'checked';?>>Hindi</label>
                    </div>
                    <div class="radio" style="margin-left: 320px">
                        <label><input type="radio" name="last_school_med" value="4" <?php if($last_school_med==4) echo 'checked';?>>Urdu</label>
                    </div>
                </div>
                <label for="lastclass" class="col-sm-2 control-label"  style="text-align:left;padding-left: 55px">Class</label>
                <div class="col-sm-1" style="margin-left:-90px">
                    <select id="lastclass" name="last_class" class="form-control " style="width:90px;">
                        <option>Select</option>
                        <?php 
                        $i=1;
                        while($i<=11){
                        ?><option value="<?php echo $i;?>" <?php if($i==$last_class) echo 'selected='.'"selected"'?>><?php echo $i++; ?></option>
                        <?php
                        }    
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="dist" class="col-sm-2 control-label">Distance of new school from place of residence</label>
                <div class="col-sm-1" style="width:100px">
                    <input type="text" name="dist_from_home"  class="form-control dec-only" id="dist" value="<?php echo $dist_from_home;?>">
                </div>
                <label class="col-sm-2 control-label">Parent's Qualification:</label>
                <label class="col-sm-1 control-label" for="fatherqual" style="text-align: left">Father</label>
                <div class="col-sm-2" style="width:170px;margin-left: -40px">
                    <select id="fatherqual" name="father_qual" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <?php if($father_edu_qual_id==1) echo 'selected='.'"selected"'?>>Primary</option>
                        <option value="2" <?php if($father_edu_qual_id==2) echo 'selected='.'"selected"'?>>Metric</option>
                        <option value="3" <?php if($father_edu_qual_id==3) echo 'selected='.'"selected"'?>>Secondary</option>
                        <option value="4" <?php if($father_edu_qual_id==4) echo 'selected='.'"selected"'?>>Diploma</option>
                        <option value="5" <?php if($father_edu_qual_id==5) echo 'selected='.'"selected"'?>>Graduate</option>
                        <option value="6" <?php if($father_edu_qual_id==6) echo 'selected='.'"selected"'?>>PostGraduate</option>
                    </select>
                </div>
                <label class="col-sm-1 control-label" for="motherqual">Mother</label>
                <div class="col-sm-2" style="width:170px;float: left;margin-left: -10px">
                    <select id="motherqual" name="mother_qual" class="form-control">
                        <option value="">Select</option>
                        <option value="1" <?php if($mother_edu_qual_id==1) echo 'selected='.'"selected"'?>>Primary</option>
                        <option value="2" <?php if($mother_edu_qual_id==2) echo 'selected='.'"selected"'?>>Metric</option>
                        <option value="3" <?php if($mother_edu_qual_id==3) echo 'selected='.'"selected"'?>>Secondary</option>
                        <option value="4" <?php if($mother_edu_qual_id==4) echo 'selected='.'"selected"'?>>Diploma</option>
                        <option value="5" <?php if($mother_edu_qual_id==5) echo 'selected='.'"selected"'?>>Graduate</option>
                        <option value="6" <?php if($mother_edu_qual_id==6) echo 'selected='.'"selected"'?>>PostGraduate</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Parent's Occupation</label>
                <label class="col-sm-1 control-label" for="fatheroccup" style="text-align:left;width: 100px">Father</label>
                <div class="col-sm-2" style="width:190px;margin-left: -40px">
                    <select id="fatheroccup" name="father_occup" class="form-control" >
                        <option value="">Select</option>
                        <option value="1" <?php if($father_occupation_id==1) echo 'selected='.'"selected"'?>>BusinessMan</option>
                        <option value="2" <?php if($father_occupation_id==2) echo 'selected='.'"selected"'?>>Doctor</option>
                        <option value="3" <?php if($father_occupation_id==3) echo 'selected='.'"selected"'?>>Engineer</option>
                        <option value="4" <?php if($father_occupation_id==4) echo 'selected='.'"selected"'?>>Farmer</option>
                        <option value="5" <?php if($father_occupation_id==5) echo 'selected='.'"selected"'?>>Govt. Employee</option>
                        <option value="6" <?php if($father_occupation_id==6) echo 'selected='.'"selected"'?>>Lawyer</option>
                        <option value="7" <?php if($father_occupation_id==7) echo 'selected='.'"selected"'?>>Shopkeeper</option>
                        <option value="8" <?php if($father_occupation_id==8) echo 'selected='.'"selected"'?>>Other</option>
                    </select>
                </div>
                <label class="col-sm-1 control-label" for="motheroccup" style="text-align: left;padding-left: 57px;">Mother</label>
                <div class="col-sm-2" style="width:190px;margin-left: 10px">
                    <select id="motheroccup" name="mother_occup" class="form-control">
                        <option value="">Select</option>
                        <option value="9" <?php if($mother_occupation_id==9) echo 'selected='.'"selected"'?>>BusinessWoman</option>
                        <option value="2" <?php if($mother_occupation_id==2) echo 'selected='.'"selected"'?>>Doctor</option>
                        <option value="3" <?php if($mother_occupation_id==3) echo 'selected='.'"selected"'?>>Engineer</option>
                        <option value="4" <?php if($mother_occupation_id==4) echo 'selected='.'"selected"'?>>Farmer</option>
                        <option value="5" <?php if($mother_occupation_id==5) echo 'selected='.'"selected"'?>>Govt. Employee</option>
                        <option value="10" <?php if($mother_occupation_id==10) echo 'selected='.'"selected"'?>>HouseWife</option>
                        <option value="6" <?php if($mother_occupation_id==6) echo 'selected='.'"selected"'?>>Lawyer</option>
                        <option value="7" <?php if($mother_occupation_id==7) echo 'selected='.'"selected"'?>>Shopkeeper</option>
                        <option value="8" <?php if($mother_occupation_id==8) echo 'selected='.'"selected"'?>>Other</option>
                    </select>
                </div>    
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="incomefig">Parent's Annual Income</label>
                <div class="col-sm-2">
                    <input type="text" name="parent_income" id="incomefig" ng-model="incomefigure" maxlength="9" class="form-control num-only" value="<?php echo $parents_income;?>">
                </div>
                <label class="col-sm-1 control-label"  for="incomeword" style="text-align:left">In words:</label>
                <label class="col-sm-5 control-label" style="text-align:left"ng-controller="convertincome">{{toWords()}}</label>
                
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="sports">Sports Achievements (if any)</label>
                <div class="col-sm-2">
                    <select id="sports" class="form-control" name="s_sports">
                        <option>Sport/Game</option>
                        <option value="0">Athletics</option>
                        <option value="1">Badminton</option>
                        <option value="2">BasketBall</option>
                        <option value="3">Cricket</option>
                        <option value="4">Football</option>
                        <option value="5">HandBall</option>
                        <option value="6">Hockey</option>
                        <option value="7">Kabaddi</option>
                        <option value="8">Lawn-Tennis</option>
                        <option value="9">Swimming</option>
                        <option value="10">Squash</option>
                        <option value="11">Table-Tennis</option>
                        <option value="12">VolleyBall</option>
                    </select>
                </div>
                <label class="col-sm-1 control-label" style="text-align:left">Level(s): </label>
                <div class="col-sm-5">
                    <div class="radio" style="float:left;margin-left: -30px">
                        <label><input type="radio" name="level" value="0">Zonal</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 25px">
                        <label><input type="radio" name="level" value="1">District</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 25px">
                        <label><input type="radio" name="level" value="2">state</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 25px">
                        <label><input type="radio" name="level" value="3">National</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 25px">
                        <label><input type="radio" name="level" value="4">International</label>
                    </div>  
                    <span class="add-on"><i class="glyphicon glyphicon-plus" title="Add another sport" onclick="append_form(this)"></i></span>
                </div>
             </div>
            <div class="form-group" id="appendsports"></div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="cocurri">Co-Curricular Achievements(if any)</label>
                <div class="col-sm-7">
                    <input type="text" name="co_curri" id="cocurri" class="form-control" value="<?php echo $co_curricular_activity;?>">
                </div>
            </div>
            
            <h3 style="text-align:center;margin-top: 25px">Record of Prev. Classes (only for Sn. Sec.) </h3>
            
            <table class="table table-striped table-bordered">
                <thead>
                    <tr><th>Year</th><th>Class</th><th>Roll No.</th><th>Total<br>marks</th><th>Marks<br>Obtained</th><th>%age</th><th>Subjects</th><th>Name of School</th></tr>        
                </thead>
                
                <tbody>
                    <tr>
                        <td><input type="text" id="year_ten" name="year_ten" class="form-control" style="width:80px"></td>
                        <td>10th</td>
                        <td><input type="text" id="roll_ten" name="rollno_ten" class="form-control" style="width:100px;"></td>
                        <td><input type="text" id="totalmarks_ten" name="totalmarks_ten" class="form-control" style="width:60px"></td>
                        <td><input type="text" id="marksobt_ten" name="marksobt_ten" class="form-control" style="width:60px"></td>
                        <td id="percent_ten"></td>
                        <td>
                            <div class="checkbox" style="float:left">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="1">Maths</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="2">Science</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="3">English</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;"><input type="checkbox" name="sub[]" val="4">Social Science</label>
                            </div>
                            <div class="checkbox" style="float:left">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="5">Hindi</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="6">Punjabi</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="7">Comp.</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;"><input type="checkbox" name="sub[]" val="8">Phy. Edu.</label>
                            </div>   
                        </td>
                        <td><input type="text" id="school_ten" name="lastschool_ten" class="form-control" style="width:250px"></td>
                    </tr>
                    
                    <tr>
                        <td><input type="text" id="year_ten" name="year_ten" class="form-control" style="width:80px"></td>
                        <td>11th</td>
                        <td><input type="text" id="roll_ten" name="rollno_ten" class="form-control" style="width:100px;"></td>
                        <td><input type="text" id="totalmarks_ten" name="totalmarks_ten" class="form-control" style="width:60px"></td>
                        <td><input type="text" id="marksobt_ten" name="marksobt_ten" class="form-control" style="width:60px"></td>
                        <td id="percent_ten"></td>
                        <td>
                        <div class="checkbox" style="float:left">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="1">Maths</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="2">Science</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="3">English</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;"><input type="checkbox" name="sub[]" val="4">Social Science</label>
                            </div>
                            <div class="checkbox" style="float:left">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="5">Hindi</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="6">Punjabi</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="7">Comp.</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;"><input type="checkbox" name="sub[]" val="8">Phy. Edu.</label>
                            </div>
                        </td>
                        <td><input type="text" id="school_ten" name="lastschool_ten" class="form-control" style="width:250px"></td>
                    </tr>
                    
                    <tr>
                        <td><input type="text" id="year_ten" name="year_ten" class="form-control" style="width:80px"></td>
                        <td>12th</td>
                        <td><input type="text" id="roll_ten" name="rollno_ten" class="form-control" style="width:100px;"></td>
                        <td><input type="text" id="totalmarks_ten" name="totalmarks_ten" class="form-control" style="width:60px"></td>
                        <td><input type="text" id="marksobt_ten" name="marksobt_ten" class="form-control" style="width:60px"></td>
                        <td id="percent_ten"></td>
                        <td>
                            <div class="checkbox" style="float:left">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="1">Maths</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="2">Science</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="3">English</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;"><input type="checkbox" name="sub[]" val="4">Social Science</label>
                            </div>
                            <div class="checkbox" style="float:left">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="5">Hindi</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="6">Punjabi</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;margin-left: -7px"><input type="checkbox" name="sub[]" val="7">Comp.</label>
                            </div>
                            <div class="checkbox" style="float:left;margin-left: 10px">
                                <label style="font-size:14px;"><input type="checkbox" name="sub[]" val="8">Phy. Edu.</label>
                            </div>
                        </td>
                        <td><input type="text" id="school_ten" name="lastschool_ten" class="form-control" style="width:250px"></td>
                    </tr>
                    
                </tbody>
            </table>
            
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
					<input type='hidden' name='student_id' value='<?php echo $student_id;?>'>
                    <button type="submit" class="btn btn-primary" style="width:40%" >Update</button>
                    <button type="reset"  class="btn btn-primary" style="width:40%">Reset</button>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
var field_count=0;
            
    $(function(){
    $('#admssndate').datepicker({
                    dateFormat: 'dd-mm-yy',
                    changeYear: true,
                    changeMonth: true,
                    autoclose:true,
                    todayHighlight:true,
                    yearRange:"-15:+0"
                    });        
                }); 
                
          
            $("#dp").click(function(){
               $(document).ready(function(){
                   $('#admssndate').datepicker().focus(); 
               }); 
            });
            
            $('#is_same_adrs').click(function(){
                if(this.checked){
                   $('#p_adrs1').val($('#c_adrs1').val());
                   $('#p_adrs2').val($('#c_adrs2').val());
                   $('#p_city').val($('#c_city').val());
                   $('#p_district').val($('#c_district').val());
                   $('#p_state').val($('#c_state').val());
                   $('#p_postcode').val($('#c_postcode').val());
                }
                else{
                    $('#p_adrs1').val('');
                    $('#p_adrs2').val('');
                    $('#p_city').val('');
                    $('#p_district').val('');
                    $('#p_state').val('');
                    $('#p_postcode').val('');
                }
            });
            
            $('input[type=radio][name=s_handicap]').change(function(){
              if(this.value==0){
                  $('#disability').attr('placeholder',"type of disability");
                  $('#disability').prop('disabled',false);
                  $('#disability').focus();
              }  
              else if(this.value==1){
                  $('#disability').val('');
                  $('#disability').prop('disabled',true);
            }
            });
            
            
            $(".num-only").keypress(function(e){
              if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                 return false;
                }  
            });
            
            $(".dec-only").keypress(function(e){
                if (e.which != 8 && e.which != 0 && (e.which < 46 || e.which > 57)) {
                 return false;
                }
            });
            
            $(".alpha-only").keypress(function(e){
               if (!((e.which==8) ||(e.which==32)||(e.which==46) || (e.which>=35 && e.which<=40)||(e.which >= 97 && e.which <= 122) || (e.which >= 65 && e.which <= 90))) 
               {
                   return false;
               e.preventDefault();
               } 
            });
            
            function append_form(){
                field_count++;
               group = '<div class="form-group" id="sports_'+field_count+'"><div class="col-sm-2"></div><div class="col-sm-2">'+
                   '<select id="sports" class="form-control" name="s_sports" style="margin-left:10px;">'+
                        '<option value="0">Athletics</option>'+
                        '<option value="1">Badminton</option>'+
                        '<option value="2">BasketBall</option>'+
                        '<option value="3">Cricket</option>'+
                        '<option value="4">Football</option>'+
                        '<option value="5">HandBall</option>'+
                        '<option value="6">Hockey</option>'+
                        '<option value="7">Kabaddi</option>'+
                        '<option value="8">Lawn-Tennis</option>'+
                        '<option value="9">Swimming</option>'+
                        '<option value="10">Squash</option>'+
                        '<option value="11">Table-Tennis</option>'+
                        '<option value="12">VolleyBall</option>'+   
                 '</select></div>'+
                   '<label class="col-sm-1 control-label" style="text-align:left;margin-left:5px;">Level(s): </label>'+
                   '<div class="col-sm-5">'+
                    '<div class="radio" style="float:left;margin-left: -30px">'+
                        '<label><input type="radio" name="level'+field_count+'" value="0">Zonal</label>'+
                    '</div>'+
                    '<div class="radio" style="float: left;margin-left: 25px">'+
                        '<label><input type="radio" name="level'+field_count+'" value="1">District</label>'+
                    '</div>'+
                    '<div class="radio" style="float: left;margin-left: 25px">'+
                        '<label><input type="radio" name="level'+field_count+'" value="2">state</label>'+
                    '</div>'+
                    '<div class="radio" style="float: left;margin-left: 25px">'+
                        '<label><input type="radio" name="level'+field_count+'" value="3">National</label>'+
                    '</div>'+
                    '<div class="radio" style="float: left;margin-left: 25px">'+
                        '<label><input type="radio" name="level'+field_count+'" value="4">International</label>'+
                    '</div>'+  
                    '<span class="add-on"><i class="glyphicon glyphicon-plus" title="Add another sport" onclick="append_form(this)"></i></span>'+
                     '<span class="add-on"><i class="glyphicon glyphicon-minus" id="minus_'+field_count+'"title="Remove sport" onclick="remove_form(this.id)"></i></span>'+   
                '</div></div>'
               $('#appendsports').append(group);
            }
            function remove_form(id){
                   var n = id[id.length-1];
                   var div_to_remove = "#sports_"+n;
                   $(div_to_remove).remove();
            }
            </script>
            
          <?php    include 'footer.php'; ?>
</body>
</html>