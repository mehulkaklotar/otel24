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
		$sql2="delete from tbl_zip where village_id in ($str_rest_refs)"; 
		executeUpdate($sql2);
		$sql="delete from village where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Records has been deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update village set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update village set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
/* elseif($Submit=='ShowatHome')
	{
		 $sql="update city set at_home=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been Show at Home  Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='RemoveFromHome')
	{
		 $sql="update local set at_home=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been Remove From Home Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}*/
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
}
header("Location: village_list.php?country_id=$country_id&state_id=$state_id");
exit();
?>