<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$msg="";
/*require_once("../codelibrary/inc/variables.php");
*/if(isset($_POST['signin']))
{
	$sel = "select * from tbl_user where email='".mysql_real_escape_string($_POST['email'])."' and password='".mysql_real_escape_string($_POST['passwd'])."' and user_type='Member' and status=1";
	echo $sel;
	$res = mysql_query($sel) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		$rowid = mysql_fetch_object($res);
		$_SESSION['userid'] = $rowid->id;
		header("location:book_hotel.php?id=$_POST[id]");
	}
	else
	{
		$msg = "Invalid login..";

	}
}
$id=$_GET['id'];
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
    	<table width="100%"  border-color:"#589442"  cellspacing="4" cellpadding="4">
  		 <tr>
   			 <td colspan="2">
    			<div id="content">
    				<table width="100%" border="0" cellspacing="0" cellpadding="0">
          				<tr>
            				<td>
            					<form name="frmlogin" method="post" action="" >
                                <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" >
  										<tr>
                							<td><br /></td>
                						</tr>        
                  						<tr>
                                        	 <td colspan="2" align="center" style="color:#FF0000; height:25px;"><?php echo $msg;?></td>
                						</tr>
                  						<tr><td></td>
                    						<td>Email address<br>
												<input type="text" name="email" size="30" />                    						</td>
                 						 </tr>
                 						 <tr>
                							<td><br /><br />											</td>
                						</tr>
                  						<tr><td></td>	
                    						<td>Password<br>
												<input type="password" name="passwd" size="30" /> <a href="forgot.php">Forgot Password?</a></td>
                  						</tr>
                  						<tr>
                							<td><br /><br />											</td>
                						</tr>
                  						<tr><td></td>
                    						<td><input type="submit" name="signin" value="" class="signin">
                    							<!--/*<a href=""><img src="images/signin.png" /></a>*/-->                    						</td>
                  						</tr>
                                 
                                       
                  						<tr>
                  							<td class="fb1" colspan="2" align="right">&nbsp;</td>
               						  </tr>
                                        <tr height="5px">                                        </tr>
                  						<tr><td></td>
                  							<td align="center" class="facebook">&nbsp;</td>
               						  </tr>
                					</table>
                </form>            </td>
            <td >
            	

            </td>
          </tr>
        
        </table>
        </div>    </td>
  </tr>  
  
</table>
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
            	<td align="center" ><a href="book_hotel.php?id=<?php echo $row['id']; ?>"><img src="images/booknow.png" /></a></td>
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
            	<td align="center" ><a href="searchres.php"><img src="images/back2list.png" onclick="javascript:location.href='searchres.php'"/></a></td>
            </tr>         
            </table>        	
        </div>
</div>
</body>
</html>
