<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$id=$_GET['id'];
if(!isset($_SESSION['userid']))
{
	header("location:hotelbooksignin.php?id=".$id);
}


$map_sql="select * from tbl_hotel where id=$id";
$map_res=mysql_query($map_sql);
$map_row=mysql_fetch_array($map_res); 

$sql="select * from tbl_hotel where id='".$id."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$hotel_name=$row['hotel_name_Turkish'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Google Maps JavaScript API Example</title>
    <link href="style.css" rel="stylesheet" media="screen" />
    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAA9izDhq0T632C5-R-yVb7MRSiboMCodM0XSniSc5Zj962n5wiWRQFUnxudCUKlnylScdkQFELlBs7aA"
      type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[
	
    var WINDOW_HTML = '<div style="width: 210px; padding-right: 10px"><?php echo "<b>$hotel_name</b>" ?>  is located at <?php echo $row['address_Turkish']; ?>. Phone: <?php echo $row['phone']; ?></div>';	
	
    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
	map.addControl(new GSmallMapControl());
	map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(<?php echo $map_row['latitude']; ?>,<?php echo $map_row['longitude'];?>), 13);
	var marker = new GMarker(new GLatLng(<?php echo $map_row['latitude']; ?>,<?php echo $map_row['longitude'];?>));
	map.addOverlay(marker);
	GEvent.addListener(marker, "click", function() {
	marker.openInfoWindowHtml(WINDOW_HTML);
	  });
	marker.openInfoWindowHtml(WINDOW_HTML);			
      }
    }
    //]]>
    </script>
  </head>
  <body onload="load()" onunload="GUnload()">
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
            From <?php echo $row['prices_Turkish'];?> Euro
        </div>
    </div>
    
    <div id="middlehotel" class="floatleft">
        <div id="hotelname">
            <?php echo $hotel_name; ?>
      </div>
        <div id="hotelcontent">
          <?php
			 $desc=$row['description_Turkish'];
			 $description=substr($desc,1,145);
			 echo $description."...<a href='hoteldetails.php?id=$row[id]'>>>></a>";
			 ?>
        </div>
<div id="gallery">
            <table>
            	<tr>
                	<td><a href="video_gallery.php?id=<?php echo $row['id']; ?>"><img src="images/videogallery.png" /></a></td>
                    <td><a href="photo_gallery.php?id=<?php echo $row['id']; ?>"><img src="images/photogallery.png" /></a></td>
                    <td><a href="guestbook.php?id=<?php echo $row['id']; ?>"><img src="images/guestbook.png" /></a></td>
                    <td><a href="onmap.php?id=<?php echo $row['id']; ?>"><img src="images/onmapactive.png" /></a></td>
                </tr>
            </table>
            
        </div>
    </div>
    
    <div class="clear" ></div>
   
    <div id="signin">
   		<div class="enalarge_photo">
        	
            <div class="floatleft">
            	<div id="map" style="width: 450px; height: 280px"></div>
            </div>
        </div>
    </div>

</div>


<div class="image1 floatleft">
        	<table>
            <tr>
            	<td height="25">
                </td>
            </tr>
            <tr>
            	<td class="avalhead" nowrap="nowrap" align="left">Room Availability</td>
            </tr>
            <tr>
            	<td class="avalvalue" nowrap="nowrap" align="left">Last (<font color="#FF0000">20</font>) Rooms</td>
            </tr>
            <tr>
            	<td align="center" ><a href="book_hotel.php?id=<?php echo $id; ?>"><img src="images/booknow.png" /></a></td>
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
            	<td align="center" ><input type="button" class="btnb2l" value="" onclick="javascript:location.href='searchres.php'"/></td>
            </tr>         
            </table>        	
        </div>
</div>
    
  </body>
</html>
