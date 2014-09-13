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
    
</style>

    <form method="post" action="insert.php" enctype="multipart/form-data" class="form-horizontal" role="form">
        <div class="form-contents">
            <div class="form-group" style="margin-top:70px;">
                <div class="left-panel">
                    <div class="left-content">
                        <label for="regno" class="col-sm-3 control-label">Registration No.<br> (if any)</label>
                        <div class="col-sm-2" style="position:absolute;margin-left: 190px">
                            <input type="text" name="reg_no" id="regno" class="form-control">
                        </div>
                    </div>
                    <div class="left-content">
                        <label class="col-sm-2 control-label" style="margin-left:65px">Entry No.</label>
                        <div class="col-sm-3">
                            <input type="text" name="entry_no" class="form-control">
                        </div>
                        <label class="col-sm-3 control-label" style="margin-left:-18px">Admission Date</label>
                        <div class="col-sm-2" style="width:150px;margin-left: -25px">
                            <div class="input-append date">
                                <input class="span2 form-control"  size="16" type="text" name="date_admssn" id="admssndate" readonly>   
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
                            <div style="background-color: #DCDCD1;height: 140px;padding: 10px"><p style="margin-top: 30px">Upload Passport <br>size photo<br><b>35mm x 45mm</b></div>
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
                <input type="text" name="st_fname" class="form-control alpha-only" id="inputName3" style="position: absolute; float:left;width:33%"placeholder="First Name" required>
                <input type="text" name="st_mname" class="form-control alpha-only"  style="position: absolute;float:left;margin-left: 165px;width:33%;padding: 3px"placeholder="Middle Name (optional)">
                <input type="text" name="st_lname" class="form-control alpha-only"  style="position: absolute;float:left;margin-left: 330px;width:33%"placeholder="Last Name" required>
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
                        ?><option value="<?php echo $i;?>"><?php echo $i++; ?></option>
                        <?php
                        }    
                        ?>
                        
                    </select>
                </div>
                <div class="col-sm-1">
                    <select id="inputdob" name="dob_m" class="form-control " style="width:90px;" required>
                        <option value="">Month</option>
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                </div>
                <div class="col-sm-1">
                    <select id="inputdob" name="dob_y" class="form-control " style="width:80px;margin-left: 18px;" required>
                        <option value="">Year</option>
                        <?php 
                        $i=1990;
                        while($i<=2014){
                        ?><option value="<?php echo $i;?>"><?php echo $i++; ?></option>
                        <?php
                        }    
                        ?>  
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputfName3" class="col-sm-2 control-label">Father's Name</label>
                <div class="col-sm-5">
                <input type="text" name="father_fname" class="form-control alpha-only" id="inputName3" style="position: absolute; float:left;width:33%"placeholder="First Name" required>
                <input type="text" name="father_mname" class="form-control"  style="position: absolute;float:left;margin-left: 165px;width:33%;padding: 3px"placeholder="Middle Name (optional)">
                <input type="text" name="father_lname" class="form-control"  style="position: absolute;float:left;margin-left: 330px;width:33%"placeholder="Last Name" required>
                </div>
                <label for="inputfNo3" class="col-sm-2 control-label" style="position: absolute;text-align: left;margin-left: 30px;">Contact</label>
                <div class="col-sm-2" style="margin-left: 90px">
                    <input type="text" name="father_no" class="form-control num-only" id="inputfNo3" style=" width:80%;float:left;" placeholder="Mobile/Ph no.">
                <input type="email" name="father_mail" class="form-control" id="inputfNo3" style="position: absolute;float:left;margin-left: 140px;" placeholder="Email-id">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputmName3" class="col-sm-2 control-label">Mother's Name</label>
                <div class="col-sm-5">
                <input type="text" name="mother_fname" class="form-control alpha-only" id="inputName3" style="position: absolute; float:left;width:33%"placeholder="First Name" required>
                <input type="text" name="mother_mname" class="form-control"  style="position: absolute;float:left;margin-left: 165px;width:33%;padding: 3px"placeholder="Middle Name (optional)">
                <input type="text" name="mother_lname" class="form-control"  style="position: absolute;float:left;margin-left: 330px;width:33%"placeholder="Last Name" required>
                </div>
                <label for="inputfNo3" class="col-sm-2 control-label" style="position: absolute;text-align: left;margin-left: 30px">Contact</label>
                <div class="col-sm-2" style="margin-left: 90px">
                <input type="text" name="mother_no" class="form-control num-only" id="inputfNo3" style="width:80%;float: left;" placeholder="Mobile/Ph no.">
                <input type="email" name="mother_mail" class="form-control" id="inputfNo3" style="position: absolute;float:left;margin-left: 140px;" placeholder="Email-id">
                </div>
            </div>
            
            <div class="form-group">
                <label for="inputbank" class="col-sm-2 control-label">Bank Acc. no.(if any)</label>
                <div class="col-sm-5">
                    <input type="text" name="bank_accNo" class="form-control" id="inputbank" placeholder="Bank's Account No. (if any)">
                </div>
                <label for="ifsc" class="col-sm-2 control-label" style="text-align: left">IFSC CODE</label>
                <div class="col-sm-2" style="margin-left: -100px;">
                    <input type="text" name="bank_ifsc" class="form-control" id="ifsc" placeholder="Bank's IFSC Code">
                </div>
            </div>
            
            <div class="form-group">
                <label for="bankname" class="col-sm-2 control-label">Name of Bank</label>
                <div class="col-sm-5">
                    <select name="bank_name" class="form-control" id="bankname">
                        <option value="">Select</option>
                        <option value="1">State Bank of India</option>
                        <option value="2">HDFC Bank</option>
                        <option value="3">Punjab National Bank</option>
                        <option value="4">ICICI Bank</option>
                        <option value="5">Yes Bank</option>
                        <option value="6">Bank of India</option>
                        <option value="7">Axis Bank</option>
                        <option value="8">Allahabad Bank</option>
                        <option value="9">Andhra Bank</option>
                        <option value="10">Canara Bank</option>
                        <option value="11">Syndicate Bank</option>
                        <option value="12">Co-operative Bank</option>
                        
                        
                    </select>
                </div>
                <label for="bankbranch" class="col-sm-2 control-label" style="text-align: left;margin-left: 30px">Branch</label>
                <div class="col-sm-2" style="margin-left: -130px">
                    <input type="text" name="bank_branch" class="form-control" id="bankbranch" placeholder="Name of Branch">
                </div>
            </div>
            
            <div class="form-group">
                <label for="adhar" class="col-sm-2 control-label">Student's Adhar (if any)</label>
                <div class="col-sm-5">
                    <input type="text" name="adhar_no" class="form-control" id="adhar" placeholder="student's Aadhaar Card no. (if any)">
                </div>
            </div>
            
            <div class="form-group">
                <label for="height" class="col-sm-2 control-label">Student's height (in mt)</label>
                <div class="col-sm-1">
                    <input type="text" name="s_height" class="form-control dec-only" id="height" required>
                </div>
                <label for="weight" class="col-sm-2 control-label"> Weight (in kgs)</label>
                <div class="col-sm-1">
                    <input type="text" name="s_weight" class="form-control num-only" id="weight" required>
                </div>    
            </div>
            
            <div class="form-group">
                <label for="correspond" class="col-sm-2 control-label">Correspondence Address</label>
                <div class="col-sm-8">
                    <input type="text" name="c_adrs1" class="form-control" id="c_adrs1" style="position: absolute; float:left;width: 45%"placeholder="Address Line 1" required>
                    <input type="text" name="c_adrs2" class="form-control" id="c_adrs2" style="float:left;width: 50%;margin-left: 380px" placeholder="Address Line 2">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <input type="text" name="c_city" class="form-control" id="c_city"  style="position: absolute;float:left;width:20%"placeholder="City/VPO" required>
                    <input type="text" name="c_district" class="form-control" id="c_district" style="position: absolute;float:left;margin-left: 195px;width:20%"placeholder="District" required>
                    <input type="text" name="c_state" class="form-control" id="c_state" style="position: absolute;float:left;margin-left: 380px;width:20%"placeholder="State" required>
                    <input type="text" name="c_postcode" class="form-control num-only" id="c_postcode" maxlength="6" style="float:left;margin-left: 550px;width:20%"placeholder="Postal Code" required >
                    
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
                    <input type="text" name="p_adrs1" class="form-control" id="p_adrs1" style="position: absolute; float:left;width: 45%"placeholder="Address Line 1" required>
                    <input type="text" name="p_adrs2" class="form-control" id="p_adrs2" style="float:left;width: 50%;margin-left: 380px" placeholder="Address Line 2">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <input type="text" name="p_city" class="form-control" id="p_city" style="position: absolute;float:left;width:20%"placeholder="City/VPO" required>
                    <input type="text" name="p_district" class="form-control" id="p_district" style="position: absolute;float:left;margin-left: 195px;width:20%"placeholder="District" required>
                    <input type="text" name="p_state" class="form-control" id="p_state" style="position: absolute;float:left;margin-left: 380px;width:20%"placeholder="State" required>
                    <input type="text" name="p_postcode" class="form-control num-only" id="p_postcode" maxlength="6" style="float:left;margin-left: 550px;width:20%"placeholder="Postal Code" required >
                    
                </div>
            </div>
            
            
            
            <div class="form-group">
                <label for="nation" class="col-sm-2 control-label">Nationality</label>
                <div class="col-sm-2">
                    <select name="s_nation" id="nation"class="form-control" required>
                        <option value="">Select</option>
                        <option value="1">India</option>
                        <option value="2">Other</option>
                    </select>
                </div>
                
                <label for="religion" class="col-sm-2 control-label" style="text-align: left; margin-left: 50px">Religion</label>
                <div class="col-sm-2">
                    <select name="s_religion" class="form-control" style="margin-left: -125px;"id="religion" required>
                        <option value="">Select</option>
                        <option value="1">Hindu</option>
                        <option value="2">Sikh</option>
                        <option value="3">Muslim</option>
                        <option value="4">Christian</option>
                        <option value="5">Jain</option>
                        <option value="6">Parsi</option>
                        <option value="7">Buddhist</option>
                        <option value="8">No Religion</option>
                        <option value="9">Other</option>
                    </select>
                </div>
                
                <label for="caste" class="col-sm-2 control-label" style="text-align: left;margin-left: -100px">Caste</label>
                <div class="col-sm-2">
                    <select name="s_caste"class="form-control" style="margin-left: -140px"id="caste" required>
                        <option value="">Select</option>
                        <option value="1">Agarwal</option>
                        <option value="2">Arora</option>
                        <option value="3">Rajput</option>
                        <option value="4">Khatri</option>
                        <option value="5">Jat</option>
                        <option value="6">Bhatia</option>
                        <option value="7">Other</option>    
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="sex" class="col-sm-2 control-label">Sex</label>
                <div class="col-sm-2">
                    <select name="s_sex" class="form-control">
                        <option>Select</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                        <option value="2">Other</option>
                    </select>
                </div>
                
                <label for="category" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-3">
                    <div class="radio" style="float:left">
                        <label><input type="radio" name="s_category" value="0">General</label>                        
                    </div>    
                    <div class="radio" style="float: left; margin-left: 60px">  
                        <label><input type="radio" name="s_category" value="1">OBC</label>
                    </div>
                    <div class="radio" style="margin-left: 260px">  
                        <label><input type="radio" name="s_category" value="2">SC/ST</label>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="locality" class="col-sm-2 control-label">Locality</label>
                <div class="col-sm-2">
                    <div class="radio" style="float: left">
                        <label><input type="radio" name="s_locality" value="0">Urban</label>
                    </div>
                    <div class="radio" style="margin-left: 100px;">
                        <label><input type="radio" name="s_locality" value="1">Rural</label>
                    </div>
                </div>
                
                <label for="handicap" class="col-sm-2 control-label">Handicapped</label>
                <div class="col-sm-3">
                    <div class="radio" style="float:left">
                        <label><input type="radio" name="s_handicap" value="0">Yes</label>                        
                    </div>    
                    <div class="radio" style="float: left; margin-left:87px">  
                        <label><input type="radio" name="s_handicap" value="1">No</label>
                    </div>
                    <div style="margin-left: 200px;width:130px">  
                    <input type="text" name="s_disablity" id="disability" class="form-control" placeholder="type of disability" disabled>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="lastschool" class="col-sm-2 control-label">Name of last school attended</label>
                <div class="col-sm-5">
                    <input type="text" name="last_school_name" class="form-control" id="lastschool" placeholder="name of last school / institution attended (if any)"> 
                </div>
                <div class="radio" style="float: left; margin-left: 50px">
                    <label><input type="radio" name="last_school_type" value="0">Govt.</label>
                </div>
                <div class="radio" style="float: left; margin-left: 75px">
                    <label><input type="radio" name="last_school_type" value="1">Private</label>
                </div>
            </div>
            
            <div class="form-group">
                <label for="lastschoolmed" class="col-sm-2 control-label">Medium of school last attended</label>
                <div class="col-sm-5">
                    <div class="radio" style="float: left">
                        <label><input type="radio" name="last_school_med" value="1">English</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 35px">
                        <label><input type="radio" name="last_school_med" value="2">Punjabi</label>
                    </div>
                    <div class="radio" style="float: left;margin-left: 45px">
                        <label><input type="radio" name="last_school_med" value="3">Hindi</label>
                    </div>
                    <div class="radio" style="margin-left: 320px">
                        <label><input type="radio" name="last_school_med" value="4">Urdu</label>
                    </div>
                </div>
                <label for="lastclass" class="col-sm-2 control-label"  style="text-align:left;padding-left: 55px">Class</label>
                <div class="col-sm-1" style="margin-left:-90px">
                    <select id="lastclass" name="last_class" class="form-control " style="width:90px;">
                        <option>Select</option>
                        <?php 
                        $i=1;
                        while($i<=11){
                        ?><option value="<?php echo $i;?>"><?php echo $i++; ?></option>
                        <?php
                        }    
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="dist" class="col-sm-2 control-label">Distance of new school from place of residence</label>
                <div class="col-sm-1" style="width:100px">
                    <input type="text" name="dist_from_home"  class="form-control dec-only" id="dist" placeholder="in kms">
                </div>
                <label class="col-sm-2 control-label">Parent's Qualification:</label>
                <label class="col-sm-1 control-label" for="fatherqual" style="text-align: left">Father</label>
                <div class="col-sm-2" style="width:170px;margin-left: -40px">
                    <select id="fatherqual" name="father_qual" class="form-control">
                        <option value="">Select</option>
                        <option value="1">Primary</option>
                        <option value="2">Metric</option>
                        <option value="3">Secondary</option>
                        <option value="4">Diploma</option>
                        <option value="5">Graduate</option>
                        <option value="6">PostGraduate</option>
                    </select>
                </div>
                <label class="col-sm-1 control-label" for="motherqual">Mother</label>
                <div class="col-sm-2" style="width:170px;float: left;margin-left: -10px">
                    <select id="motherqual" name="mother_qual" class="form-control">
                        <option value="">Select</option>
                        <option value="1">Primary</option>
                        <option value="2">Metric</option>
                        <option value="3">Secondary</option>
                        <option value="4">Diploma</option>
                        <option value="5">Graduate</option>
                        <option value="6">PostGraduate</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Parent's Occupation</label>
                <label class="col-sm-1 control-label" for="fatheroccup" style="text-align:left;width: 100px">Father</label>
                <div class="col-sm-2" style="width:190px;margin-left: -40px">
                    <select id="fatheroccup" name="father_occup" class="form-control" >
                        <option value="">Select</option>
                        <option value="1">BusinessMan</option>
                        <option value="2">Doctor</option>
                        <option value="3">Engineer</option>
                        <option value="4">Farmer</option>
                        <option value="5">Govt. Employee</option>
                        <option value="6">Lawyer</option>
                        <option value="7">Shopkeeper</option>
                        <option value="8">Other</option>
                    </select>
                </div>
                <label class="col-sm-1 control-label" for="motheroccup" style="text-align: left;padding-left: 57px;">Mother</label>
                <div class="col-sm-2" style="width:190px;margin-left: 10px">
                    <select id="motheroccup" name="mother_occup" class="form-control">
                        <option value="">Select</option>
                         <option value="9">BusinessWoman</option>
                        <option value="2">Doctor</option>
                        <option value="3">Engineer</option>
                        <option value="4">Farmer</option>
                        <option value="5">Govt. Employee</option>
                        <option value="10">HouseWife</option>
                        <option value="6">Lawyer</option>
                        <option value="7">Shopkeeper</option>
                        <option value="8">Other</option>
                    </select>
                </div>    
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label" for="incomefig">Parent's Annual Income</label>
                <div class="col-sm-2">
                    <input type="text" name="parent_income" id="incomefig" ng-model="incomefigure" maxlength="9" class="form-control num-only" placeholder="in Figures">
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
                    <input type="text" name="co_curri" id="cocurri" class="form-control" placeholder="Co-Curricular Achievements till now (if any)">
                </div>
            </div>
           <!--  
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
     -->
            
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary" style="width:40%">Submit</button>
                    <button type="reset"  class="btn btn-primary" style="width:40%">Reset</button>
                </div>
            </div>
        </div>
    </form>

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
                
            
            var myDate = new Date();
            var admssndate =(myDate.getDate()) + '-' + myDate.getMonth()+1 + '-' +
                            myDate.getFullYear();
            $("#admssndate").val(admssndate); 
            
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
            
        
            