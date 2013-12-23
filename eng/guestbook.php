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
<script type="text/javascript" src="dhtmlgoodies_calendar.js">
</script>
<link href="dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />

</head>
<?php
$sql="select * from tbl_hotel where id='".$id."'";
$res=mysql_query($sql);
$row=mysql_fetch_array($res);
$hotel_name=$row['hotel_name'];
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
                    <td><a href="guestbook.php?id=<?php echo $row['id']; ?>"><img src="images/guestbookactive.png" /></a></td>
                    <td><a href="onmap.php?id=<?php echo $row['id'];?>"><img src="images/onmap.png" /></a></td>
                </tr>
            </table>
            
        </div>
    </div>
    
    <div class="clear" ></div>
    
    <div id="guestbook">
    	<div id="guestbookhead" class="floatleft">Guestbook
        </div>
        <div id="addnew" class="floatright"><a href="guestadd.php?id=<?php echo $id; ?>"><img src="images/addnew.png" /></a></div>
        <div id="guestcontent">
            <div id="comments">
            	<?php
					$comment_sql="select * from tbl_guest where hotel='$id'";
					$comment_res=mysql_query($comment_sql);
					while($comment_row=mysql_fetch_array($comment_res))
					{
				
				 ?>
            <div class="sender">	
            	Sender: '<?php echo $comment_row['name'];?>'
            </div>
            <div class="sendertext">
            	<?php echo $comment_row['message_English'];?>
            </div>
            <?php } ?>
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
            	<td align="center" ><a href="book_hotel.php"><img src="images/booknow.png" /></a></td>
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
            	<td align="center" ><input type="button" class="btnb2l" value="" onclick="javascript:location.href='searchres.php'" /></td>
            </tr>         
            </table>        	
        </div>
</div>
</body>
</html>
