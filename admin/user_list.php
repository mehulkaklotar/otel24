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
			frmobj.action = "user_del.php";
			frmobj.submit();
			}
		else{ 
			return false;
		}
	}
	else if(comb=='Deactivate'){
		frmobj.action = "user_del.php";
		frmobj.submit();
	}
	else if(comb=='Activate'){
		frmobj.action = "user_del.php";
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Kullanıcı Yönetimi</td>
                      <td width="24%" align="right"><input type="button" name="Submit" value="Kullanıcı Ekle" class="button" onclick="location.href='user_addf.php'"></td>
                    </tr>
              </table>
			</td>
          </tr>
          
          <tr>
            <td height="21" align="left" class="txt">
           
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr >
                      <td ><form name="search" method="GET" action="" >
                    Akıllı Arama : 
                        <input type="text" id="txtsearch" name="txtsearch" value="<?php echo $_REQUEST['txtsearch'];?>" size="20" class="input" /> <input  type="submit" name="search" value="Ara"  class="button" />&nbsp;<input type="button"  value="Hepsini Göster"  onclick="javascript:location.href='user_list.php'" class="button" /><div id="container1" style="width:250px;"></div>
                    <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<?php
$query = mysql_query("select distinct user_id  from tbl_user");
			
			if(mysql_num_rows($query) > 0) {
				$string="";
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",addslashes($get['user_id'])))."\" ";
				}
				
				$string = substr($string,1);
			}
?>
<?php
$query = mysql_query("select distinct full_name  from tbl_user");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['full_name']))."\" ";
				}
				

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
$sql=executeQuery("select * from tbl_user where 1=1 $where and (user_id like '%".$_REQUEST['txtsearch']."%' or full_name like '%".$_REQUEST['txtsearch']."%') order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select * from tbl_user where 1=1 $where and (user_id like '%".$_REQUEST['txtsearch']."%' or full_name like '%".$_REQUEST['txtsearch']."%')"));


}
else
{
$sql=executeQuery("select * from tbl_user where 1=1 $where  order by $order_by $order_by2 limit $start, $pagesize");
$reccnt=mysql_num_rows(executeQuery("select * from tbl_user where 1=1 $where "));
}
?>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td height="347" align="center" valign="top">
				 		<br />
				  <span class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></span> <br />
				    <form name="frm_list" method="post" >
				      <table width="98%" border="0" align=center cellpadding="4" cellspacing="1" class="greyBorder">
                        <?php if($reccnt>0){?>
                        <tr class="blueBackground">
                          <td width="13%" align="center">Tesis Adı</td>
                          <td width="12%" align="center">Kullanıcı ID <?php echo sort_arrows('user_id')?></td>
                          <td width="18%" align="center">Adı Soyadı <?php echo sort_arrows('full_name')?></td>
                          <td width="16%" align="center">e-Posta <?php echo sort_arrows('email')?></td>
						   <td width="12%" align="center">Kullanıcı Tipi <?php echo sort_arrows('user_type')?></td>
                          <td width="15%" align="center">Statü <?php echo sort_arrows('status')?></td>
                          <td width="10%" align="center">İşlemler</td>
                          <td width="4%" align="center"><input name="check_all" type="checkbox" id="check_all" value="check_all" onclick="checkall(this.form)" />
                          </td>
                        </tr>
                        <?php $i=0;
					$sestype=$_SESSION['sess_type'];
					if($sestype == "Super Admin")
					{
						$count = 4;
					}
					if($sestype == "Admin")
					{
						$count = 3;
					}
					if($sestype == "Editors")
					{
						$count = 2;
					}
					if($sestype == "Hotel Owners")
					{
						$count = 2;
					}
					
					while($line=mysql_fetch_array($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$i++;
					if($line['user_type'] == "Super Admin")
					{
						$count1 = 4;
					}
					if($line['user_type'] == "Admin")
					{
						$count1 = 3;
					}
					if($line['user_type'] == "Editors")
					{
						$count1 = 2;
					}
					if($line['user_type'] == "Hotel Owners")
					{
						$count1 = 2;
					}
					
					if($count1 <= $count)
					{
					?>
                        <tr class="<?php print $className?>">
                          <td align="center" class="txt" >
						  	<?php
								$selhname = "select hotel_name from tbl_hotel where user_id=$line[id]";
								$reshname = mysql_query($selhname) or die(mysql_error());
								if(mysql_num_rows($reshname) > 0 )
								{
									$rowhname = mysql_fetch_object($reshname);
									echo $rowhname->hotel_name;
								}
							?>
                          </td>
                          <td align="center" class="txt"><?php echo $line['user_id']; ?> </td>
                          <td align="center" class="txt" ><?php echo $line['full_name'];?></td>
                          <td align="center" class="txt"><a href="mailto:<?php echo $line['email']; ?>" class="orangetxt"><?php echo $line['email']; ?></a> </td>
                            <td align="center" class="txt"><?php echo ucwords($line['user_type']); ?> </td>
						  <td align="center" class="txt"><?php if($line['status']==1){?>
                            Activated
                              <?php }else{?>
                              Deactivated
                              <?php }?></td>
                          <td valign="middle" class="txt" align="center"><a href="user_addf.php?id=<?php echo $line['id'];?>" class="orangetxt">Düzenle</a></td>
                          <td valign="middle" align="center"><input type="checkbox" name="ids[]" value="<?php print $line['id']?>" /></td>
                        </tr>
                    <?php
					}
					?>    
                        <?php }?>
                        <?php $className = ($className == "evenRow")?"oddRow":"evenRow";?>
                        <tr align="right" class="<?php print $className?>">
                          <td colspan="101"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td  align="left"><?php include("../codelibrary/inc/paging.inc.php"); ?>
                                </td>
                                <td align="right"><input type="submit" name="Submit" value="aktif" class="button" onclick="return del_prompt(this.form,this.value,'user_del.php')" />
                                 <input type="submit" name="Submit" value="Pasif" class="button" onclick="return del_prompt(this.form,this.value,'user_del.php')" />
                                   <?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Admin'){?> <input type="submit" name="Submit" value="Sil" class="button" onclick="return del_prompt(this.form,this.value,'user_del.php')" /><? }?>
                                    <br />
                                </td>
                              </tr>
                          </table></td>
                        </tr>
                        <?php }else{?>
                        <tr align="center" class="oddRow">
                          <td colspan="10" class="warning">Üzgünüz, ilgili içerik bulunamadı.</td>
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