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
</head>
<?php
$sql="select * from tbl_hotel where id='".$id."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$hotel_name=$row['hotel_name_Turkish'];
?>
<body>
<div id="mainsignin">
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
            <img src="../upload_image/hotel_img/thumb/<?php echo $imgname; ?>" height="120" width="179"/>
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
                	<td><a href="video_gallery.php?id=<?php echo $row['id']; ?>"><img src="images/videogallery.png" /></a></td>
                    <td><a href="photo_gallery.php?id=<?php echo $row['id']; ?>"><img src="images/photogallery.png" /></a></td>
                    <td><a href="guestbook.php?id=<?php echo $row['id']; ?>"><img src="images/guestbook.png" /></a></td>
                    <td><a href="onmap.php?id=<?php echo $row['id'];?>"><img src="images/onmap.png" /></a></td>
                </tr>
            </table>
            
        </div>
    </div>
    
    <div class="clear" ></div>
    
    <div id="signin">
    <div class="heading">Fill the details and book easily...</div>   	
    	<form name="frmbook_hotel" action="" method="post" onsubmit="return validate();">
        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id" id="id" />
        <div id="left" class="floatleft txtheading">
        	<table>
            	<tr>
                	<td>Name:</td>
                </tr>
                <tr>
                	<td><input type="text" name="custname"  /></td><td><div id="d_name" class="red"></div></td>
                </tr>
               
                
                <tr>
                	<td>Phone:</td>
                </tr>
                <tr>
                	<td><input type="text" name="custphone"  /></td>
                </tr>
                <tr>
                	<td>Extension:</td>
                </tr>
                <tr>
                	<td><input type="text" name="custext"  /></td>
                </tr>
               
                
                <tr>
                	<td>Check In:</td>
                </tr>
                <tr>
                	<td><input type="text" name="custcheckin"  /></td><td><div id="d_checkin" class="red"></div></td>
                </tr>
                <tr>
                	<td>Check Out:</td>
                </tr>
                <tr>
                	<td><input type="text" name="custcheckout"  /></td><td><div id="d_checkout" class="red"></div></td>
                </tr>
                   
          </table>				
        </div>
        <div id="right" class="floatleft txtheading">
        	<table cellpadding="2">
            	<tr>
                	<td>Adults:</td>
                </tr>	
                 <tr>
                	<td><input type="text" name="custadults"  /></td>
                </tr>
                 <tr>
                	<td>Children:</td>
                </tr>
                 
                 <tr>
                	<td><input type="text" name="custchildren"  /></td>
                </tr>             
            	<tr>
                	<td>E-Mail Id :</td>
                </tr>
                <tr>
                	<td><input type="text" name="custemail"/></td>
                    <td><div id="d_email" class="red"></div></td>
                </tr>
            	<tr>
                	<td>Room Type:</td>
                </tr>
                <tr>
                	<td nowrap="nowrap"><select name="custroomtype">
            	<option value="0">Select Room Type</option>
                <?php 
					$room_sql="select * from rooms where hotel_id='".$hotel_id."'";
					$room_res=mysql_query($room_sql);
					while($room_row=mysql_fetch_array($room_res))
					{?>
						<option value="<?php echo $room_row['id']; ?>"><?php echo $room_row['room_type']; ?></option>	
			<?php	}
				?>                
            </select></td>
                </tr>
               
                <tr>
                	<td align="center"><input type="submit" class="btngreen" value="Book" name="book" id="book"/></td>
                </tr>  
          </table>              
        </div>
        </form>

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
            	<td class="avalvalue" nowrap="nowrap" align="left">Last (<font color="#FF0000"><?php 
				$room=0;
				$sql1=mysql_query("select * from availability where hotel_id=".$row['id']);
				
				while($res=mysql_fetch_array($sql1))
				{
					$room+=$res['rooms'];
				}
				echo $room;
				?></font>) Rooms</td>
            </tr>
            <tr>
            	<td align="center" ><a href="book_hotel.php?id="><img src="images/booknow.png" /></a></td>
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
                    			<td>Don't have Otel24 account?</td>
                  			</tr>
                  			<tr>
                   			 	<td>&nbsp;</td>
                  			</tr>
                  			<tr>
                   			 	<td><a href="hotelbookregister.php?id=<?php echo $_GET['id']; ?>">Join free</a></td>
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
