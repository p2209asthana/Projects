<?php

require_once 'b_serverinfo.php';
require_once 'b_password_hash.php';
require_once 'b_session_handler.php';
function getSanitizedInput(){
	global $db;
	global $user_emailid,$user_pwd;
	$user_emailid=@$db->real_escape_string($_POST['user_id']);
	$user_pwd=@$db->real_escape_string($_POST['user_passwd']);
	if(!isset($user_emailid)||empty($user_emailid)||!isset($user_pwd)||empty($user_pwd))
		throw new Exception("Error:Username or Password field left empty");
	return;
}
function validateUser(){
global $db;
global $user_emailid,$user_pwd;

$stmt = $db->stmt_init();
$stmt->prepare("SELECT pwd_hash,user_school_id from users  where user_emailid= ?");
$stmt->bind_param('s', $user_emailid);
if(!$stmt->execute())throw new Exception( $db->error);
$stmt->bind_result($pwd_hash,$user_school_id);$stmt->fetch();
$stmt->close();

$t_hasher = new PasswordHash(8, FALSE);
$check = $t_hasher->CheckPassword($user_pwd, $pwd_hash);
if($check)
{	
	startSession($user_school_id,$user_emailid);//function definded in session_handler.php
	
}
else{
	header("location:login.php");
	}
}



try
{
$db = new mysqli($server,$server_uname,$server_pwd,$dbname);
if(!$db)
throw new Exception( $db->error);
getSanitizedInput();
validateUser();
}
catch (Exception $e) { 
			echo	$e->getMessage();
			$db->close();
		}
?>