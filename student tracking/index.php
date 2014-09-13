<?php
include 'header.php';
require_once 'session_handler.php';
checkSession();

?>

<style>
    .menu-bar{
        padding-top: 75px;
        margin-left: 35%;
    }
</style>



<body>    
    <div class="banner">
        <div class="banner-content">
            <h1>Student Tracking System</h1>
        </div>
        
    </div>
    
    <div class="user-name" style="float:left">
        <h5 style="position:absolute;margin-top: 85px;margin-left: 30px"> Signed in as <?php echo @$_REQUEST['user_emailid'];?></h5> 
    </div>

    <div class="menu-bar" style="float:left">
        <ul class="nav nav-tabs" id="tabs">
            <li class="active"><a href="#addNewStudent" data-toggle="tab">Add new student</a></li>
            <li><a href="#searchRecord" data-toggle="tab">Search Record</a></li>
            <li><a href="#updateResult" data-toggle="tab">Update Result</a></li>
            <li><a href="#runReports" data-toggle="tab">Run Reports</a></li>
            <li><a href="#Notifications" data-toggle="tab">Notifications</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" id="tabdrop" href="#">Settings <b class="caret"></b></a>
                <ul class="dropdown-menu" aria-labelledby="tabdrop">
                    <li><a href="#" data-toggle="tab">Change email</a></li>
                    <li><a href="#" data-toggle="tab">Change password</a></li>
                </ul>
            </li>
            <li><a href="logout.php" data-toggle="tabs">Log Out</a></li>
        </ul>
    </div>   
    <div class="container">
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade active in" id="addNewStudent">
                <?php include 'add_new_student.php';?>
            </div>
        
            <div class="tab-pane fade" id="updateResult">
                <?php include 'updateResult.php';?>
            </div>    

            <div class="tab-pane fade" id="searchRecord">
                <?php include 'search_student.php';?>
            </div>
        
            <div class="tab-pane fade" id="runReports">
                <?php include 'run_reports.php';?>
            </div>
        </div>
    </div>
    
    <?php    include 'footer.php'; ?>
</body>

</html>
