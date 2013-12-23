<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
include("FCKeditor/fckeditor.php");

if(isset($_GET['id'])){
	$hotel_id = $_GET['id'];
}
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
		if($id)
		{
				$email_dup_query=executeQuery("select id from tbl_hotel where id!=$id and hotel_name='$hotel_name'");
	    }
		else
		{
				$email_dup_query=executeQuery("select id from tbl_hotel where hotel_name='$hotel_name'");
		}
		
		if(mysql_num_rows($email_dup_query)>0)
		{
			$_SESSION['sess_msg']='This Hotel already exist';
		}
		else
		{
			if($id=='')
			{
			   // print_r($jack['image']);
			   if($languages==0)
			   {
			   
			   executeQuery("insert into tbl_hotel set hotel_name_Turkish='".$_POST['hnt1']."',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."', description_Turkish='".addslashes($_POST['description_turkish'])."',activities_Turkish='".addslashes($_POST['activities_turkish'])."',services_Turkish='".addslashes($_POST['services_turkish'])."',generals_Turkish='".addslashes($_POST['generals_turkish'])."',rooms_Turkish='".addslashes($_POST['rooms_turkish'])."',prices_Turkish='".$_POST['prices_turkish']."',historical_Turkish='".addslashes($_POST['historical_turkish'])."',entertainment_Turkish='".addslashes($_POST['entertainment_turkish'])."',contact_Turkish='".$_POST['contact_turkish']."',contact_hotel_Turkish='".$_POST['contact_hotel_turkish']."',address_Turkish='".addslashes($_POST['address_turkish'])."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."',languages=$languages,local='$local',village='$village'");
			   
			   //echo "insert into tbl_hotel set hotel_name_Turkish='".$_POST['hnt1']."',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."', description_Turkish='".addslashes($_POST['description_turkish'])."',activities_Turkish='".addslashes($_POST['activities_turkish'])."',services_Turkish='".addslashes($_POST['services_turkish'])."',generals_Turkish='".addslashes($_POST['generals_turkish'])."',rooms_Turkish='".addslashes($_POST['rooms_turkish'])."',prices_Turkish='".$_POST['prices_turkish']."',historical_Turkish='".addslashes($_POST['historical_turkish'])."',entertainment_Turkish='".addslashes($_POST['entertainment_turkish'])."',contact_Turkish='".$_POST['contact_turkish']."',contact_hotel_Turkish='".$_POST['contact_hotel_turkish']."',address_Turkish='".addslashes($_POST['address_turkish'])."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."',languages=$languages,local='$local',village='$village'";
			   
			   }
			   else if($languages==1)
			   {
			 	executeQuery("insert into tbl_hotel set hotel_name='".$_POST['hnt']."',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."',languages=$languages,local='$local',village='$village',description='".addslashes($_POST['description'])."',activities='".addslashes($_POST['activities'])."',services='".addslashes($_POST['services'])."',generals='".addslashes($_POST['generals'])."',rooms='".addslashes($_POST['rooms'])."',prices='".addslashes($_POST['prices'])."',historical='".addslashes($_POST['historical'])."',entertainment='".addslashes($_POST['entertainment'])."',contact='".$_POST['contact']."',contact_hotel='".$_POST['contact_hotel']."',address='".addslashes($_POST['address'])."'");
				}
					 $hotel_id=mysql_insert_id();
					// echo "update tbl_hotel_image set hotel_id='$hotel_id' where hotel_id='$time_id'";
					 mysql_query("update tbl_hotel_image set hotel_id='$hotel_id' where hotel_id='$time_id'");
					 mysql_query("update tbl_hotel_video set hotel_id='$hotel_id' where hotel_id='$time_id'");
					
					 $sql = "SELECT * FROM tbl_hotel_image WHERE hotel_id='$hotel_id'";
					 $res = executeQuery($sql);
					 $imgTotal = mysql_num_rows($res);
					  $sql = "SELECT * FROM tbl_hotel_video WHERE hotel_id='$hotel_id'";
					  $res = executeQuery($sql);
					  $videoTotal = mysql_num_rows($res);
					 mysql_query("update tbl_hotel set image=$imgTotal,video=$videoTotal where id='$hotel_id' ") or die(mysql_error());

					//echo "update tbl_hotel set image='$imgTotal',video='$videoTotal' where hotel_id='$hotel_id'";
					 // $_SESSION['sess_msg']='Hotel added successfully!';
					   header("Location: hotel_addf.php?id=$hotel_id");
						 //exit();
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
					 if($languages==0)
					 {
					 	$sql="update tbl_hotel set hotel_name_Turkish='".$_POST['hnt1']."',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."', description_Turkish='".addslashes($_POST['description_turkish'])."',activities_Turkish='".addslashes($_POST['activities_turkish'])."',services_Turkish='".addslashes($_POST['services_turkish'])."',generals_Turkish='".addslashes($_POST['generals_turkish'])."',rooms_Turkish='".addslashes($_POST['rooms_turkish'])."',prices_Turkish='".$_POST['prices_turkish']."',historical_Turkish='".addslashes($_POST['historical_turkish'])."',entertainment_Turkish='".addslashes($_POST['entertainment_turkish'])."',contact_Turkish='".$_POST['contact_turkish']."',contact_hotel_Turkish='".$_POST['contact_hotel_turkish']."',address_Turkish='".addslashes($_POST['address_turkish'])."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."',languages=$languages,local='$local',village='$village'";
					 
					 }
					 else if($languages==1)
					 {
					 	$sql="update tbl_hotel set hotel_name='".$_POST['hnt']."',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."',languages=$languages,local='$local',village='$village',description='".addslashes($_POST['description'])."',activities='".addslashes($_POST['activities'])."',services='".addslashes($_POST['services'])."',generals='".addslashes($_POST['generals'])."',rooms='".addslashes($_POST['rooms'])."',prices='".addslashes($_POST['prices'])."',historical='".addslashes($_POST['historical'])."',entertainment='".addslashes($_POST['entertainment'])."',contact='".$_POST['contact']."',contact_hotel='".$_POST['contact_hotel']."',address='".addslashes($_POST['address'])."'";
					 
					 }
					// $sql="update tbl_hotel set hotel_name='".$_POST['hnt']."',hotel_name_Turkish='".$_POST['hnt']."',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."', food_p='".$_POST['food_p']."', decor_p='".$_POST['decor_p']."', service_p='".$_POST['service_p']."', cost_p='".$_POST['cost_p']."', description_Turkish='".addslashes($_POST['description_turkish'])."',activities_Turkish='".addslashes($_POST['activities_turkish'])."',services_Turkish='".addslashes($_POST['services_turkish'])."',generals_Turkish='".addslashes($_POST['generals_turkish'])."',rooms_Turkish='".addslashes($_POST['rooms_turkish'])."',prices_Turkish='".$_POST['prices_turkish']."',historical_Turkish='".addslashes($_POST['historical_turkish'])."',entertainment_Turkish='".addslashes($_POST['entertainment_turkish'])."',contact_Turkish='".$_POST['contact_turkish']."',contact_hotel_Turkish='".$_POST['contact_hotel_turkish']."',address_Turkish='".addslashes($_POST['address_turkish'])."',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',status=1,post_date=now(),user_id='".$user_id."',languages=$languages,local='$local',village='$village',description='".addslashes($_POST['description'])."',activities='".addslashes($_POST['activities'])."',services='".addslashes($_POST['services1'])."',generals='".addslashes($_POST['generals'])."',rooms='".addslashes($_POST['rooms'])."',prices='".addslashes($_POST['prices'])."',historical='".addslashes($_POST['historical'])."',entertainment='".addslashes($_POST['entertainment'])."',contact='".$_POST['contact']."',contact_hotel='".$_POST['contact_hotel']."',address='".addslashes($_POST['address'])."'";

					 //$sql = "update tbl_hotel set hotel_name='$hotel_name',category='$category',subcategory='$subcategory',rate='$rate', place_type='".$_POST['place_type']."', food_p='".$_POST['food_p']."', decor_p='".$_POST['decor_p']."', service_p='".$_POST['service_p']."', cost_p='".$_POST['cost_p']."', description='".addslashes($description)."',activities='".addslashes($activities)."',services='".addslashes($services)."',generals='".addslashes($generals)."',rooms='".addslashes($rooms)."',prices='".addslashes($prices)."',historical='".addslashes($historical)."',entertainment='".addslashes($entertainment)."',contact='$contact',contact_hotel='$contact_hotel',address='$address',country='$country',city='$city',state='$state',zipcode='$zipcode',phone='$phone',fax='$fax',email='$email',user_id='".$user_id."',languages='$languages',image='$imgTotal',video=' $videoTotal',local='$local',village='$village'";
					 
					 $sql.=" where id='$id'";
					// echo $sql;
					 executeUpdate($sql);
					 
					  $_SESSION['sess_msg']='Hotel updated successfully!';
					   header("Location: hotel_addf.php?id=$id");
			 			exit();
				   }
			
	}
  }
  
if($id){
	$result=executeQuery("select * from tbl_hotel where id='$id'");
	$num=mysql_num_rows($result);
	if($line=ms_stripslashes(mysql_fetch_array($result))){
	//print_r($line);
	@extract($line);
	}

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript">
function hideDivArea(area_hide){
//alert(area_hide);
for (var i = 0; i < area_hide.length; i++)
{
geh = document.getElementById(area_hide[i]);
geh.style.display = "none";
}
}

function showDivArea(areas_show){
ge = document.getElementById(areas_show);
ge.style.display = "block";
}
</script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<script type="text/javascript" src="FCKeditor/fckeditor.js"></script>
<script src="ajax.js"></script>
<script>

function linkprofileeng(str)
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
	var strResultFunc = "displaysubResulteng";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResulteng(strIn) {
//alert(strIn);
document.getElementById('subcat').innerHTML=strIn;
}
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



function linkprofile3eng(str,zip)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="zip_ajax1.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $zipcode;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResult3eng";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResult3eng(strIn) {
//alert(strIn);
document.getElementById('zip_id').innerHTML=strIn;
}


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


function linkprofilelocal(str)
{  //	alert("nghgh");
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="local_ajax.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $local;?>";	
	var strURL = url;
	//alert(strURL);
	var strResultFunc = "displaysubResultlocal";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}

function displaysubResultlocal(strIn) {
//alert(strIn);
document.getElementById('localid').innerHTML=strIn;
}


function linkprofilevillage(str,village)
{  	//alert(str);
    url = document.location.href;
	xend = url.lastIndexOf("/") + 1;
	var base_url = url.substring(0, xend);
	url="village_ajax.php";
	 if (url.substring(0, 4) != 'http') {
	url = base_url + url;		
	}		
	var strSubmit="id1="+str+"&sel=<?php echo $village;?>";	
	var strURL = url;
	var strResultFunc = "displaysubResultvillage";
	xmlhttpPost(strURL, strSubmit, strResultFunc)
}
function displaysubResultvillage(strIn) {
//alert(strIn);
document.getElementById('villageid').innerHTML=strIn;
}



function linkprofile3(str,zip)
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
$("#fileUploadnamemy1").fileUpload({
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
			
			document.getElementById('show3').style.display='';
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
			$("#fileUploadnamemy1" + queueID).fadeOut(250, function() { $("#fileUploadnamemy1" + queueID).remove()});
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
$("#fileUploadnamemy2").fileUpload({
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
			
			document.getElementById('show2').style.display='';
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
			$("#fileUploadnamemy2" + queueID).fadeOut(250, function() { $("#fileUploadnamemy2" + queueID).remove()});
			return false;
		},
		onComplete: function (evt, queueID, fileObj, response, data) {
		
		},onAllComplete: function()
		{
		//document.userfrm.submit();
		}
		
	});
	
	
		
});



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



function suffleon()
{
document.getElementById("myturkey").style.display='inline';document.getElementById("myenglish").style.display='none';
document.getElementById("myid").className='linkactive';
document.getElementById("myid1").className='linkstyle';

}
function suffleoff()
{
document.getElementById("myturkey").style.display='none';document.getElementById("myenglish").style.display='inline';
document.getElementById("myid1").className='linkactive';
document.getElementById("myid").className='linkstyle';

}
function change()
{
setTimeout("alertMsg()",2000);
}
function alertMsg()
{
clearTimeout();
document.getElementById("myenglish").style.display='none';

}
</script>
<style type="text/css">
a.linkstyle{
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:none;
color:#79ccd9;
}
.linkstyle a{
color:#79ccd9;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:none;
}
.linkstyle a:hover{
color:#79ccd9;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:underline;
}
a.linkactive{
color:#7b8992;
font-family:Arial, Helvetica, sans-serif;
font-size:14px;
font-weight:bold;
text-decoration:none;
}


</style>
<style type="text/css">
	.hide{
		display:none;
	}
</style>
</head>
<body  onload="change();" >
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
                      <td width="50%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Manage Place</td>
                      <td width="50%" align="right"><?php if(isset($_GET['id'])){?><a href="change_image.php?id=<?php echo $hotel_id;?>"><input name="b1" type="button" class="button" id="b1" value="Change Image"></a><a href="change_video.php?id=<?php echo $hotel_id;?>"><input name="b1" type="button" class="button" id="b1" value="Change Video"></a><?php }?> <input name="b1" type="button" class="button" id="b1" value="Manage Place" onClick="location.href='hotel_list.php'">
                      &nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top">
            <div class="linkstyle"><a href="javascript:;" id="myid" onclick="javascript:suffleon();">Türkçe</a> <a href="javascript:;" id="myid1" onclick="javascript:suffleoff();">English</a>
</div>
            <br>
            <div id="myturkey">
                <form action="hotel_addf.php" method="post" enctype="multipart/form-data"  name="userfrm" onsubmit="return valid_form(this)" >
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="languages" value="0">
				<input type="hidden" name="time_id" value="<?=time()?>" id="time_id">
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Yeni <?php }?> Mekan Ekle</TD>
				</TR>
			    <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Doldurulması zorunludur.</td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Kullanıcı</strong></td>
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
					<td class="txt" align="right" style="padding-left:80px; "><strong>Mekan Adı</strohng></td>
					<td align="left" ><input type="text" name="hnt1" class="txtfld txt" id="hnt1" style="width:250px; " value="<?php echo $hotel_name_Turkish; ?>"/>&nbsp;<span class="warning">*</span>
				</tr>
				<!--<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Kategori</strong></td>
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
					<td class="txt" align="right" style="padding-left:80px; "><strong>Alt Kategori</strong></td>
					<td align="left" id="subcat"><select name="subcategory" class="txtfld txt" style="width:250px; ">
					<option value="">Select Category First</option>
					
					</select>
				</tr>-->
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Yıldız</strong></td>
					<td align="left" ><select name="rate" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Hotel Rating</option>
<?php
	for($i=1;$i<6;$i++){
?>
					<option value="<?php echo $i;?>"<?php if($rate==$i){ echo 'selected';}?>><?php echo $i.' Star';?></option>
	<?php } ?>
			<option value="boutique"<?php if($rate=='boutique'){ echo 'selected';}?> >boutique</option>
					
					</select>&nbsp;<span class="warning"></span>
                    </tr><!-- added by mahi -->
<?php if($place_type == ''){?>                    
				
                <tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px;" valign="top"><strong>Mekan Tipi</strong></td>
					<td align="left" ><select name="place_type" class="txtfld txt" style="width:250px; ">
					<option  value="">Please Select Place Type</option>
                  <!--  <option onclick="javascript:showDivArea('area10')" value="Restaurant">Restaurant</option>
                    <option onclick="javascript:showDivArea('area10')" value="CafeBar">Cafe&Bar</option>
                    <option onclick="javascript:showDivArea('area10')" value="Club">Club</option>
                    <option onclick="javascript:showDivArea('area10')" value="Beach">Beach</option>-->
                    <option  value="Hotel">Hotel</option>
                    <!--<option onclick="javascript:showDivArea('area10')" value="Marina">Marina</option>			-->		
					</select>&nbsp;<span class="warning"></span>
                    
                    <br />
                    <!--<div id="area10" style="display:none;">
                    	<table border="0" width="100%" cellpadding="0" cellspacing="0">
                        	<tr class="evenRow">
                            	<td width="13%">Food: </td>
                                <td><input type="text" name="food_p" id="food_p" size="24" value="" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Decor: </td>
                                <td><input type="text" name="decor_p" id="decor_p" size="24" value="" /></td>
                            </tr>
                            <tr class="evenRow">
                            	<td>Services: </td>
                                <td><input type="text" name="service_p" id="service_p" size="24" value="" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Cost: </td>
                                <td width="50px"><input type="text" name="cost_p" id="cost_p" size="24" value="" /></td>
                            </tr>    
                        </table>
                    </div>-->
				</tr>
<?php }else{?>                
	<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px;" valign="top"><strong>Mekan Tipi</strong></td>
					<td align="left" ><select name="place_type" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Place Type</option>
                   <!-- <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Restaurant'){ echo 'selected'; }?> value="Restaurant">Restaurant</option>
                    <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'CafeBar'){ echo 'selected'; }?> value="CafeBar">Cafe&Bar</option>
                    <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Club'){ echo 'selected'; }?> value="Club">Club</option>
                    <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Beach'){ echo 'selected'; }?> value="Beach">Beach</option>-->
                    <option value="Hotel" selected="selected"  <?php if($place_type == 'Hotel'){ echo 'selected'; }?>>Hotel</option>
                   <!-- <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Marina'){ echo 'selected'; }?> value="Marina">Marina</option>		-->			
					</select>&nbsp;<span class="warning"></span>
                    
                    <br />
                    <!--<div id="area10">
                    	<table border="0" width="100%" cellpadding="0" cellspacing="0">
                        	<tr class="evenRow">
                            	<td width="13%">Yemek: </td>
                                <td><input type="text" name="food_p" id="food_p" size="24" value="<?php echo $food_p; ?>" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Dekor: </td>
                                <td><input type="text" name="decor_p" id="decor_p" size="24" value="<?php echo $decor_p; ?>" /></td>
                            </tr>
                            <tr class="evenRow">
                            	<td>Servis: </td>
                                <td><input type="text" name="service_p" id="service_p" size="24" value="<?php echo $service_p; ?>" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Fiyat: </td>
                                <td width="50px"><input type="text" name="cost_p" id="cost_p" size="24" value="<?php echo $cost_p; ?>" /></td>
                            </tr>    
                        </table>
                    </div>-->
				</tr>
<?php } ?>
                
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Açıklama</strong></td>
					<td align="left" ><?php      		 $ofckeditor = new fckeditor('description_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($description_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Resim Ekle</strong></td>
					<td align="left" class="txt" >
					<?php  //echo "select * from tbl_hotel_image where hotel_id='$id'";
					$sharp=mysql_query("select * from tbl_hotel_image where hotel_id='$id'");
							$row_sharp=mysql_num_rows($sharp);
							if($row_sharp)
							{
								while($jack=mysql_fetch_assoc($sharp))
								{
								
								?>
									<img src="../upload_image/hotel_img/thumb/<?=$jack['image']?>" /><br />
<a href="hotel_addf.php?id=<?=$_REQUEST['id']?>&del_img=<?=$jack['id']?>" class="orangetxt">Sil</a><br />
								<? }
							} ?>
					<div id="fileUploadname3">Lütfen Bekleyiniz...</div><div id="show" style="display: none; padding-top: 5px;" class="small_blue">Click Browse again to choose more pictures to upload</div>
					<br />
					<input class="upload_button" type="button" onClick="javascript:$('#fileUploadname3').fileUploadStart();" name="submit3" value="Yükle">&nbsp;<br />
					Bu formatları yükleyin : jpg, gif, png. Her yüklenen belge 50
k limitlidir.
					</td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Video Ekle</strong></td>
					<td align="left" class="txt">
					<?php //echo "select * from tbl_hotel_image where hotel_id='$id'";
					$sharp2=mysql_query("select * from tbl_hotel_video where hotel_id='$id'");
							$row_sharp2=mysql_num_rows($sharp2);
							if($row_sharp2)
							{
								$j=1;
								while($jack2=mysql_fetch_assoc($sharp2))
								{?>
									Video<?=$j?><br />
<a href="../upload_image/hotel_video/<?=$jack2['video']?>" target="_blank" class="orangetxt">Göster</a>&nbsp;&nbsp;<a href="hotel_addf.php?id=<?=$_REQUEST['id']?>&del_vdi=<?=$jack2['id']?>" class="orangetxt">Sil</a><br />
								<? 
								$j++;
								}
							} ?>
					<div id="fileUploadname4">Lütfen Bekleyiniz.</div><div id="show1" style="display: none; padding-top: 5px;" class="small_blue">Click Browse again to choose more videos to upload</div>
					<br />
					<input class="upload_button" type="button" onClick="javascript:$('#fileUploadname4').fileUploadStart();" name="submit1" value="Yükle">
					<?php if($id) { ?><strong style="padding-left:150px;"><a href="javascript:void(0)" onclick="open_win('videoThumbnail.php?id=<?php echo $id; ?>')">Videoya Küçük Resim Ekle</a></strong><?php } ?>
					</td>
					
					<script>
						function open_win(url_add)
					   {
					   window.open(url_add,'welcome','width=700,height=300,top=150,left=350');
					   }

					</script>

				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Otel Fırsatları</strong></td>
				</tr>
                
                
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Aktiviteler</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('activities_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($activities_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Servisler</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('services_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														//$ofckeditor->Value ="";
														$ofckeditor->Value = stripslashes($services_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Genel</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('generals_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($generals_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Otel  Bilgileri</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Odalar</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('rooms_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($rooms_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Fiyatlar</strong></td>
					<td align="left" ><?php /*?><?php  $ofckeditor = new fckeditor('prices_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														//$ofckeditor->Value = stripslashes($prices);
														$ofckeditor->Create();
																						
											?><?php */?><strong>Min. TL</strong>
					  <input type="text" name="prices_turkish" id="prices_turkish" class="txtfld txt" style="width:250px; " value="<?php echo $prices_Turkish; ?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Mekanın Etrafında</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Tarihi</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('historical_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($historical_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Eğlence</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('entertainment_turkish');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($entertainment_Turkish);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span>
				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>İletişim Bilgileri</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Yetkili</strong></td>
					<td align="left" ><input type="text" name="contact_turkish" id="contact_turkish"class="txtfld txt" style="width:250px; " value="<?php echo $contact_Turkish;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Mekan Adı</strong></td>
					<td align="left" ><input type="text" name="contact_hotel_turkish" id="contact_hotel_turkish" class="txtfld txt" style="width:250px; " value="<?php echo $contact_hotel_Turkish;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Adres</strong></td>
					<td align="left" ><textarea  name="address_turkish" id="address_turkish" class="txtfld txt" style="width:250px; height:40px; "><?php echo $address_Turkish;?></textarea>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Ülke</strong></td>
					<td align="left" ><select name="country" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile1(this.value);">
					<option value="" selected="selected">Please Select Country</option>
<?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_con=mysql_query("SELECT * FROM country where status=1");
if(@mysql_num_rows($sql_con)>0){
	while($conline=mysql_fetch_array($sql_con)){
?>
					<option value="<?php echo $conline['country_id'];?>"<?php if($line['country']==$conline['country_id']){ echo 'selected';}?>><?php echo $conline['country_Turkish'];?></option>
	<?php } }?>
					
					</select>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Şehir</strong></td>
					<td align="left" id="stateid"><select name="state" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile2(this.value);">
					<option value="">Please Select State</option>
					<?php
$sql_sta=mysql_query("SELECT * FROM state where status=1");
if(@mysql_num_rows($sql_sta)>0){
	while($staline=mysql_fetch_array($sql_sta)){
?>
					<option value="<?php echo $staline['id'];?>"<?php if($line['state']==$staline['id']){ echo 'selected';}?>><?php echo $staline['name_Turkish'];?></option>
	<?php } }?>
					</select>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong> İlçe</strong></td>
					<td align="left" id="cityid"><select name="city" class="txtfld txt" style="width:250px;" onchange="javascript:linkprofilelocal(this.value);">
					<option value="">Please Select City</option>
                    
					<?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_ci=mysql_query("SELECT * FROM city where status=1");
if(@mysql_num_rows($sql_ci)>0){
	while($conline=mysql_fetch_array($sql_ci)){
?>
					<option value="<?php echo $ciline['id'];?>"<?php if($line['city']==$ciline['id']){ echo 'selected';}?>><?php echo $ciline['city_Turkish'];?></option>
	<?php } }?>
					</select>
				</tr>
                
                <tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Semt</strong></td>
					<td align="left" id="localid"><select name="local" class="txtfld txt" style="width:250px; " <?php if($line['village'] != "") { ?> onchange="javascript:linkprofilevillage(this.value,<?php echo $line['village'];?>);" <?php } else { ?> onchange="javascript:linkprofilevillage(this.value);" <?php } ?> >
					<option value="">Please Select local</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_local=mysql_query("SELECT * FROM local where status=1");
if(@mysql_num_rows($sql_local)>0){
	while($localline=mysql_fetch_array($sql_local)){
?>
					<option value="<?php echo $localline['id'];?>"<?php if($line['local']==$localline['id']){ echo 'selected';}?>><?php echo $localline['local_Turkish'];?></option>
	<?php } }?>
					
					</select>
				</tr>
                
                <tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Mahalle/Köy</strong></td>
					<td align="left" id="villageid"><select name="village" class="txtfld txt" style="width:250px; "  <?php if($line['zipcode'] != "") { ?> onchange="javascript:linkprofile3(this.value,<?php echo $line['zipcode'];?>);" <?php } else { ?> onchange="javascript:linkprofile3(this.value);" <?php } ?> >
					<option value="">Please Select Village</option>
					 <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_village=mysql_query("SELECT * FROM village where status=1");
if(@mysql_num_rows($sql_village)>0){
	while($villageline=mysql_fetch_array($sql_village)){
?>
					<option value="<?php echo $villageline['id'];?>"<?php if($line['village']==$villageline['id']){ echo 'selected';}?>><?php echo $villageline['village_Turkish'];?></option>
	<?php } }?>
					</select>
				</tr>


                
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Posta Kodu</strong></td>
					<td align="left" id="zipid">
                    <select name="zipcode" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Zipcode</option>
					<?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_zipcode=mysql_query("SELECT * FROM tbl_zip where status=1");
if(@mysql_num_rows($sql_zipcode)>0){
	while($zipcodeline=mysql_fetch_array($sql_zipcode)){
?>
					<option value="<?php echo $zipcodeline['id'];?>"<?php if($line['zipcode']==$zipcodeline['id']){ echo 'selected';}?>><?php echo $zipcodeline['zipcode_Turkish'];?></option>
	<?php } }?>
					</select>
				</tr>
				
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Telefon</strong></td>
					<td align="left" ><input type="text" name="phone" class="txtfld txt" style="width:250px; " value="<?php echo $phone;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Fax</strong></td>
					<td align="left" ><input type="text" name="fax" class="txtfld txt" style="width:250px; " value="<?php echo $fax;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>E-Posta</strong></td>
					<td align="left" ><input type="text" name="email" class="txtfld txt" style="width:250px; " value="<?php echo $email;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Gönder" />&nbsp;<input type="reset" name="reset" class="button" value="Sil" /></TD>
				</TR>
				
                </table>
			  </form>
             </div> 
              
              
             
               <div id="myenglish">
              		<form action="hotel_addf.php" method="post" enctype="multipart/form-data"  name="userfrm1" onsubmit="return valid_form(this)" >
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" value="<?php echo $id;?>">
                                <input type="hidden" name="languages" value="1">
				<input type="hidden" name="time_id" value="<?=time()?>" id="time_id">
                <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground"><?php if($id){?>Edit<?php }else{?>Add New<?php }?> Place Details</TD>
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
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel Name</strong></td>
					<td align="left" ><input type="text" name="hnt" id="hnt" class="txtfld txt" style="width:250px; " value="<?php echo $hotel_name; ?>"/>&nbsp;<span class="warning">*</span>
				</tr>
				<!--<tr  class="oddRow">
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
				</tr>-->
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Rate</strong></td>
					<td align="left" ><select name="rate" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Hotel Rating</option>
<?php
	for($i=1;$i<6;$i++){
?>
					<option value="<?php echo $i;?>"<?php if($rate==$i){ echo 'selected';}?>><?php echo $i.' Star';?></option>
	<?php } ?>
			<option value="boutique"<?php if($rate=='boutique'){ echo 'selected';}?> >boutique</option>
					
					</select>&nbsp;<span class="warning"></span>
                    </tr><!-- added by mahi -->
<?php if($place_type == ''){?>                    
				
                <tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px;" valign="top"><strong>Place Type</strong></td>
					<td align="left" ><select name="place_type" class="txtfld txt" style="width:250px; ">
					<!--<option onselect="javascript:hideDivArea('area10')" value="">Please Select Place Type</option>
                    <option onclick="javascript:showDivArea('area10')" value="Restaurant">Restaurant</option>
                    <option onclick="javascript:showDivArea('area10')" value="CafeBar">Cafe&Bar</option>
                    <option onclick="javascript:showDivArea('area10')" value="Club">Club</option>
                    <option onclick="javascript:showDivArea('area10')" value="Beach">Beach</option>-->
                    <option  value="Hotel">Hotel</option>
                <!--    <option onclick="javascript:showDivArea('area10')" value="Marina">Marina</option>			-->		
					</select>&nbsp;<span class="warning"></span>
                    
                    <br />
                   <!-- <div id="area10" style="display:none;">
                    	<table border="0" width="100%" cellpadding="0" cellspacing="0">
                        	<tr class="evenRow">
                            	<td width="13%">Food: </td>
                                <td><input type="text" name="food_p" id="food_p" size="24" value="" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Decor: </td>
                                <td><input type="text" name="decor_p" id="decor_p" size="24" value="" /></td>
                            </tr>
                            <tr class="evenRow">
                            	<td>Services: </td>
                                <td><input type="text" name="service_p" id="service_p" size="24" value="" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Cost: </td>
                                <td width="50px"><input type="text" name="cost_p" id="cost_p" size="24" value="" /></td>
                            </tr>    
                        </table>
                    </div>-->
				</tr>
<?php }else{?>                
	<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px;" valign="top"><strong>Place Type</strong></td>
					<td align="left" ><select name="place_type" class="txtfld txt" style="width:250px; ">
					<option value="">Please Select Place Type</option>
                    <!--<option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Restaurant'){ echo 'selected'; }?> value="Restaurant">Restaurant</option>
                    <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'CafeBar'){ echo 'selected'; }?> value="CafeBar">Cafe&Bar</option>
                    <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Club'){ echo 'selected'; }?> value="Club">Club</option>
                    <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Beach'){ echo 'selected'; }?> value="Beach">Beach</option>-->
                    <option <?php if($place_type == 'Hotel'){ echo 'selected'; }?> value="Hotel">Hotel</option>
                  <!--  <option onclick="javascript:showDivArea('area10')" <?php if($place_type == 'Marina'){ echo 'selected'; }?> value="Marina">Marina</option>-->					
					</select>&nbsp;<span class="warning"></span>
                    
                    <br />
                    <!--<div id="area10">
                    	<table border="0" width="100%" cellpadding="0" cellspacing="0">
                        	<tr class="evenRow">
                            	<td width="13%">Food: </td>
                                <td><input type="text" name="food_p" id="food_p" size="24" value="<?php echo $food_p; ?>" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Decor: </td>
                                <td><input type="text" name="decor_p" id="decor_p" size="24" value="<?php echo $decor_p; ?>" /></td>
                            </tr>
                            <tr class="evenRow">
                            	<td>Services: </td>
                                <td><input type="text" name="service_p" id="service_p" size="24" value="<?php echo $service_p; ?>" /></td>
                            </tr>
                            <tr class="oddRow">
                            	<td>Cost: </td>
                                <td width="50px"><input type="text" name="cost_p" id="cost_p" size="24" value="<?php echo $cost_p; ?>" /></td>
                            </tr>    
                        </table>
                    </div>-->
				</tr>
<?php } ?>
                
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Description</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('description');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($description);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
                
                
                <tr  class="evenRow">
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
					<div id="fileUploadnamemy1">Please wait...</div><div id="show3" style="display: none; padding-top: 5px;" class="small_blue">Click Browse again to choose more pictures to upload</div>
					<br />
					<input class="upload_button" type="button" onClick="javascript:$('#fileUploadnamemy1').fileUploadStart();" name="submit1" value="Upload">&nbsp;<br />You can select multiple Image File. jpg, gif, png only. Per item 50
k limited.
					</td>
				</tr>
				<tr  class="oddRow">
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
					<div id="fileUploadnamemy2">Please wait...</div><div id="show2" style="display: none; padding-top: 5px;" class="small_blue">Click Browse again to choose more videos to upload</div>
					<br />
					<input class="upload_button" type="button" onClick="javascript:$('#fileUploadnamemy2').fileUploadStart();" name="submit1" value="Upload">
					<?php if($id) { ?><strong style="padding-left:150px;"><a href="javascript:void(0)" onclick="open_win('videoThumbnail.php?id=<?php echo $id; ?>')">Add Video Thumnails</a></strong><?php } ?>
					</td>
					
					<script>
						function open_win(url_add)
					   {
					   window.open(url_add,'welcome','width=700,height=300,top=150,left=350');
					   }

					</script>

				</tr>
                
            
				
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Hotel Facilities</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Activities</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('activities');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($activities);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Services</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('services');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($services);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>General</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('generals');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($generals);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Hotel Information</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Rooms</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('rooms');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($rooms);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Prices</strong></td>
					<td align="left" ><?php /* $ofckeditor = new fckeditor('prices');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($prices);
														$ofckeditor->Create();
											*/											
											?><strong>From &euro;</strong><input type="text" name="prices" id="prices" class="txtfld txt" style="width:250px; " value="<?php echo $prices; ?>"/>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr class="oddRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Arround The Hotel</strong></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Historical</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('historical');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($historical);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Entertainment</strong></td>
					<td align="left" ><?php  $ofckeditor = new fckeditor('entertainment');
														$ofckeditor->BasePath = 'FCKeditor/';
														$ofckeditor->Width  = '100%' ;
														$ofckeditor->Height = '300' ;
														$ofckeditor->Value = stripslashes($entertainment);
														$ofckeditor->Create();?>&nbsp;<span class="warning"></span></td>
				</tr>
				<tr class="evenRow">
					<td class="txt" align="left" colspan="2" style="padding-left:10px; "><strong>Contact Information</strong></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Director</strong></td>
					<td align="left" ><input type="text" name="contact" id="contact" class="txtfld txt" style="width:250px; " value="<?php echo $contact; ?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Hotel Name</strong></td>
					<td align="left" ><input type="text" name="contact_hotel" id="contact_hotel" class="txtfld txt" style="width:250px; " value="<?php echo $contact_hotel; ?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Adress</strong></td>
					<td align="left" ><textarea  name="address" id="address" class="txtfld txt" style="width:250px; height:40px; "><?php echo $address; ?></textarea>&nbsp;<span class="warning"></span>
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
					<option value="<?php echo $conline['country_id'];?>"<?php if($line['country']==$conline['country_id']){ echo 'selected';}?>><?php echo $conline['country_English'];?></option>
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
					<option value="<?php echo $staline['id'];?>"<?php if($line['state']==$staline['id']){ echo 'selected';}?>><?php echo $staline['name_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
                
                
                
                
                
                
                
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>City</strong></td>
					<td align="left" id="city_id"><select name="city" class="txtfld txt" style="width:250px; " <?php if($line['local'] != "") { ?> onchange="javascript:linkprofilelocaleng(this.value,<?php echo $line['local'];?>);" <?php } else { ?> onchange="javascript:linkprofilelocaleng(this.value);" <?php } ?> >
					<option value="">Please Select City</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_city=mysql_query("SELECT * FROM city where status=1");
if(@mysql_num_rows($sql_city)>0){
	while($cityline=mysql_fetch_array($sql_city)){
?>
					<option value="<?php echo $cityline['id'];?>"<?php if($line['city']==$cityline['id']){ echo 'selected';}?>><?php echo $cityline['city_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
                <tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Local</strong></td>
					<td align="left" id="local_id"><select name="local" class="txtfld txt" style="width:250px; " <?php if($line['village'] != "") { ?> onchange="javascript:linkprofilevillageeng(this.value,<?php echo $line['village'];?>);" <?php } else { ?> onchange="javascript:linkprofilevillageeng(this.value);" <?php } ?>>
					<option value="">Please Select local</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_local=mysql_query("SELECT * FROM local where status=1");
if(@mysql_num_rows($sql_local)>0){
	while($localline=mysql_fetch_array($sql_local)){
?>
					<option value="<?php echo $localline['id'];?>"<?php if($line['local']==$localline['id']){ echo 'selected';}?>><?php echo $localline['local_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
                <tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Village</strong></td>
					<td align="left" id="village_id"><select name="village" class="txtfld txt" style="width:250px; " <?php if($line['zipcode'] != "") { ?> onchange="javascript:linkprofile3eng(this.value,<?php echo $line['zipcode'];?>);" <?php } else { ?> onchange="javascript:linkprofile3eng(this.value);" <?php } ?>  >
					<option value="">Please Select Village</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_village=mysql_query("SELECT * FROM village where status=1");
if(@mysql_num_rows($sql_con)>0){
	while($villageline=mysql_fetch_array($sql_village)){
?>
					<option value="<?php echo $villageline['id'];?>"<?php if($line['village']==$villageline['id']){ echo 'selected';}?>><?php echo $villageline['village_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
                
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Zip Code</strong></td>
					<td align="left" id="zip_id"><select name="zipcode" class="txtfld txt" style="width:250px; " >
					<option value="">Please Select Zipcode</option>
                    <?php //SELECT * FROM `country` WHERE `short_name`, `country`, `country_id`, `status`
$sql_zip=mysql_query("SELECT * FROM tbl_zip where status=1");
if(@mysql_num_rows($sql_zip)>0){
	while($zipline=mysql_fetch_array($sql_zip)){
?>
					<option value="<?php echo $zipline['id'];?>"<?php if($line['zipcode']==$zipline['id']){ echo 'selected';}?>><?php echo $zipline['zipcode_English'];?></option>
	<?php } }?>

					
					</select>
				</tr>
				
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Phone</strong></td>
					<td align="left" ><input type="text" name="phone" class="txtfld txt" style="width:250px; " value="<?php echo $phone;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Fax</strong></td>
					<td align="left" ><input type="text" name="fax" class="txtfld txt" style="width:250px; " value="<?php echo $fax;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Email</strong></td>
					<td align="left" ><input type="text"  name="email" class="txtfld txt" style="width:250px; " value="<?php echo $email;?>"/>&nbsp;<span class="warning"></span>
				</tr>
				
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit" />&nbsp;<input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				
                </table>
			  </form>
              </div>
              
              
              
              
              
              
              
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
