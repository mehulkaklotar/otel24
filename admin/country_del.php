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
		$sql2="delete from tbl_zip where country_id in ($str_rest_refs)"; 
		executeUpdate($sql2);
		$sql3="delete from city where country_id in ($str_rest_refs)"; 
		executeUpdate($sql3);
		$sql4="delete from state where country_id in ($str_rest_refs)"; 
		executeUpdate($sql4);
		$sql="delete from country where country_id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Records has been deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update country set status=1 where country_id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update country set status=0 where country_id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records has been deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
}
header("Location: country_list.php");
exit();
?>