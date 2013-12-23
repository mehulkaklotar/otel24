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
			move_uploaded_file($_FILES['Filedata']['tmp_name'],"../upload_image/hotel_video/".$image1);
			$ext=substr($image1,-3,3);
			//copy("../upload_image/hotel_img/".$image1,"../upload_image/hotel_img/thumb/".$image1);
			//@resize_img('../upload_image/hotel_img/thumb/'.$image1,97,'', false, 80, 0, "");
			
			$videoUpload = "../upload_image/hotel_video/".$image1;
			$imageUpload   = "../upload_image/hotel_video/thumb/";
			
			$strLen        = strlen($image1);
			$strPos        = strpos($image1,'.');
			$strSub        = substr($image1,$strPos,$strLen);
			$imageName = str_replace($strSub,".jpg",$image1);
			system("ffmpeg -i $videoUpload -r 1  -t 00:00:01 -f image2 $imageUpload/$imageName");

			// set up basic connection
			$conn_id = ftp_connect($an_server);			
			// login with username and password
			$login_result = ftp_login($conn_id,$an_user,$an_pass);			
			// upload a file
			//$upload_video1 =  "$config[flvdodir]/".$vid.".mp4";
			//rename($upload_video,$upload_video1);
			
			if (ftp_put($conn_id,$folder_path."pictures/".$image1,"../upload_image/hotel_video/".$image1, FTP_BINARY)) {				//$sql="UPDATE video SET active = '1' WHERE VID = '" .mysql_real_escape_string($vid). "'";
			 	//$conn->execute($sql); 
				@unlink("../upload_image/hotel_video/".$image1);
			} 	
						
			// close the connection
			ftp_close($conn_id);	
						
			mysql_query("insert into tbl_hotel_video set hotel_id='$time_id',video='$image1'");
			
			
		}
	
}
	

	//echo $id;

?>