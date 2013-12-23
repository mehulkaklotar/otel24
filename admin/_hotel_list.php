<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
?>
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
		if(confirm ("Are you sure you want to delete Record(s)\n")){
			frmobj.action = "hotel_del.php";
			frmobj.submit();
			}
		else{ 
			return false;
		}
	}
	else if(comb=='Deactivate'){
		frmobj.action = "hotel_del.php";
		frmobj.submit();
	}
	else if(comb=='Activate'){
		frmobj.action = "hotel_del.php";
		frmobj.submit();
	}
	else if(comb=='Remove Editor Pick'){
		frmobj.action = "hotel_del.php";
		frmobj.submit();
	}
	else if(comb=='Editor Pick'){
		frmobj.action = "hotel_del.php";
		frmobj.submit();
	}
	}
</script>
</head>
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Places</td>
                      <td width="24%" align="right"><input type="button" name="Submit" value="Add Place" class="button" onclick="location.href='hotel_addf.php'"></td>
                    </tr>
              </table>
			</td>
          </tr>
		  <?php $start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=15;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='id';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='desc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

if($_SESSION['sess_type']=='Hotel Owners')
$where=" and user_id='".$_SESSION['sess_admin_id']."'";
$sql=executeQuery("select * from tbl_hotel where 1=1 $where order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select * from tbl_hotel  where 1=1 $where "));
?>
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
                         <!-- <td width="5%" align="center"><strong>S.No.</strong></td>-->
                          <td width="13%" align="center">Place<?php echo sort_arrows('hotel_name')?></td>						 
						  <td width="13%" align="center">Place Type<?php echo sort_arrows('place_type')?></td>
                          <td width="13%" align="center">State<?php echo sort_arrows('state')?></td>
						  <td width="16%" align="center">Rate<?php echo sort_arrows('rate')?></td>
						  <td width="8%" align="center">Editor Pick</td>
						  <td width="7%" align="center">Status<?php echo sort_arrows('status')?></td>
						  <td width="11%" align="center">VisitCount<?php echo sort_arrows('visit_count')?></td>
						  <td width="10%" align="center">Action</td>
                          <td width="4%" align="center"><input name="check_all" type="checkbox" id="check_all" value="check_all" onclick="checkall(this.form)" />
                          </td>
                        </tr>
                        <?php $i=0;
					while($line=mysql_fetch_array($sql))
					{
            $className = ($className == "evenRow")?"oddRow":"evenRow";
            $i++;
            //guest message for hotel
            $msgs = mysql_fetch_array(executeQuery("select count(id) from tbl_user_msg_hotel where hotel_id=$line[id]"));
					
					?>
                        <tr class="<?php print $className?>">
                         <!-- <td align="center" class="txt" ><?php //echo $i?></td>-->
                          <td align="center" class="txt"><?php echo $line['hotel_name']."(<a href='guest_msg_list.php?id=".$line[id]."'>".$msgs[0]."</a>)" ?></td>
						  <?php $ss2=mysql_query("select * from city where id='".$line['place_type']."'");
						  		$nn2=mysql_fetch_assoc($ss2);
								?>
						  <td align="center" class="txt" ><?=$nn2['city_English']?></td>
        				  <?php $ss=mysql_query("select * from country where country_id='".$line['state']."'");
						  		$nn=mysql_fetch_assoc($ss);
								?>
						  <td align="center" class="txt" ><?=$nn['country_English']?></td>

						  
						  <td align="center" class="txt" >
						  <?php if($line['rate']==6)
						  {?>
						  	boutique
						  <? }else{?>
						  <?php echo $line['rate']?> Stars
						  <? } ?>
						  </td>
						  <td align="center" class="txt"><?php if($line['editor_pick']==1){?><img src="images/right_sign.gif" /><? }else{?><img src="images/cross_sign.gif" /><? }?></td>
						  <td align="center" class="txt"><?php if($line['status']==1){?>Activated<? }else{?>Deactivated<? }?></td>
						  <td align="center" class="txt"><?=$line[visit_count]?></td>
                          <td valign="middle" class="txt" align="center"><a href="hotel_addf.php?id=<?php print $line[0]?>" class="orangetxt">Edit Eng</a><br /><a href="hotel_addf_tur.php?id=<?php print $line[0]?>" class="orangetxt">Edit Turk</a></td>
                          <td valign="middle" align="center"><input type="checkbox" name="ids[]" value="<?php print $line[0]?>" /></td>
                        </tr>
                        <?php }?>
                        <?php $className = ($className == "evenRow")?"oddRow":"evenRow";?>
                        <tr align="right" class="<?php print $className?>">
                          <td colspan="100%"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
							    <td align="left"><?php include("../codelibrary/inc/paging.inc.php"); ?>
                                </td>
                                <td width="67%" align="right">
								    <input type="submit" name="submit" value="Editor Pick" class="button" onclick="return del_prompt(this.form,this.value,'hotel_del.php')" />
                                    <input type="submit" name="submit" value="Remove Editor Pick" class="button" onclick="return del_prompt(this.form,this.value,'hotel_del.php')" />
								    <input type="submit" name="submit" value="Activate" class="button" onclick="return del_prompt(this.form,this.value,'hotel_del.php')" />
                                    <input type="submit" name="submit" value="Deactivate" class="button" onclick="return del_prompt(this.form,this.value,'hotel_del.php')" />
                                    <?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Hotel Owners'){?><input type="submit" name="submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value,'hotel_del.php')" /><? }?>
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
