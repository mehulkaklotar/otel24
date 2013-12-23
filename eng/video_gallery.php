<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$id=$_GET['id'];
if(!isset($_SESSION['userid']))
{
	header("location:hotelbooksignin.php?id=".$id);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" href="engine/css/videolightbox.css" type="text/css" />
		<style type="text/css">#videogallery a#videolb{display:none}</style>
		
        <link rel="stylesheet" type="text/css" href="engine/css/overlay-minimal.css"/>
        <script src="engine/js/jquery.tools.min.js" type="text/javascript"></script>
        <script src="engine/js/swfobject.js" type="text/javascript"></script>
        <!-- make all links with the 'rel' attribute open overlays -->
        <script src="engine/js/videolightbox.js" type="text/javascript"></script>
</head>
<?php
$sql="select * from tbl_hotel where id='".$id."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$hotel_name=$row['hotel_name'];
?>
<body>
<script type="text/javascript">

function onYouTubePlayerReady(playerId) { 
ytplayer = document.getElementById("video_overlay"); 
ytplayer.setVolume(100); 
} 

</script> 
<div id="photo_main">
<div id="hotel" class="floatleft">
	<div id="lefthotel" class="floatleft">
         <div id="price">
        
            <?php 
					if($row['rate']=="boutique")
					{
						echo "Boutique";
					}
					else
					{
						for($i=1;$i<=$row['rate'];$i++)
						{
							echo "<img src='images/star1.png' height='15' width='15'>";
						}
					}
			
			 ?>
        </div>
        <div id="img">
             <?php
			$imgsql="select * from tbl_hotel_image where hotel_id='".$row['id']."'";
			$imgres=mysql_query($imgsql);
			$imgrow=mysql_fetch_array($imgres);
			$imgname=$imgrow['image'];	
			?>
            <img src="../upload_image/hotel_img/<?php echo $imgname; ?>" height="120" width="179"/>
        </div>
        <div id="rate">
            From <?php echo $row['prices'];?> Euro
        </div>
    </div>
    
    <div id="middlehotel" class="floatleft">
        <div id="hotelname">
            <?php echo $hotel_name; ?>
      </div>
        <div id="hotelcontent">
          <?php
			 $desc=$row['description'];
			 $description=substr($desc,1,145);
			 echo $description."...<a href='hoteldetails.php?id=$row[id]'>>>></a>";
			 ?>
        </div>
<div id="gallery">
            <table>
            	<tr>
                	<td><a href="video_gallery.php?id=<?php echo $row['id']; ?>"><img src="images/videogallery_active.png" /></a></td>
                    <td><a href="photo_gallery.php?id=<?php echo $row['id']; ?>"><img src="images/photogallery.png" /></a></td>
                    <td><a href="guestbook.php?id=<?php echo $row['id']; ?>"><img src="images/guestbook.png" /></a></td>
                    <td><a href="onmap.php?id=<?php $row['id'];?>"><img src="images/onmap.png" /></a></td>
                </tr>
            </table>
            
        </div>
    </div>
    
    <div class="clear" ></div>
   
    <div id="signin_photo">
    <table>
    <tr>
     <?php 
	 $video_sql="select * from tbl_hotel_video where hotel_id='".$id."'";
	 $video_res=mysql_query($video_sql);
	 $cnt=0;
	 while($video_row=mysql_fetch_array($video_res))
	 {
	 	$cnt++;
	  ?>
      	<td>
   	  	<div class="hotel_vid">
        	<div id="videogallery">
	<a rel="#voverlay" href="engine/swf/player.swf?url=../../../upload_image/hotel_video/<?php echo $video_row['video']; ?>&volume=100"><img src="../upload_image/hotel_video/thumb/<?php echo $video_row['video_thumb'];?>" height="68"  width="125" alt="" /><span></span></a><a id="videolb" href="http://videolightbox.com">Add Video to Website by VideoLightBox.com v1.11</a>
	</div>
        </div>
        </td>
        <?php if($cnt%3==0){echo "</tr><tr>";} ?>
       <?php } ?>
       </tr>
       </table>
    </div>

</div>


<div class="image1 floatleft">
        	<table>
            <tr>
            	<td height="25"><?php if($_SESSION['userid']){?><a href="signout.php">Sign out</a><?php }else{?><a href="signin.php?keepThis=true&TB_iframe=true&height=628&width=750" title="" class="thickbox">Sign in</a><?php }?>
                </td>
            </tr>
            <tr>
            	<td class="avalhead" nowrap="nowrap" align="left">Room Availability</td>
            </tr>
            <tr>
            	<td class="avalvalue" nowrap="nowrap" align="left">Last (<font color="#FF0000">20</font>) Rooms</td>
            </tr>
            <tr>
            	<td align="center" ><a href="book_hotel.php?id=<?php echo $id;?>"><img src="images/booknow.png" /></a></td>
            </tr>
            <tr height="4">
            </tr>
            <tr>
            	<td align="left"><img src="images/stamp.png" /></td>
            </tr>  
            <tr height="4">
            </tr>
             <tr>
            	<td align="left"><img src="images/shield.png" /></td>
            </tr> 
             <tr>
            	<td class="secure">Best Securited Account for Travel Agency</td>
            </tr>    
             <tr>
            	<td class="secure" ><br />Start Now..!!</td>
            </tr>  
            <tr height="20">
            </tr>
            <tr>
            	<td class="join">
                	
            			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                  
                  			<tr>
                    			<td>Already a Otel24 Member?</td>
                  			</tr>
                  			<tr>
                   			 	<td>&nbsp;</td>
                  			</tr>
                  			<tr>
                   			 	<td><a href="hotelbooksignin.php?id=<?php echo $_GET['id']; ?>">Sign In</a></td>
                  			</tr>
                
                		</table>
               	 	
                </td>
            </tr>
            <tr>
            	<td align="center" ><input type="button" class="btnb2l" value="" onclick="javaecript:location.href='searchres.php'" /></td>
            </tr>         
            </table>        	
        </div>
</div>
</body>
</html>
