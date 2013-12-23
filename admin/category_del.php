<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
$arr =$_POST['ids'];
$Submit =$_POST['Submit'];
if(count($arr)>0){
	$str_rest_refs=implode(",",$arr);
	if($Submit=='Delete')
	{
		
		$sqlcat=mysql_query("select * from tbl_category where id in ($str_rest_refs)");
		if(@mysql_num_rows($sqlcat) >0){
			while($catline=mysql_fetch_array($sqlcat)){
		
		
		$sqlf=mysql_query("select * from tbl_subcategory where cat_id='".$catline['id']."'");
		if(@mysql_num_rows($sqlf) >0){
			while($fline=mysql_fetch_array($sqlf)){
				$sqlc=mysql_query("select * from tbl_company where subcat_id='".$fline['id']."'");
				if(@mysql_num_rows($sqlc) >0){
					while($cline=mysql_fetch_array($sqlc)){

						$sql_un = "select logo,image from tbl_company where id='".$cline['id']."'";
						$sql_res = mysql_query($sql_un);
						while($un_imag = mysql_fetch_array($sql_res)){;
							@unlink("../upload_images/company/".$un_imag['logo']);
							@unlink("../upload_images/company/thumb/".$un_imag['logo']);
							@unlink("../upload_images/coupon/".$un_imag['image']);
							@unlink("../upload_images/coupon/thumb/".$un_imag['image']);
						}	
					
						
					$sql1="delete from  tbl_coupon where company_id='".$cline['id']."'"; 
					executeUpdate($sql1);
					$sql2="delete from tbl_employment where company_id='".$cline['id']."'"; 
					executeUpdate($sql2);
					$sql3="delete from tbl_event where company_id='".$cline['id']."'"; 
					executeUpdate($sql3);
					$sql4="delete from tbl_gift_certificate where company_id='".$cline['id']."'"; 
					executeUpdate($sql4);
					$sqlco="delete from tbl_company_address where company_id='".$cline['id']."'"; 
					executeUpdate($sqlco);
					$sqln="delete from tbl_notes where company_id='".$cline['id']."'"; 
					executeUpdate($sqln);
					$sql="delete from tbl_company where id='".$cline['id']."'"; 
					executeUpdate($sql);
				}
			
			}
		
		}
		
	}else{
	
				$sqlc=mysql_query("select * from tbl_company where cat_id='".$catline['id']."'");
				if(@mysql_num_rows($sqlc) >0){
					while($cline=mysql_fetch_array($sqlc)){

						$sql_un = "select logo,image from tbl_company where id='".$cline['id']."'";
						$sql_res = mysql_query($sql_un);
						while($un_imag = mysql_fetch_array($sql_res)){;
							@unlink("../upload_images/company/".$un_imag['logo']);
							@unlink("../upload_images/company/thumb/".$un_imag['logo']);
							@unlink("../upload_images/coupon/".$un_imag['image']);
							@unlink("../upload_images/coupon/thumb/".$un_imag['image']);
						}	
						
					$sql1="delete from  tbl_coupon where company_id='".$cline['id']."'"; 
					executeUpdate($sql1);
					$sql2="delete from tbl_employment where company_id='".$cline['id']."'"; 
					executeUpdate($sql2);
					$sql3="delete from tbl_event where company_id='".$cline['id']."'"; 
					executeUpdate($sql3);
					$sql4="delete from tbl_gift_certificate where company_id='".$cline['id']."'"; 
					executeUpdate($sql4);
					$sqlco="delete from tbl_company_address where company_id='".$cline['id']."'"; 
					executeUpdate($sqlco);
					$sqln="delete from tbl_notes where company_id='".$cline['id']."'"; 
					executeUpdate($sqln);
					$sql="delete from tbl_company where id='".$cline['id']."'"; 
					executeUpdate($sql);
				}
			
			}
		
	
	}
	}
	}
	
		
		$sql="delete from tbl_category where id in ($str_rest_refs)"; 
		executeUpdate($sql);
		$sess_msg='Selected Records are deleted Successfully';
		$_SESSION['sess_msg']=$sess_msg;
    }
	elseif($Submit=='Activate')
	{
		$sql="update tbl_category set status=1 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records are activated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
	elseif($Submit=='Deactivate')
	{
		$sql="update tbl_category set status=0 where id in ($str_rest_refs)";
		executeUpdate($sql);
		$sess_msg='Selected Records are deactivated Successfully';
		$_SESSION['sess_msg']=$sess_msg;
	}
}
else{
	$sess_msg="Please select Check Box";
	$_SESSION['sess_msg']=$sess_msg;
	}
header("Location: category_list.php");
exit();?>