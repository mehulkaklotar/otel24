<?php
 session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
$arr =$_POST['ids'];
$Submit =$_POST['submit'];
if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
		$sql="delete from tbl_zip where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Records has been deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update tbl_zip set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update tbl_zip set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
}
header("Location: zip_list.php?city_id=$city_id&state_id=$state_id&country_id=$country_id");
exit();
?>