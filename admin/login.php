<?php
session_start();
require_once("../codelibrary/inc/variables.php");
@extract($_POST);
session_register("sess_msg");
if($logged == "yes"){
	
	$sql = "select * from tbl_user where user_id='$username' and password='$password' and status=1";
	$rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		$rc = mysql_fetch_array($rs);
		session_register("sess_admin_id");
		session_register("sess_username");
		session_register("user_type");
		session_register("email");
		session_register("contact_info");
		
		$_SESSION['sess_admin_id'] = $rc['id'];
		
		setcookie("sess_admin_id", $rc['id'], time()+3600*24);
		setcookie("sess_username", strtoupper($rc['user_id']), time()+3600*24);
		
		setcookie("sess_type", $rc['user_type'], time()+3600*24);
		setcookie("sess_email", ($rc['email']), time()+3600*24);
		
		setcookie("sess_phone", $rc['contact_info'], time()+3600*24);
		
		$_COOKIE['sess_admin_id']=$rc['id'];
		$_COOKIE['sess_username']=strtoupper($rc['user_id']);
		
		$_COOKIE['sess_type']=$rc['user_type'];
		$_COOKIE['sess_email']=strtoupper($rc['email']);
		$_COOKIE['sess_phone']=$rc['contact_info'];
		
	
		$_SESSION['sess_type']=$rc['user_type'];
		$_SESSION['sess_username'] = $rc['user_id'];
		$_SESSION['sess_email'] = $rc['email'];
		$_SESSION['sess_phone'] = $rc['contact_info'];
		$last_id=mysql_insert_id();
		mysql_query("update tbl_user set last_login_date=now(),last_login_ip='".$_SERVER['REMOTE_ADDR']."',total_loged_in=total_loged_in+1");
		header("Location: profile.php?".$_SESSION['sess_type']);
		die();
	}
	$_SESSION['sess_msg'] = 'Invalid Username/Password';
	header("Location: index.php");
}
?>