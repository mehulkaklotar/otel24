<?php
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
		
		$sql="delete from tbl_guest where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update tbl_guest set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update tbl_guest set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	///////////update hotel
	$sqlHTL=mysql_query("select * from tbl_hotel");
	while($line=mysql_fetch_array($sqlHTL)){
		///////////////
		//Update hotel
		 $guestTotal = 0;
		  
		  $sql = "SELECT id FROM tbl_guest WHERE hotel='".$line['id']."'";
		  $res = executeQuery($sql);
		  $guestTotal = mysql_num_rows($res);
		   mysql_query("update tbl_hotel set guest='".$guestTotal."' where id='".$line['id']."'");
		/////////////
	}
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
	}
header("Location: guest_list.php");
exit();
?>