<?php
 session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
$arr =$_POST['ids'];
$Submit =$_POST['Submit'];
if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
		$sql2="delete from tbl_zip where state_id in ($str_rest_refs)"; 
		executeUpdate($sql2);
		$sql3="delete from city where state_id in ($str_rest_refs)"; 
		executeUpdate($sql3);
		$sql="delete from state where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Records has been deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update state set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update state set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	/*elseif($Submit=='Popular')
	{
		$sql="update tbl_category set popular=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been popular Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Remove Popular')
	{
		$sql="update tbl_category set popular=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been removed from popular Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}*/
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
}
header("Location: state_list.php?country_id=$country_id");
exit();
?>