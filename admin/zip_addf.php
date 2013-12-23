<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);

if ($_POST['submitForm'] == "yes") {
  	 	if($id)
		$sql="select * from tbl_zip where zipcode_English='$zipcode_English' and id<>$id ";
		else
	 	$sql="select * from tbl_zip where zipcode_English='$zipcode_English' and city_id='$city' and local_id='$local' and village_id='$village' and state_id='$state' and country_id='$country' ";
	    $res=executeQuery($sql);
		if($rows=mysql_num_rows($res))
		{
			 $_SESSION['sess_msg']='This Zipcode is already exist';
		}
		else
		{
			if($id==''){
			$sql = "insert into tbl_zip set zipcode_English='$zipcode_English',zipcode_Turkish='$zipcode_Turkish',village_id='$village',local_id='$local',country_id='$country',state_id='$state',city_id='$city',status=1";
						executeUpdate($sql);
			}else{		
			$sql = "update tbl_zip set zipcode_English='$zipcode_English',zipcode_Turkish='$zipcode_Turkish',city_id='$city',local_id='$local',village_id='$village',state_id='$state',country_id='$country'";
			$sql.=" where id='$id'";
			//echo $sql;
			executeUpdate($sql);
			}
			
			header("Location:zip_list.php");
			exit();
		}	
    
}
if($id){
	$sql="select * from tbl_zip where id='$id'";
	$result=executeQuery($sql);
	$num=mysql_num_rows($result);
	if($line=ms_stripslashes(mysql_fetch_array($result))){
		@extract($line);
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script src="ajax.js"></script>
<script language="javascript">
 function validate(obj)
 {
    if(obj.zipcode_English.value=='')
 {
  alert("Please  Enter Zipcode");
  return false;
 }
 
 else 
 {
   return true;
 }
 }

</script>
<script>
function linkprofile1eng(str)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="state_ajax1.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $state;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult1eng";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult1eng(strIn) {
//alert(strIn);
document.getElementById('state_id').innerHTML=strIn;
}
function linkprofile2eng(str)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="city_ajax1.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $city;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult2eng";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult2eng(strIn) {
//alert(strIn);
document.getElementById('city_id').innerHTML=strIn;
}


function linkprofilelocaleng(str,local)
{  //	alert("nghgh");
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="local_ajax1.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $local;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResultlocaleng";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}

function displaysubResultlocaleng(strIn) {
//alert(strIn);
document.getElementById('local_id').innerHTML=strIn;
}


function linkprofilevillageeng(str,village)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="village_ajax1.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $village;?>";	
	var strURL = url;
	var strResultFunc = "displaysubResultvillageeng";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResultvillageeng(strIn) {
//alert(strIn);
document.getElementById('village_id').innerHTML=strIn;
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
    <td width="1" bgcolor="#398FA8"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr bgcolor="#EDEDED">
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Zip</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Zip Manager" onClick="location.href='zip_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <form action="zip_addf.php" method="post" enctype="multipart/form-data" name="frm" onsubmit="return validate(this)">
			  <input type="hidden" name="submitForm" value="yes">
			  <input type="hidden" name="id" class="txtfld" value="<?php echo $id;?>">
			  
			  <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#398FA8"> 
					<TD height="25" colspan="2" class="bigWhite"><strong><?php if($id==''){?>
				    Add New
				    <?php }else{?>
				    Edit
				    <?php }?> 
				    Zip Details</strong>
				    </TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; session_unregister('sess_msg'); $sess_msg='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<tr class="evenRow">
				  <td class="txt" align="right"><strong> Zipcode(English)</strong></td>
				  <td align="left"><input type="text" name="zipcode_English" size="25" value="<?php echo $zipcode_English;?>" class="txtfld" />
			      <span class="warning"> *</span></td>
				  </tr>
				  <tr class="oddRow">
				  <td class="txt" align="right"><strong> Zipcode(Turkish)</strong></td>
				  <td align="left"><input type="text" name="zipcode_Turkish" size="25" value="<?php echo $zipcode_Turkish;?>" class="txtfld" />
			      <span class="warning"> </span></td>
				  </tr>
                  
                  <tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Country</strong></td>
					<td align="left" ><select name="country" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile1eng(this.value);">
					<option value="">Please Select Country</option>
<?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_con=mysql_query("SELECT * FROM country where status=1");
if(@mysql_num_rows($sql_con)>0){
	while($conline=mysql_fetch_array($sql_con)){
?>
					<option value="<?php echo $conline['country_id'];?>"<?php if($line['country_id']==$conline['country_id']){ echo 'selected';}?>><?php echo $conline['country_English'];?></option>
	<?php } }?>
					
					</select>&nbsp;<span class="warning"></span>
				</tr>
                
                    
                <tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>State</strong></td>
					<td align="left" id="state_id"><select name="state" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile2eng(this.value);">
					<option value="">Please Select State</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_sta=mysql_query("SELECT * FROM state where status=1");
if(@mysql_num_rows($sql_sta)>0){
	while($staline=mysql_fetch_array($sql_sta)){
?>
					<option value="<?php echo $staline['id'];?>"<?php if($line['state_id']==$staline['id']){ echo 'selected';}?>><?php echo $staline['name_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
                
                
                
                
                
                
                
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>City</strong></td>
					<td align="left" id="city_id"><select name="city" class="txtfld txt" style="width:250px; " <?php if($line['local_id'] != "") { ?> onchange="javascript:linkprofilelocaleng(this.value,<?php echo $line['local_id'];?>);" <?php } else { ?> onchange="javascript:linkprofilelocaleng(this.value);" <?php } ?> >
					<option value="">Please Select City</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_city=mysql_query("SELECT * FROM city where status=1");
if(@mysql_num_rows($sql_city)>0){
	while($cityline=mysql_fetch_array($sql_city)){
?>
					<option value="<?php echo $cityline['id'];?>"<?php if($line['city_id']==$cityline['id']){ echo 'selected';}?>><?php echo $cityline['city_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
                <tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Local</strong></td>
					<td align="left" id="local_id"><select name="local" class="txtfld txt" style="width:250px; " <?php if($line['village_id'] != "") { ?> onchange="javascript:linkprofilevillageeng(this.value,<?php echo $line['village_id'];?>);" <?php } else { ?> onchange="javascript:linkprofilevillageeng(this.value);" <?php } ?>>
					<option value="">Please Select local</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_local=mysql_query("SELECT * FROM local where status=1");
if(@mysql_num_rows($sql_local)>0){
	while($localline=mysql_fetch_array($sql_local)){
?>
					<option value="<?php echo $localline['id'];?>"<?php if($line['local_id']==$localline['id']){ echo 'selected';}?>><?php echo $localline['local_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
                <tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Village</strong></td>
					<td align="left" id="village_id"><select name="village" class="txtfld txt" style="width:250px; "  >
					<option value="">Please Select Village</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_village=mysql_query("SELECT * FROM village where status=1");
if(@mysql_num_rows($sql_con)>0){
	while($villageline=mysql_fetch_array($sql_village)){
?>
					<option value="<?php echo $villageline['id'];?>"<?php if($line['village_id']==$villageline['id']){ echo 'selected';}?>><?php echo $villageline['village_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                  
                  
				<!--<tr class="evenRow">
					<td width="35%" align="right" class="txt"><strong>Country</strong></td>
					<td align="left" width="65%">
					  <select name="country_id" class="txtfld txt" style="width:250px; ">
					  <option value="">Please Select</option>
					  <?php $aa=mysql_query("select * from country where status=1");
					  		while($aa1=mysql_fetch_assoc($aa))
							{?>
								<option value="<?=$aa1['country_id']?>" <?php if($country_id==$aa1['country_id']){?>selected<? } ?>><?=$aa1['country_English']?></option>
							<? } ?>
					  </select>
				    </td>
				</tr>
				<tr class="oddRow">
					<td width="35%" align="right" class="txt"><strong>State</strong></td>
					<td align="left" width="65%" id="stateid">
					  <select name="state_id" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select State</option>
							<?php $aa=mysql_query("select * from state where status=1");
					  		while($aa1=mysql_fetch_assoc($aa))
							{?>
								<option value="<?=$aa1['id']?>" <?php if($state_id==$aa1['id']){?>selected<? } ?>><?=$aa1['name_English']?></option>
							<? } ?>
					</select>
				    </td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>City</strong></td>
					<td align="left" id="cityid"><select name="city_id" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select City</option>
							<?php $aa=mysql_query("select * from city where status=1");
					  		while($aa1=mysql_fetch_assoc($aa))
							{?>
								<option value="<?=$aa1['id']?>" <?php if($city_id==$aa1['id']){?>selected<? } ?>><?=$aa1['city_English']?></option>
							<? } ?>
					</select>
				</tr>
                <tr class="oddRow">
					<td width="35%" align="right" class="txt"><strong>Local</strong></td>
					<td align="left" width="65%">
					  <select name="local_id" class="txtfld txt" style="width:250px; ">
					  <option value="">Please Select Local</option>
					  <?php $aa=mysql_query("select * from local where status=1");
					  		while($aa1=mysql_fetch_assoc($aa))
							{?>
								<option value="<?=$aa1['id']?>" <?php if($local_id==$aa1['id']){?>selected<? } ?>><?=$aa1['local_English']?></option>
							<? } ?>
					  </select>
				    </td>
				</tr>
                <tr class="evenRow">
					<td width="35%" align="right" class="txt"><strong>Village</strong></td>
					<td align="left" width="65%">
					  <select name="village_id" class="txtfld txt" style="width:250px; ">
					  <option value="">Please Select Village</option>
					  <?php $aa=mysql_query("select * from village where status=1");
					  		while($aa1=mysql_fetch_assoc($aa))
							{?>
								<option value="<?=$aa1['id']?>" <?php if($village_id==$aa1['id']){?>selected<? } ?>><?=$aa1['village_English']?></option>
							<? } ?>
					  </select>
				    </td>
				</tr>-->
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/> <?php if($id==''){?><input type="reset" name="reset" class="button" value="Reset" /><? }?></TD>
				</TR>
				</table>
			  </form>
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
<script>
<?php if($id){ 


if($line['country']){?>
linkprofile1("<?php echo $line['country'];?>");
<?php } ?>

<?php if($line['state']){?>
linkprofile2("<?php echo $line['state'];?>");
<?php } ?>


<?php  } ?>
</script>