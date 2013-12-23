<?php
 session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
$arr =$_POST['ids'];
$Submit =$_POST['Submit'];
if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
		$sql="delete from tbl_content where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Records has been deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Published')
	{
		$sql="update tbl_content set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Ubpublished')
	{
		$sql="update tbl_content set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
}
header("Location: content_list.php");
exit();
?>