<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
include("FCKeditor/fckeditor.php");
validate_admin();
extract($_REQUEST);
if($del_img)
{

	mysql_query("delete from tbl_hotel_image where id='$del_img'");
}
if($del_vdi)
{

	mysql_query("delete from tbl_hotel_video where id='$del_vdi'");
	mysql_query("delete from tbl_hotel_video_thumb where video_id='$del_vdi'");
}
if ($_POST['submitForm'] == "yes")
 {    
	if($id){
				$email_dup_query=executeQuery("select id from tbl_hotel where id!=$id and hotel_name='$hotel_name'");
			 }else{
				$email_dup_query=executeQuery("select id from tbl_hotel where hotel_name='$hotel_name'");
			 }
			if(mysql_num_rows($email_dup_query)>0){
				 $_SESSION['sess_msg']='This Hotel already exist';
			 }else{
				if($id=='')
				   {
					 executeQuery("insert into tbl_hotel set hotel_name='$hotel_name',category='$category',subcategory='$subcategory',rate='$rate',description='".addslashes($description)."',activities='".addslashes($activities)."',services='".addslashes($services)."',generals='".addslashes($generals)."',rooms='".addslashes($rooms)."',prices='".addslashes($prices)."',historical='".addslashes($historical)."',entertainment='".addslashes($entertainment)."',contact='$contact',contact_hotel='$contact_hotel',address='".addslashes($address)."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."'");
					 $hotel_id=mysql_insert_id();
					// echo "update tbl_hotel_image set hotel_id='$hotel_id' where hotel_id='$time_id'";
					 mysql_query("update tbl_hotel_image set hotel_id='$hotel_id' where hotel_id='$time_id'");
					 mysql_query("update tbl_hotel_video set hotel_id='$hotel_id' where hotel_id='$time_id'");
					
					 $sql = "SELECT * FROM tbl_hotel_image WHERE hotel_id='$hotel_id'";
					 $res = executeQuery($sql);
					 $imgTotal = mysql_num_rows($res);

					  $sql = "SELECT * FROM tbl_hotel_video WHERE hotel_id='$id'";
					  $res = executeQuery($sql);
					  $videoTotal = mysql_num_rows($res);
					
					 mysql_query("update tbl_hotel set image='$imgTotal',video='$videoTotal' where hotel_id='$hotel_id' ");


					 // $_SESSION['sess_msg']='Hotel added successfully!';
					   header("Location: hotel_addf_tur.php?id=$hotel_id");
						 exit();
				   }	
				 else
				   {  

					 mysql_query("update tbl_hotel_image set hotel_id='$id' where hotel_id='$time_id'");
					 mysql_query("update tbl_hotel_video set hotel_id='$id' where hotel_id='$time_id'");
				  
					  $sql = "SELECT * FROM tbl_hotel_image WHERE hotel_id='$id'";
					 $res = executeQuery($sql);
					 $imgTotal = mysql_num_rows($res);

					 $sql = "SELECT * FROM tbl_hotel_video WHERE hotel_id='$id'";
					 $res = executeQuery($sql);
					 $videoTotal = mysql_num_rows($res);

					 $sql = "update tbl_hotel set hotel_name='$hotel_name',category='$category',subcategory='$subcategory',rate='$rate',description='".addslashes($description)."',activities='".addslashes($activities)."',services='".addslashes($services)."',generals='".addslashes($generals)."',rooms='".addslashes($rooms)."',prices='".addslashes($prices)."',historical='".addslashes($historical)."',entertainment='".addslashes($entertainment)."',contact='$contact',contact_hotel='$contact_hotel',address='$address',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',user_id='".$user_id."',image='$imgTotal',video=' $videoTotal' ";
					 
					 $sql.=" where id='$id'";
					 executeUpdate($sql);
					 
					  $_SESSION['sess_msg']='Hotel updated successfully!';
					   header("Location: hotel_list.php");
			 			exit();
				   }
			
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
function linkprofile(str)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="subcat_ajax.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $subcategory;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult(strIn) {
//alert(strIn);
document.getElementById('subcat').innerHTML=strIn;
}
function linkprofile1(str)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="state_ajax.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $state;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult1";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult1(strIn) {
//alert(strIn);
document.getElementById('stateid').innerHTML=strIn;
}
function linkprofile2(str)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="city_ajax.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $city;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult2";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult2(strIn) {
//alert(strIn);
document.getElementById('cityid').innerHTML=strIn;
}

function linkprofile3(str)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="zip_ajax.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $zipcode;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult3";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult3(strIn) {
//alert(strIn);
document.getElementById('zipid').innerHTML=strIn;
}
</script>
<script>
function validEmailAddress(email)
{
		invalidChars = " /:,;~"
		if (email == "") 
		{
			return (false);
		}
		for (i=0; i<invalidChars.length; i++) 
		{
			badChar = invalidChars.charAt(i)
			if (email.indexOf(badChar,0) != -1) 
			{
				return (false);
			}
		}
		atPos = email.indexOf("@",1)
		if (atPos == -1) 
		{
			return (false);
		}
		if (email.indexOf("@",atPos+1) != -1) 
		{
			return (false);
		}
		periodPos = email.indexOf(".",atPos)
		if (periodPos == -1) 
		{
			return (false);
		}
		if (periodPos+3 > email.length)	
		{
			return (false);
		}
			
		return (true);
}

function valid_form(obj)
{
	if(obj.hotel_name.value =='')
	{
		alert("Please Enter Hotel name!");
		obj.hotel_name.focus();
		return false;
	}
	else if(obj.email.value!='')
	{
		 if(!validEmailAddress(obj.email.value))
		{
			alert("Please Enter Valid E-mail Address!");
			obj.email.focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}
</script>

<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../uploadify/uploadify.css" type="text/css" />

<link rel="stylesheet" href="../uploadify/uploadify.jGrowl.css" type="text/css" />
<script type="text/javascript" src="../js/func.js"></script>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.uploadify.js"></script>
<script type="text/javascript" src="../js/jquery.jgrowl_minimized.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#fileUploadname3").fileUpload({
		'uploader': '../uploadify/uploader.swf',
		'cancelImg': '../uploadify/cancel.png',
		'script': '../uploadify/upload_name.php',
		'folder': '../upload_image/hotel_img',
		'multi': true,
		'displayData': 'percentage',
		'fileDesc': 'Image Files',
		'fileExt': '*.jpg;*.jpeg;*.png;*.gif',
		'sizeLimit': 51200,'scriptData':  {'time_id':'<?=time()?>'},
		onSelect:function()
		{
			
			document.getElementById('show').style.display='';
		}, 
		onError: function (event, queueID ,fileObj, errorObj) {
			var msg;
			if (errorObj.status == 404) {
				alert('Could not find upload script.');
				msg = 'Could not find upload script.';
			} else if (errorObj.type === "HTTP")
				msg = errorObj.type+": "+errorObj.status;
			else if (errorObj.type ==="File Size")
				msg = fileObj.name+'<br>'+errorObj.type+' larger than: '+Math.round(errorObj.sizeLimit/1024)+'KB';
			else
				msg = errorObj.type+": "+errorObj.text;
			$.jGrowl('<p></p>'+msg, {
				theme: 	'error',
				header: 'ERROR',
				sticky: true
			});			
			$("#fileUploadname3" + queueID).fadeOut(250, function() { $("#fileUploadname3" + queueID).remove()});
			return false;
		},
		onComplete: function (evt, queueID, fileObj, response, data) {
		
		},onAllComplete: function()
		{
		//$('#fileUploadname4').fileUploadStart();
		}
		
	});
	
	
		
});

$(document).ready(function() {
$("#fileUploadname4").fileUpload({
		'uploader': '../uploadify/uploader.swf',
		'cancelImg': '../uploadify/cancel.png',
		'script': '../uploadify/upload_video.php',
		'folder': '../upload_image/hotel_video',
		'multi': true,
		'displayData': 'percentage',
		
		'fileExt': '*.mp4;*.3gp;',
		'sizeLimit': 5194304,'scriptData':  {'time_id':'<?=time()?>'},
		onSelect:function()
		{
			
			document.getElementById('show1').style.display='';
		}, 
		onError: function (event, queueID ,fileObj, errorObj) {
			var msg;
			if (errorObj.status == 404) {
				alert('Could not find upload script.');
				msg = 'Could not find upload script.';
			} else if (errorObj.type === "HTTP")
				msg = errorObj.type+": "+errorObj.status;
			else if (errorObj.type ==="File Size")
				msg = fileObj.name+'<br>'+errorObj.type+' larger than: '+Math.round(errorObj.sizeLimit/1024)+'KB';
			else
				msg = errorObj.type+": "+errorObj.text;
			$.jGrowl('<p></p>'+msg, {
				theme: 	'error',
				header: 'ERROR',
				sticky: true
			});			
			$("#fileUploadname4" + queueID).fadeOut(250, function() { $("#fileUploadname4" + queueID).remove()});
			return false;
		},
		onComplete: function (evt, queueID, fileObj, response, data) {
		
		},onAllComplete: function()
		{
		//document.userfrm.submit();
		}
		
	});
	
	
		
});
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
                <form action="hotel_addf.php" method="post" enctype="multipart/form-data"  name="userfrm" onsubmit="return valid_form(this)" >
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
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>User</strong></td>
					<td align="left" ><select name="user_id" class="txtfld txt" style="width:250px; " >
					<option value="">None</option>
<?php //SELECT * FROM `tbl_category` WHERE 1`id`, `category`, `status`, `post_date`
$sql_cat=mysql_query("SELECT * FROM tbl_user where user_type='Hotel Owners' order by full_name");
if(@mysql_num_rows($sql_cat)>0){
	while($catline=mysql_fetch_array($sql_cat)){
?>
					<option value="<?php echo $catline['id'];?>"<?php if($line['user_id']==$catline['id']){ echo 'selected';}?>><?php echo $catline['full_name'];?></option>
	<?php } }?>
					
					</select>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel Name(English)</strong></td>
					<td align="left" ><input type="text" name="hotel_name" class="txtfld txt" style="width:250px; " value="<?php echo $hotel_name;?>"/>&nbsp;<span class="warning">*</span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Category(English)</strong></td>
					<td align="left" ><select name="category" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile(this.value);">
					<option value="">None</option>
<?php //SELECT * FROM `tbl_category` WHERE 1`id`, `category`, `status`, `post_date`
$sql_cat=mysql_query("SELECT * FROM tbl_category where status=1");
if(@mysql_num_rows($sql_cat)>0){
	while($catline=mysql_fetch_array($sql_cat)){
?>
					<option value="<?php echo $catline['id'];?>"<?php if($line['category']==$catline['id']){ echo 'selected';}?>><?php echo $catline['category_English'];?></option>
	<?php } }?>
					
					</select>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Subcategory(English)</strong></td>
					<td align="left" id="subcat"><select name="subcategory" class="txtfld txt" style="width:250px; ">
					<option value="">Select Category First</option>
					
					</select>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Rate</strong></td>
					<td align="left" ><select name="rate" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Hotel Rating</option>
<?php
	for($i=1;$i<6;$i++){
?>
					<option value="<?php echo $i;?>"<?php if($rate==$i){ echo 'selected';}?>><?php echo $i.' Star';?></option>
	<?php } ?>
			<option value="6"<?php if($rate=='6'){ echo 'selected';}?> >boutique</option>
					
					</select>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Description(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('description');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($description);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Add Photos</strong></td>
					<td align="left" class="txt" >
					<?php //echo "select * from tbl_hotel_image where hotel_id='$id'";
					$sharp=mysql_query("select * from tbl_hotel_image where hotel_id='$id'");
							$row_sharp=mysql_num_rows($sharp);
							if($row_sharp)
							{
								while($jack=mysql_fetch_assoc($sharp))
								{?>
									<img src="../upload_image/hotel_img/thumb/<?=$jack['image']?>" /><br /><a href="hotel_addf.php?id=<?=$_REQUEST['id']?>&del_img=<?=$jack['id']?>" class="orangetxt">Delete</a><br />
								<? }
							} ?>
					<div id="fileUploadname3">Please wait...</div><div id="show" style="display: none; padding-top: 5px;" class="small_blue">Click Browse again to choose more pictures to upload</div>
					<br />
					<input class="upload_button" type="button" onClick="javascript:$('#fileUploadname3').fileUploadStart();" name="submit1" value="Upload">&nbsp;<br />You can select multiple Image File. jpg, gif, png only. Per item 50
k limited.
					</td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Add Videos</strong></td>
					<td align="left" class="txt">
					<?php //echo "select * from tbl_hotel_image where hotel_id='$id'";
					$sharp2=mysql_query("select * from tbl_hotel_video where hotel_id='$id'");
							$row_sharp2=mysql_num_rows($sharp2);
							if($row_sharp2)
							{
								$j=1;
								while($jack2=mysql_fetch_assoc($sharp2))
								{?>
									Video<?=$j?><br /><a href="../upload_image/hotel_video/<?=$jack2['video']?>" target="_blank" class="orangetxt">View</a>&nbsp;&nbsp;<a href="hotel_addf.php?id=<?=$_REQUEST['id']?>&del_vdi=<?=$jack2['id']?>" class="orangetxt">Delete</a><br />
								<? 
								$j++;
								}
							} ?>
					<div id="fileUploadname4">Please wait...</div><div id="show1" style="display: none; padding-top: 5px;" class="small_blue">Click Browse again to choose more videos to upload</div>
					<br />
					<input class="upload_button" type="button" onClick="javascript:$('#fileUploadname4').fileUploadStart();" name="submit1" value="Upload">
					<?php if($id) { ?><strong style="padding-left:150px;"><a href="javascript:void(0)" onclick="open_win('videoThumbnail.php?id=<?php echo $id; ?>')">Add Video Thumnails</a></strong><?php } ?>
					</td>
					
					<script>
						function open_win(url_add)
					   {
					   window.open(url_add,'welcome','width=700,height=300,top=150,left=350');
					   }

					</script>

				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Hotel Facilities</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Activities(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('activities');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($activities);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Services(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('services');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($services);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>General(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('generals');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($generals);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Hotel Information</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Rooms(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('rooms');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($rooms);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Prices(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('prices');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($prices);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Arround The Hotel</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Historical(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('historical');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($historical);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Entertainment(English)</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('entertainment');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($entertainment);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Contact Information</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Contact(English)</strong></td>
					<td align="left" ><input type="text" name="contact" class="txtfld txt" style="width:250px; " value="<?php echo $contact;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel Name(English)</strong></td>
					<td align="left" ><input type="text" name="contact_hotel" class="txtfld txt" style="width:250px; " value="<?php echo $contact_hotel;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Adress(English)</strong></td>
					<td align="left" ><textarea  name="address" class="txtfld txt" style="width:250px; height:40px; "><?php echo $address;?></textarea>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Country(English)</strong></td>
					<td align="left" ><select name="country" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile1(this.value);">
					<option value="">Please Select Country</option>
<?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_con=mysql_query("SELECT * FROM country where status=1");
if(@mysql_num_rows($sql_con)>0){
	while($conline=mysql_fetch_array($sql_con)){
?>
					<option value="<?php echo $conline['country_id'];?>"<?php if($line['country']==$conline['country_id']){ echo 'selected';}?>><?php echo $conline['country_English'];?></option>
	<?php } }?>
					
					</select>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>State(English)</strong></td>
					<td align="left" id="stateid"><select name="state" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select State</option>
					
					</select>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>City(English)</strong></td>
					<td align="left" id="cityid"><select name="city" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select City</option>
					
					</select>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Zipcode(English)</strong></td>
					<td align="left" id="zipid"><select name="zipcode" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Zipcode</option>
					
					</select>
				</tr>
				
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Phone</strong></td>
					<td align="left" ><input type="text" name="phone" class="txtfld txt" style="width:250px; " value="<?php echo $phone;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Fax</strong></td>
					<td align="left" ><input type="text" name="fax" class="txtfld txt" style="width:250px; " value="<?php echo $fax;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Email</strong></td>
					<td align="left" ><input type="text" name="email" class="txtfld txt" style="width:250px; " value="<?php echo $email;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				
				<TR class="evenRow">
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
