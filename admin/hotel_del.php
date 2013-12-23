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
		$sql_un = mysql_query("select video,image,id from tbl_hotel where id in ($str_rest_refs)");
		$sql_res = @mysql_num_rows($sql_un);
		if($sql_res>0){
			$un_imag = mysql_fetch_array($sql_un);
			@unlink("../upload_image/hotel_video/".$un_imag['video']);
			@unlink("../upload_image/hotel_img/".$un_imag['image']);
			@unlink("../upload_image/hotel_img/thumb/".$un_imag['image']);
		}
		$sql="delete from tbl_hotel where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update tbl_hotel set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update tbl_hotel set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Editor Pick')
	{
		$sql="update tbl_hotel set editor_pick=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Remove Editor Pick')
	{
		$sql="update tbl_hotel set editor_pick=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Record(s) are deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
	}
header("Location: hotel_list.php");
exit();
?>