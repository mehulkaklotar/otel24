<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
include("FCKeditor/fckeditor.php");
validate_admin();
extract($_REQUEST);

if ($_POST['submitForm'] == "yes")
 {    
	if($id){
				$email_dup_query=executeQuery("select id from tbl_hotel where id!=$id and hotel_name_Turkish='$hotel_name_Turkish'");
			 }else{
				$email_dup_query=executeQuery("select id from tbl_hotel where hotel_name_Turkish='$hotel_name_Turkish'");
			 }
			if(mysql_num_rows($email_dup_query)>0){
				 $_SESSION['sess_msg']='This Hotel already exist';
			 }else{
				 
				  
					 $sql = "update tbl_hotel set hotel_name_Turkish='$hotel_name_Turkish',description_Turkish='$description_Turkish',activities_Turkish='$activities_Turkish',services_Turkish='$services_Turkish',generals_Turkish='$generals_Turkish',rooms_Turkish='$rooms_Turkish',prices_Turkish='$prices_Turkish',historical_Turkish='$historical_Turkish',entertainment_Turkish='$entertainment_Turkish',contact_Turkish='$contact_Turkish',contact_hotel_Turkish='$contact_hotel_Turkish',address_Turkish='$address_Turkish'";
					 
					 $sql.=" where id='$id'";
					 executeUpdate($sql);
					
					  $_SESSION['sess_msg']='Hotel added successfully!';
				   
			 header("Location: hotel_list.php");
			 exit();
	}
  }
  
if($id){

	$result=executeQuery("select * from tbl_hotel where id='$id'");
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
<script type="text/javascript" src="FCKeditor/fckeditor.js"></script>
<script src="ajax.js"></script>

<script>
function valid_form(obj)
{
	if(obj.hotel_name_Turkish.value =='')
	{
		alert("Please Enter Hotel name Turkish!");
		obj.hotel_name.focus();
		return false;
	}
	else
	{
		return true;
	}
}
</script>

<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />

</script>
</head>
<body >
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Hotel</td>
                      <td width="24%" align="right"><input name="b1" type="button" class="button" id="b1" value="Manage Hotel" onClick="location.href='hotel_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
                <form action="hotel_addf_tur.php" method="post" enctype="multipart/form-data"  name="userfrm" onsubmit="return valid_form(this)" >
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" value="<?php echo $id;?>">
				<input type="hidden" name="time_id" value="<?=time()?>" id="time_id">
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Add New<?php }?> Hotel Details</TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel Name(Turkish)</strong></td>
					<td align="left" ><input type="text" name="hotel_name_Turkish" class="txtfld txt" style="width:250px; " value="<?php echo $hotel_name_Turkish;?>"/>&nbsp;<span class="warning">*</span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Category(Turkish)</strong></td>
					<?php $aa=mysql_query("select * from tbl_category where id='$category'");
						  $aa_data=mysql_fetch_assoc($aa);
						  ?>
					<td align="left" class="txt" ><?=$aa_data['category_Turkish']?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Subcategory(Turkish)</strong></td>
					<?php $bb=mysql_query("select * from tbl_subcategory where id='$subcategory'");
						  $bb_data=mysql_fetch_assoc($bb);
						  ?>
					<td align="left" class="txt"><?=$bb_data['subcategory_Turkish']?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Rate</strong></td>
					<td align="left" class="txt" ><?php if($rate!=6){?><?=$rate?> Star<? } else {?>boutique<? } ?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Description(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('description_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $description_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Hotel Facilities</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Activities(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('activities_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $activities_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Services(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('services_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $services_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>General(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('generals_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $generals_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Hotel Information</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Rooms(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('rooms_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $rooms_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Prices(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('prices_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $prices_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Arround The Hotel</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Historical(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('historical_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $historical_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Entertainment(Turkish)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('entertainment_Turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = $entertainment_Turkish;
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Contact Information</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Contact(Turkish)</strong></td>
					<td align="left" ><input type="text" name="contact_Turkish" class="txtfld txt" style="width:250px; " value="<?php echo $contact_Turkish;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel Name(Turkish)</strong></td>
					<td align="left" ><input type="text" name="contact_hotel_Turkish" class="txtfld txt" style="width:250px; " value="<?php echo $contact_hotel_Turkish;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Adress(Turkish)</strong></td>
					<td align="left" ><textarea  name="address_Turkish" class="txtfld txt" style="width:250px; height:40px; "><?php echo $address_Turkish;?></textarea>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Country(Turkish)</strong></td>
					<?php $cc=mysql_query("select * from country where country_id='$country'");
						  $cc_data=mysql_fetch_assoc($cc);
						  ?>
					<td align="left" class="txt" ><?=$cc_data['country_Turkish']?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>State(Turkish)</strong></td>
					<?php $dd=mysql_query("select * from state where id='$state'");
						  $dd_data=mysql_fetch_assoc($dd);
						  ?>
					<td align="left" class="txt"><?=$dd_data['state_Turkish']?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>City(Turkish)</strong></td>
					<?php $ee=mysql_query("select * from city where id='$city'");
						  $ee_data=mysql_fetch_assoc($ee);
						  ?>
					<td align="left" class="txt"><?=$ee_data['city_Turkish']?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Zipcode(Turkish)</strong></td>
					<?php $ff=mysql_query("select * from tbl_zip where id='$zipcode'");
						  $ff_data=mysql_fetch_assoc($ff);
						  ?>
					<td align="left" class="txt"><?=$ff_data['zipcode_Turkish']?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Gpoint</strong></td>
					<td align="left" class="txt"><?=$gpoint?></td>
					
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Phone</strong></td>
					<td align="left" class="txt" ><?=$phone?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Fax</strong></td>
					<td align="left" class="txt" ><?=$fax?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Email</strong></td>
					<td align="left" class="txt" ><?=$email?></td>
				</tr>
				<?php if($id)
				{?>
				<!--<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Map</strong></td>
					<td align="left" ><script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=true&amp;key=ABQIAAAA43gfdLcXCyTwHuUObA8j6hR1q7hSUfAw7BauPx6TZKpjHtzUXBTYebRoAeLfj7oy2haAGOjWEts6xQ" type="text/javascript"></script>

	<div align="center" id="map" style="width: 400px; height: 300px"></div>
    <script type="text/javascript">

    //<![CDATA[
    var map = new GMap(document.getElementById("map"));
    map.centerAndZoom(new GPoint(0,0), <?=$line['gpoint']?>);
    //]]>
    </script>
</tr>-->
				<? } ?>
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit" />&nbsp;<input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				
                </table>
			  </form>
				</td>
       </tr>
	   				<TR>
					<TD align=center colspan=100%>&nbsp;</TD>
				</TR>

     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
<script>
<?php if($id){ 
 if($line['category']){?>
linkprofile("<?php echo $line['category'];?>");
<?php } ?>

<?php if($line['country']){?>
linkprofile1("<?php echo $line['country'];?>");
<?php } ?>

<?php if($line['state']){?>
linkprofile2("<?php echo $line['state'];?>");
<?php } ?>

<?php if($line['city']){?>
linkprofile3("<?php echo $line['city'];?>");

<?php } } ?>
</script>
