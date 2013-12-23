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
<script type="text/javascript" src="fade.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<link type="text/css" rel="stylesheet" href="autocomplete.css">
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
			frmobj.action = "content_del.php";
			frmobj.submit();
			}
		else{ 
			return false;
		}
	}
	else if(comb=='Ubpublished'){
		frmobj.action = "content_del.php";
		frmobj.submit();
	}
	else if(comb=='Published'){
		frmobj.action = "content_del.php";
		frmobj.submit();
	}
	
}
</script></head>
<body class="yui-skin-sam">
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Content</td>
                      <td width="24%" align="right"><input type="button" name="Submit" value="Add Content" class="button" onclick="location.href='content_addf.php'"></td>
                    </tr>
              </table>
			</td>
          </tr>
            <tr>
            <td height="21" align="left" class="txt">
           
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr >
                      <td ><form name="search" method="GET" action="" >
                    Search: <input type="text" id="txtsearch" name="txtsearch" value="<?php echo $_REQUEST['txtsearch'];?>" size="20" class="input" /> <input  type="submit" name="search" value="Search"  class="button" />&nbsp;<input type="button"  value="Show All"  onclick="javascript:location.href='reservation_list.php'" class="button" /><div id="container1" style="width:250px;"></div>
                    <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<?php
$query = mysql_query("select distinct menus from tbl_content");
			
			if(mysql_num_rows($query) > 0) {
				$string="";
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['menus']))."\" ";
				}
				
				$string = substr($string,1);
			}
?>
var countries = new Array(<?php echo $string;?>);
var myDataSource = new YAHOO.util.LocalDataSource(countries);
var myAC = new YAHOO.widget.AutoComplete("txtsearch", "container1", myDataSource);
</script>
                    </form></td>
                    </tr>
              </table>
            
			</td>
          </tr>
		  <?php $start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=PAGING_SIZE;
if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='id';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='asc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];
if(isset($_REQUEST['txtsearch']))
{
	$sql=executeQuery("select * from tbl_content where menus like '%".$_REQUEST['txtsearch']."%' order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select * from tbl_content where menus like '%".$_REQUEST['txtsearch']."%' "));
}
else
{
$sql=executeQuery("select * from tbl_content order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select * from tbl_content"));
}
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
                          <td width="4%" align="center">Id</td>
                          <td width="15%" align="center">Menu<?php echo sort_arrows('menus')?></td>
                          <td width="16%" align="center">Generated By<?php echo sort_arrows('generated_by')?></td>
                          <td width="15%" align="center">Created Date<?php echo sort_arrows('create_date')?></td>
					      <td width="6%" align="center">Action</td>
                          <td width="4%" align="center"><input name="check_all" type="checkbox" id="check_all" value="check_all" onclick="checkall(this.form)" />                          </td>
                        </tr>
                        <?php $i=0;
					while($line=mysql_fetch_array($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$i++;?>
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" ><?php echo $i;?></td>
                          <td align="center" class="txt" ><?php echo $line['menus'];?></td>
                          <td align="center" class="txt"><?php echo $line['generated_by']; ?> </td>
                          <td align="center" class="txt" ><?php echo $line['create_date'];?></td>
                          <td valign="middle" class="txt" align="center"><a href="content_addf.php?id=<?php echo $line['id'];?>" class="orangetxt">Edit</a></td>
                          <td valign="middle" align="center"><input type="checkbox" name="ids[]" value="<?php print $line['id']?>" /></td>
                        </tr>
                        <?php }?>
                        <?php $className = ($className == "evenRow")?"oddRow":"evenRow";?>
                        <tr align="right" class="<?php print $className?>">
                          <td colspan="98"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td  align="left"><?php include("../codelibrary/inc/paging.inc.php"); ?>                                </td>
                                <td align="right"><input type="submit" name="Submit" value="Published" class="button" onclick="return del_prompt(this.form,this.value,'content_del.php')" />
                                    <input type="submit" name="Submit" value="Ubpublished" class="button" onclick="return del_prompt(this.form,this.value,'content_del.php')" />
                                      <?php if($_SESSION['sess_type']=='Super Admin'  || $_SESSION['sess_type']=='Admin'){?><input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value,'content_del.php')" /><? }?>
                                    <br />                                </td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="7" class="warning">Sorry, Currently There are no record to display</td>
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