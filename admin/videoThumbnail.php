<?php
session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
extract($_REQUEST);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>

<script src="ajax.js"></script>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../uploadify/uploadify.css" type="text/css" />

<link rel="stylesheet" href="../uploadify/uploadify.jGrowl.css" type="text/css" />
<script type="text/javascript" src="../js/func.js"></script>
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.uploadify.js"></script>
<script type="text/javascript" src="../js/jquery.jgrowl_minimized.js"></script>
<script type="text/javascript">

$(document).ready(function() {
$("#fileUploadname4").fileUpload({
		'uploader': '../uploadify/uploader.swf',
		'cancelImg': '../uploadify/cancel.png',
		'script': '../uploadify/upload_video_thumb.php',
		'folder': '../upload_image/hotel_video/thumb',
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


function valid_form() {
	if(document.getElementById('video').value == "")
	{
		alert("Please Select video!");
		document.getElementById('video').focus();
		return false;
	}
}



</script>

<?php
 
$id = $_GET['id'];

	

	if($id)	{
		
		if(isset($_POST['submit'])) {
			$video_id = $_POST['video'];
			$time_id = $_POST['time_id'];
			$image1=time().'-'.str_replace(" ","-",$_FILES['thumbnail']['name']);
			move_uploaded_file($_FILES['thumbnail']['tmp_name'],"../upload_image/hotel_video/thumb/".$image1);
			@resize_img('../upload_image/hotel_video/thumb/'.$image1,97,'', false, 80, 0, "");
			$sql = "UPDATE tbl_hotel_video SET video_thumb='$image1' WHERE id='$video_id' ";
			$result = executeQuery($sql);
		}

		$sql = "SELECT * FROM tbl_hotel_video WHERE hotel_id='$id'";
		$result = executeQuery($sql);
		$num    = mysql_num_rows($result);
		if($num) {
			echo "<form method='POST' enctype='multipart/form-data'  name='userfrm' onsubmit='return valid_form();'>";
			echo "<input type='hidden' name='time_id' value='".time()."' id='time_id'>";
			echo "<table width='50%' cellspacing='5' cellpadding='0' align='center' style='padding-top:20px;'>";
			echo "<tr class='evenRow'><td class='txt'><strong>Select Video :</strong></td>";
			echo "<td><select name='video' id='video'>";
			echo "<option value=''>Select Video</option>";
			$i = 1;
			while($row = mysql_fetch_array($result)) {

				echo "<option value=".$row['id'].">Video".$i."</option>";		
				$i++;
			}
			echo "</select></td></tr>";
			echo "<tr><td class='txt'><strong>Add Video Thumbnails :</strong></td>";
			//echo "<td><div id='fileUploadname4'>Please wait...</div><div id='show1' style='display: none; padding-top: 5px;' class='small_blue'>Click Browse again to choose more videos to upload</div><br />";
			//echo "<input class='upload_button' type='button' onClick=\"javascript:$('#fileUploadname4').fileUploadStart();\" name='submit1' value='Upload'></td></tr>";
			echo "<td><input type='file' name='thumbnail'></td>";
			echo "<tr><td>&nbsp;</td></tr>";
			echo "<tr><td></td><td><input class='button' type='submit' name='submit' value='Submit'  /></td></tr>";
			echo "<tr><td></td><td align='right'><a href='javascript:self.close();'>Close</a></td></tr>";
			echo "</table>";
			echo "</form>";
		} else {
			echo "<table width='50%' cellspacing='5' cellpadding='0' align='center' style='padding-top:20px;'>";
			echo "<tr><td>Please Uplaod videos First</td></tr>";
			echo "</table>";
		}
	}

?>
