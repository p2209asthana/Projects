<?php 

function getSessionDetails(){
if(!isset($_SESSION['sessionid'])or !isset($_SESSION['user_school_id']) or !isset($_SESSION['user_emailid']))
return false;

$arr=array('sessionid'=>$_SESSION['sessionid'],'user_school_id'=>$_SESSION['user_school_id'],'user_emailid'=>$_SESSION['user_emailid']);
return $arr;
}

function checkSession(){
session_start();
if(!isset($_SESSION['sessionid'])or !isset($_SESSION['user_school_id']) or !isset($_SESSION['user_emailid']))
{header('location:logout.php');exit();}
}
function finishSession(){
session_start();
session_destroy();
header('location: login.php');
exit();
}
function startSession($user_school_id,$user_emailid){
session_start();
	$_SESSION['sessionid']=1;
	$_SESSION['user_school_id']=$user_school_id;
	$_SESSION['user_emailid']=$user_emailid;
	header('location:index.php');
	exit();
}
?>