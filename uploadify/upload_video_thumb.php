<?php 
session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
@extract($_REQUEST);
$userid=$_GET['userid'];
$aff=$_GET['aff'];



if (1) {
	
	$path=$_FILES['Filedata']['name'];


		if($_FILES['Filedata']['size']>0)
		{
			$image1=time().'-'.str_replace(" ","-",$_FILES['Filedata']['name']);
			move_uploaded_file($_FILES['Filedata']['tmp_name'],"../upload_image/hotel_video/thumb/".$image1);
			$ext=substr($image1,-3,3);
		
			
			// set up basic connection
			$conn_id = ftp_connect($an_server);			
			// login with username and password
			$login_result = ftp_login($conn_id,$an_user,$an_pass);			
			// upload a file
			//$upload_video1 =  "$config[flvdodir]/".$vid.".mp4";
			//rename($upload_video,$upload_video1);
			
			if (ftp_put($conn_id,$folder_path."pictures/".$image1,"../upload_image/hotel_video/thumb/".$image1, FTP_BINARY)) {				//$sql="UPDATE video SET active = '1' WHERE VID = '" .mysql_real_escape_string($vid). "'";
			 	//$conn->execute($sql); 
				@unlink("../upload_image/hotel_video/thumb/".$image1);
			} 	
					
			// close the connection
			ftp_close($conn_id);	
			
			
			mysql_query("insert into tbl_hotel_video_thumb set hotel_id='$time_id',video_id='$time_id',video_image='$image1'");
			
			
		}
	
}
	

	//echo $id;

?>
