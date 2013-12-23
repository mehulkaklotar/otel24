<?php 
session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
if($_SESSION['lang_id'])
{
	$lang_id=$_SESSION['lang_id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<script type="text/javascript" src="fade.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<link type="text/css" rel="stylesheet" href="autocomplete.css">
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
			frmobj.action = "village_del.php";
			frmobj.submit();
			}
		else{ 
			return false;
		}
	}
	else if(comb=='Deactivate'){
		frmobj.action = "village_del.php";
		frmobj.submit();
	}
	else if(comb=='Activate'){
		frmobj.action = "village_del.php";
		frmobj.submit();
	}
else if(comb=='ShowatHome'){
	   
		frmobj.action = "village_del.php";
		frmobj.submit();
	}
	else if(comb=='RemoveFromHome'){
		frmobj.action = "village_del.php";
		frmobj.submit();
	}
}
</script>
</head>
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
   <td width="1" bgcolor="#398FA8"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr bgcolor="#EDEDED">
                      <td width="70%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Village</td>
                      <td width="30%" align="right">
					   <select name="keycountry" class="txtfld txt" style="width:150px; " onchange="javascript:location.href='village_list.php?keycountry='+this.value;">
						<option value="">All Country</option>
		<?php 
		$sql_con=mysql_query("SELECT * FROM country where status=1 order by country_English asc ");
		if(@mysql_num_rows($sql_con)>0){
			while($conline=mysql_fetch_array($sql_con)){
		?>
						<option value="<?php echo $conline['country_id'];?>"<?php if($_REQUEST['keycountry']==$conline['country_id']){ echo 'selected';}?>><?php echo $conline['country_English'];?></option>
	<?php } }?>
					
					</select>
					  
					 
					  &nbsp;&nbsp;<input name="b1" type="button" class="button" id="b1" value="Add Village" onClick="location.href='village_addf.php'">
					  
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="21" align="left" class="txt">
           
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr >
                      <td ><form name="search" method="GET" action="" >
                    Search: <input type="text" id="txtsearch" name="txtsearch" value="<?php echo $_REQUEST['txtsearch'];?>" size="20" class="input" /> <input  type="submit" name="search" value="Search"  class="button" />&nbsp;<input type="button"  value="Show All"  onclick="javascript:location.href='village_list.php'" class="button" /><div id="container1" style="width:250px;"></div>
                    <script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<?php
$query = mysql_query("select distinct villagee_English  from village");
			
			if(mysql_num_rows($query) > 0) {
				$string="";
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['village_English']))."\" ";
				}
				
				$string = substr($string,1);
			}
?>
<?php
$query = mysql_query("select distinct village_Turkish from village");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['village_Turkish']))."\" ";
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
		  <?php 
$where='';
if($_REQUEST['keycountry']){
$where=" and country.country_id='".$_REQUEST['keycountry']."'";

}
		  
 if($_REQUEST['country_id'])
 {
  $where=" and country_id='".$_REQUEST['country_id']."'";
 }
 if($_REQUEST['state_id'])
 {
  $where.=" and state_id='".$_REQUEST['state_id']."'";
 }
 if($_REQUEST['city_id'])
 {
  $where.=" and city_id='".$_REQUEST['city_id']."'";
 }
 if($_REQUEST['local_id'])
 {
  $where.=" and local_id='".$_REQUEST['local_id']."'";
 }

$start=0;
if(isset($_GET['start'])) $start=$_GET['start'];
$pagesize=20;

if(isset($_GET['pagesize'])) $pagesize=$_GET['pagesize'];
$order_by='village_English';
if(isset($_GET['order_by'])) $order_by=$_GET['order_by'];
$order_by2='asc';
if(isset($_GET['order_by2'])) $order_by2=$_GET['order_by2'];

if(isset($_REQUEST['txtsearch']))
{
	$sql=mysql_query("select village.*,local.local_English,city.city_English,state.name_English,country.country_English from village,local,city,state,country where village.city_id=city.id and village.state_id=state.id and village.country_id=country.country_id and village.local_id=local.id $where and (village_English like '%".$_REQUEST['txtsearch']."%' or village_Turkish like '%".$_REQUEST['txtsearch']."%') order by $order_by $order_by2 limit $start,$pagesize");
	
	$reccnt=mysql_num_rows(executeQuery("select village.*,local.local_English,city.city_English,state.name_English,country.country_English from village,local,city,state,country where village.city_id=city.id and village.state_id=state.id and village.country_id=country.country_id and village.local_id=local.id $where and (local_English like '%".$_REQUEST['txtsearch']."%' or local_Turkish like '%".$_REQUEST['txtsearch']."%')"));
}
else
{

$sql=mysql_query("select village.*,local.local_English,city.city_English,state.name_English,country.country_English from village,local,city,state,country where village.city_id=city.id and village.state_id=state.id and village.country_id=country.country_id and village.local_id=local.id $where order by $order_by $order_by2 limit $start,$pagesize");



$reccnt=mysql_num_rows(executeQuery("select village.*,local.local_English,city.city_English,state.name_English,country.country_English from village,local,city,state,country where village.city_id=city.id and village.state_id=state.id and village.country_id=country.country_id and village.local_id=local.id $where"));

}
?>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td height="347" align="center" valign="top">
				  <span class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></span>
				  <br />
				  <form name="frm_list" method="post" >
				  <input type="hidden" name="local_id" value="<?=$_REQUEST['local_id']?>" />
				  <table width="98%" border="0" align=center cellpadding="4" cellspacing="1"  class="greyBorder">
				  <?php if($reccnt>0){?>
				  	<tr bgcolor="#4096AF" class="blueBackground">
					<TD width="10%" align="center"><strong class="bigWhite">S.No. </strong></TD>
					  <TD width="21%" align="center"><span class="bigWhite"><strong>village(English)</strong></span><strong> <?php echo sort_arrows('village_English')?></strong></TD>
					  <TD width="21%" align="center"><span class="bigWhite"><strong>village(Turkish)</strong></span><strong> <?php echo sort_arrows('village_Turkish')?></strong></TD>
                      <TD width="21%" align="center"><span class="bigWhite"><strong>Local</strong></span><strong> <?php echo sort_arrows('local_English')?></strong></TD>
                      <TD width="21%" align="center"><span class="bigWhite"><strong>City</strong></span><strong> <?php echo sort_arrows('city_English')?></strong></TD>
					  <TD width="21%" align="center"><span class="bigWhite"><strong>State</strong></span><strong> <?php echo sort_arrows('name_English')?></strong></TD>
                      
					  <TD width="22%" align="center"><span class="bigWhite"><strong>Country<?php echo sort_arrows('country_English')?></strong></span></TD>
					  <TD width="22%" align="center"><span class="bigWhite"><strong>Status</strong></span><strong> <?php echo sort_arrows('status')?></strong></TD>
					  <td width="13%" align="center"><b class="bigWhite">Action</b></td>
					  <td width="12%" align="center" class="heading"> 
					  <input name="check_all" type="checkbox" id="check_all" value="check_all" onClick="checkall(this.form)">
					  </td>
					</tr>
					<?php $i=0;
					while($line=mysql_fetch_array($sql)){
					$className = ($className == "evenRow")?"oddRow":"evenRow";
					$i++;?>
					<tr class="<?php print $className?>">
					<TD align="center" class="txt" ><?php echo $i?></TD> 
					 <TD align="center" class="txt" >
					 <?php echo ucwords($line['village_English']);?>
					 &nbsp;</TD>
					 <TD align="center" class="txt" >
					 <?php echo ucwords($line['village_Turkish']);?>
					 &nbsp;</TD>   
                     <?php 
					 //$ff=mysql_query("select * from state where id='".$line['state_id']."' and status=1");
					 		//$nn=mysql_fetch_assoc($ff);
							$local=$line['local_English'];
							?>
					 <TD align="center" class="txt" ><?php echo $local?></TD>                  
                     <?php 
					 //$ff=mysql_query("select * from state where id='".$line['state_id']."' and status=1");
					 		//$nn=mysql_fetch_assoc($ff);
							$city=$line['city_English'];
							?>
					 <TD align="center" class="txt" ><?php echo $city?></TD>
					 <?php 
					 //$ff=mysql_query("select * from state where id='".$line['state_id']."' and status=1");
					 		//$nn=mysql_fetch_assoc($ff);
							$state=$line['name_English'];
							?>
					 <TD align="center" class="txt" ><?php echo $state?></TD>
					 <?php 
					 //$ff2=mysql_query("select * from country where country_id='".$line['country_id']."'");
					 		//$nn2=mysql_fetch_assoc($ff2);
							$con=$line['country_English'];
							?>
			         <TD align="center" class="txt" ><?php echo $con;?></TD>
			         <TD align="center" class="txt"><?php if($line['status']==1){?>Activated<?php }else{?>Deactivated<?php }?></TD>
					 <td valign="middle" align="center"><a href="village_addf.php?id=<?php print $line['id']?>" class="orangetxt">Edit</a></td>
					  <td width="12%" valign="middle" align="center"><input type="checkbox" name="ids[]" value="<?php print $line['id']?>"></td>
					</tr>
					<?php }?>
					<?php $className = ($className == "evenRow")?"oddRow":"evenRow";?>
					<tr align="right" class="<?php print $className?>"> 
					  <td colspan="7"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
					  
					    <tr>
							<td  align="left" class="txt"><?php include("../codelibrary/inc/paging.inc.php"); ?>
                              </td><td align="right">
<input type="submit" name="Submit" value="Activate" class="button" onclick="return del_prompt(this.form,this.value,'city_del.php')">
							<input type="hidden" name="state_id" value="<?php echo $state_id ?>" />
							<input type="submit" name="Submit" value="Deactivate" class="button" onclick="return del_prompt(this.form,this.value,'city_del.php')">
							  <?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Admin'){?><input type="submit" name="Submit" value="Delete" class="button" onclick="return del_prompt(this.form,this.value,'city_del.php')"><? }?>
							<!--<input type="submit" name="Submit" value="Popular" class="button" onclick="return del_prompt(this.form,this.value,'category_del.php')">
							<input type="submit" name="Submit" value="Remove Popular" class="button" onclick="return del_prompt(this.form,this.value,'category_del.php')"-->
						</td></tr>
                      </table></td>
					</tr>
			     <?php }else{?>
				    <tr align="center" class="oddRow">
					  <td colspan="7" class="warning">Sorry, There are currently no record to display</td>
					</tr>
				 <?php }?>
			     </table>
				 </form>
				 </td>
			   </tr>
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
	<td width="20" valign="top" bgcolor="#EDEDED">&nbsp;</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>