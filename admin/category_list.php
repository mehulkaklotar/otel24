<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
			frmobj.action = "category_del.php";
			frmobj.submit();
			}
		else{ 
			return false;
		}
	}
	else if(comb=='Deactivate'){
		frmobj.action = "category_del.php";
		frmobj.submit();
	}
	else if(comb=='Activate'){
		frmobj.action = "category_del.php";
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Category</td>
                      <td width="24%" align="right"><input type="button" name="Submit" value="Add Category" class="button" onclick="location.href='category_addf.php'"></td>
                    </tr>
              </table>
			</td>
          </tr>
		  <?php $start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=PAGING_SIZE;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='category_English';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='asc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
$sql=executeQuery("select * from tbl_category order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select * from tbl_category"));?>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></span> <br />
				    <form name="frm_list" method="post" >
				      <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="7%" align="center">S.No.</td>
                          <td width="36%" align="left">&nbsp;Category(English)<?php echo sort_arrows('category_English')?></td>
						  <td width="36%" align="left">&nbsp;Category(Turkish)<?php echo sort_arrows('category_Turkish')?></td>
                          <td width="18%" align="center">Subcategory</td>
                          <td width="18%" align="center">Status<?php echo sort_arrows('status')?></td>
                          <td width="11%" align="center">Action</td>
                          <td width="10%" align="center"><input name="check_all" type="checkbox" id="check_all" value="check_all" onclick="checkall(this.form)" />
                          </td>
                        </tr>
                        <?php $i=0;
					while($line=mysql_fetch_array($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$i++;?>
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" ><?php echo $i; ?></td>
                          <td align="left" class="txt" >&nbsp;<?php echo $line['category_English'];?></td>
						  <td align="left" class="txt" >&nbsp;<?php echo $line['category_Turkish'];?></td>
                          <td align="center" class="txt"><a href="subcategory_list.php?cid=<?php echo $line['id']; ?>" class="orangetxt">View</a></td>
                          <td align="center" class="txt"><?php if($line['status']==1){?>
                            Activated
                              <?php }else{?>
                              Deactivated
                              <?php }?></td>
                          <td valign="middle" class="txt" align="center"><a href="category_addf.php?id=<?php echo $line['id'];?>" class="orangetxt">Edit</a></td>
                          <td valign="middle" align="center"><input type="checkbox" name="ids[]" value="<?php print $line['id']?>" /></td>
                        </tr>
                        <?php }?>
                        <?php $className = ($className == "evenRow")?"oddRow":"evenRow";?>
                        <tr align="right" class="<?php print $className?>">
                          <td colspan="101"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td  align="left" class="txt"><?php include("../codelibrary/inc/paging.inc.php"); ?>
                                </td>
                                <td align="right"><input type="submit" name="Submit" value="Activate" class="button" onclick="return del_prompt(this.form,this.value,'category_del.php')" />
                                    <input type="submit" name="Submit" value="Deactivate" class="button" onclick="return del_prompt(this.form,this.value,'category_del.php')" />
                                      <?php if($_SESSION['sess_type']=='Super Admin'){?><input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value,'category_del.php')" /><? }?>
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