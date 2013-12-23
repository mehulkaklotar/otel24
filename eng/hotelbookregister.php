<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$msg="";
//echo "hjdfg";
if(isset($_POST['signup']))
{
	//echo "hello";
	if($_POST['txtuname']=="" || $_POST['txtpass']=="" || $_POST['txtemail']=="" || $_POST['txtname']=="")
	{
		$msg ="The fields can't be left blank...";
		//echo $msg;
	}
	else
	{
		$sel = "select * from tbl_user where email='".$_POST['txtemail']."' or user_id='".$_POST['txtuname']."' and user_type='Member'";
		$res = mysql_query($sel) or die(mysql_error());
		if(mysql_num_rows($res) > 0)
		{
			$msg = "Email address or User ID already exist.. please choose another or contact us.";
		}
		else
		{
			$insert = "insert into tbl_user set user_id='$_POST[txtuname]',password='$_POST[txtpass]',full_name='$_POST[txtname]',email='$_POST[txtemail]',user_type='Member',status=0,post_date=now()";
			mysql_query($insert) or die(mysql_error());
			$subject="Email Activation";
			$msg="Hello,<br>Your Username is '".$_POST['txtuname']."' and Password is '".$_POST['txtpass']."'. <br> Click Here to <a href='http://www.otel24.com.tr/eng/activate.php?id=".$_POST['txtuname']."'>Activate</a> your Account.<br><br>Regards,<br>OTEL24";
			$to=$_POST['txtemail'];
			$from="noreply@otel.com";
	
	// To send HTML mail, the Content-type header must be set			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" .
					  'X-Mailer: PHP/' . phpversion();
					  
			@mail($to, $subject, $msg, $headers);
			echo "<script>location.href='thanks.php?id=$_POST[id]';</script>";
		}
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
$hotel_name=$row['hotel_name'];
?>
<body>
<div id="bookregister">
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
    	<div class="floatleft">
        <form name="frmsignup" action="" method="post">
        <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" />
    	<table cellpadding="2" class="second">
        	<tr>
            	<td colspan="2" style="color:#FF0000; height:25px;" align="center"><?php echo $msg;?></td>
            </tr>
        	<tr>
            	<td>Email Address</td>
            </tr>
            <tr>
            	<td><input type="text" name="txtemail" id="txtemail"/></td>
            </tr>
            <tr>
            	<td>Full Name</td>
            </tr>
            <tr>
            	<td><input type="text" name="txtname" id="txtname"/></td>
            </tr>
            <tr>
            	<td>Pick a screen Name (User Id)</td>
            </tr>
            <tr>
            	<td><input type="text" name="txtuname" id="txtuname"/></td>
            </tr>
            <tr>
            	<td>Choose Your Password</td>
            </tr>
            <tr>
            	<td><input type="password" name="txtpass" id="txtpass"/></td>
            </tr>
            <tr>
            	<td><input type="submit" name="signup" value=" " class="signup"></td>
            </tr>
        </table>
        </form>
        </div>
        <div class="floatleft">
        <table class="second" cellpadding="1">
        	<tr>
            	<td class="oops">Oppss!</td>
            </tr>
            <tr>
            	<td class="secure">First you need get a PayPal ID<br /> to create a OTEL24 Booking Account</td>
            </tr>
            <tr>
            	<td><img src="images/image2.png" /><img src="images/paypal.png" /></td>
            </tr>            
                 <td align="center">&nbsp;</td>
  			</tr>
        </table>
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
            	<td align="center" ><a href="searchres.php"><img src="images/back2list.png" /></a></td>
            </tr>         
            </table>        	
        </div>
</div>
</body>
</html>
