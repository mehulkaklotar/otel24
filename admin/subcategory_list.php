<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function checkall(objForm)
{
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++){
		if (objForm.elements[i].type=='checkbox') 
			objForm.elements[i].checked=objForm.check_all.checked;
	}
}

function del_prompt(frmobj,comb,id)
{
	if(comb=='Delete'){
		if(confirm ("Are you sure you want to delete Record(s)")){
			frmobj.action = "subcategory_del.php";
			frmobj.submit();
			}
		else{ 
			return false;
		}
	}
	else if(comb=='Deactivate'){
		frmobj.action = "subcategory_del.php";
		frmobj.submit();
	}
	else if(comb=='Activate'){
		frmobj.action = "subcategory_del.php";
		frmobj.submit();
	}
	
}
</script></head>
<body>
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?php include("left_menu.inc.php");?></td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
    <br />
    <br /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr>
                      <td width="25%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Subcategory</td>
                      <td width="75%" align="right"><select name="keycountry" class="txtfld txt" style="width:150px; " onchange="javascript:location.href='subcategory_list.php?cid='+this.value;">
						<option value="">All Category</option>
		<?php 
		$sql_con=mysql_query("SELECT * FROM tbl_category where status=1");
		if(@mysql_num_rows($sql_con)>0){
			while($conline=mysql_fetch_array($sql_con)){
		?>
						<option value="<?php echo $conline['id'];?>"<?php if($_REQUEST['keycountry']==$conline['id']){ echo 'selected';}?>><?php echo $conline['category_English'];?></option>
	<?php } }?>
					
					</select>
					
					<input type="button" name="Submit" value="Back" class="button" onclick="location.href='category_list.php'">&nbsp;&nbsp;		<?php if($cid)
					{?>
					<input type="button" name="Submit" value="Add Subcategory" class="button" onclick="location.href='subcategory_addf.php?cid=<?php echo $_REQUEST['cid'];?>'">
					<? } ?>
					&nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
		  <?php $start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=PAGING_SIZE;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='subcategory_English';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='desc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
$where='';
if($_REQUEST['cid']){
	$where="and cat_id='".$_REQUEST['cid']."'";

}

$sql=executeQuery("select tbl_subcategory.*, tbl_category.category_English from tbl_subcategory inner join tbl_category on(tbl_subcategory.cat_id=tbl_category.id) where 1=1 $where order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select tbl_subcategory.*, tbl_category.category_English from tbl_subcategory inner join tbl_category on(tbl_subcategory.cat_id=tbl_category.id)where 1=1 $where "));?>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></span> <br />
				    <form name="frm_list" method="post" >
				<input type="hidden" name="cid" value="<?php echo $_REQUEST['cid']; ?>" />
				      <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="5%" align="center">S.No.</td>
                          <td width="23%" align="center">Subcategory(English)<?php echo sort_arrows('subcategory_English')?></td>
						  <td width="27%" align="center">Subcategory(Turkish)<?php echo sort_arrows('subcategory_Turkish')?></td>
                          <td width="21%" align="center">Category<?php echo sort_arrows('tbl_subcategory.cat_id')?></td>
                          <td width="14%" align="center">Status<?php echo sort_arrows('tbl_subcategory.status')?></td>
                          <td width="6%" align="center">Action</td>
                          <td width="4%" align="center"><input name="check_all" type="checkbox" id="check_all" value="check_all" onclick="checkall(this.form)" />
                          </td>
                        </tr>
                        <?php $i=0;
					while($line=mysql_fetch_array($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$i++;?>
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" ><?php echo $i; ?></td>
                          <td align="left" class="txt" >&nbsp;<?php echo $line['subcategory_English'];?></td>
						  <td align="left" class="txt" >&nbsp;<?php echo $line['subcategory_Turkish'];?></td>
                          <td align="center" class="txt" >&nbsp;<?php echo $line['category_English'];?></td>
                          <td align="center" class="txt"><?php if($line['status']==1){?>
                            Activated
                              <?php }else{?>
                              Deactivated
                              <?php }?></td>
                          <td valign="middle" class="txt" align="center"><a href="subcategory_addf.php?id=<?php echo $line['id'];?>&cid=<?php echo $line['cat_id'];?>" class="orangetxt">Edit</a></td>
                          <td valign="middle" align="center"><input type="checkbox" name="ids[]" value="<?php print $line['id']?>" /></td>
                        </tr>
                        <?php }?>
                        <?php $className = ($className == "evenRow")?"oddRow":"evenRow";?>
                        <tr align="right" class="<?php print $className?>">
                          <td colspan="101"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td  align="left" class="txt"><?php include("../codelibrary/inc/paging.inc.php"); ?>
                                </td>
                                <td align="right"><input type="submit" name="Submit" value="Activate" class="button" onclick="return del_prompt(this.form,this.value,'subcategory_del.php')" />
                                    <input type="submit" name="Submit" value="Deactivate" class="button" onclick="return del_prompt(this.form,this.value,'subcategory_del.php')" />
                                      <?php if($_SESSION['sess_type']=='Super Admin'){?><input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value,'subcategory_del.php')" /><? }?>
                                    <br />
                                </td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="10" class="warning">Sorry, Currently There are no record to display</td>
                        </tr>
                        <?php }?>
                      </table>
				    </form>
			      </td></tr>
			   <tr align="center">
                 <td>&nbsp;</td>
               </tr>
               <tr align="center">
                 <td>&nbsp;</td>
               </tr>
            </table>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>