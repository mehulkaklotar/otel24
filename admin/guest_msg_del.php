<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
$arr =$_POST['ids'];
$Submit =$_POST['submit'];
if(count($arr)>0)
{
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
		
		$sql="delete from tbl_user_msg_hotel where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
   }
}
else
{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
}
echo "<script>history.back()</script>";
exit();
?>