<?php 
include("../codelibrary/inc/functions.php");
include("../codelibrary/inc/variables.php");

$search=$_REQUEST['search'];
if((!isset($_SESSION['search'])) || isset($_REQUEST['search']))
{
	$_SESSION['search']=$search;
}
$search=$_SESSION['search'];
$id="";
$hotel1_sql="select id from tbl_hotel where hotel_name like '%".$search."%'";

$hotel1_res=mysql_query($hotel1_sql);
while($hotel1_row=mysql_fetch_array($hotel1_res))
{
	$id.=",".$hotel1_row['id'];
}
			
$country_sql="select h.id as hotel_id,c.country_English from tbl_hotel h ,country c where h.country=c.country_id and country_English like '%".$search."%'";

$country_res=mysql_query($country_sql);
while($country_row=mysql_fetch_array($country_res))
{
	$id.=",".$country_row['hotel_id'];
}
$state_sql="select h.id as hotel_id,s.name_English from tbl_hotel h ,state s where h.state=s.id and name_English like '%".$search."%'";

$state_res=mysql_query($state_sql);
while($state_row=mysql_fetch_array($state_res))
{
	$id.=",".$state_row['hotel_id'];
}
$city_sql="select h.id as hotel_id,ci.city_English from tbl_hotel h ,city ci where h.city=ci.id and city_English like '%".$search."%'";

$city_res=mysql_query($city_sql);
while($city_row=mysql_fetch_array($city_res))
{
	$id.=",".$city_row['hotel_id'];
}
$local_sql="select h.id as hotel_id,l.local_English from tbl_hotel h ,local l where h.local=l.id and local_English like '%".$search."%'";

$local_res=mysql_query($local_sql);
while($local_row=mysql_fetch_array($local_res))
{
	$id.=",".$local_row['hotel_id'];
}
$village_sql="select h.id as hotel_id,v.village_English from tbl_hotel h ,village v where h.village=v.id and village_English like '%".$search."%'";

$village_res=mysql_query($village_sql);
while($village_row=mysql_fetch_array($village_res))
{
	$id.=",".$village_row['hotel_id'];
}
$zipcode_sql="select h.id as hotel_id,z.zipcode_English from tbl_hotel h ,tbl_zip z where h.zipcode=z.zipcode_id and zipcode_English like '%".$search."%'";

$zipcode_res=mysql_query($zipcode_sql);
while($zipcode_row=mysql_fetch_array($zipcode_res))
{
	$id.=",".$zipcode_row['hotel_id'];
}
	//echo $id;
$id=substr($id,1);
$by="";
if(isset($_REQUEST['by']))
{
	$by=$_REQUEST['by'];
	if($by=="city")
	{
		$sql="select h.* from tbl_hotel h,city c where h.id in($id) and h.city=c.id order by c.city_Turkish asc";
		$res=mysql_query($sql);
	}
	else if($by=="rooms")
	{
		$aval_sql="select hotel_id,sum(rooms) as trooms from availability where hotel_id in($id) group by hotel_id order by trooms desc";
		$aval_res=mysql_query($aval_sql);
		$aval_id="";
		while($aval_row=mysql_fetch_array($aval_res))
		{
			$aval_id.=",".$aval_row['hotel_id'];
		}		
		$aval_id=substr($aval_id,1);
		$a1="select *  from tbl_hotel where id in($id) and id not in($aval_id)";
		$a1_res=mysql_query($a1);
		while($a1_row=mysql_fetch_array($a1_res))
		{
			$aval_id.=",".$a1_row['id'];
		}		
		$aval_id=explode(",",$aval_id);
		//print_r($aval_id);
	}
	
	else
	{
		$sql="select * from tbl_hotel where id in($id) order by $by asc";
		$res=mysql_query($sql);
	}
}
else
{
	$sql="select * from tbl_hotel where id in($id)";
	$res=mysql_query($sql);
}

//echo $sql;
$res=mysql_query($sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" media="screen" />
<link type="text/css" rel="stylesheet" href="autocomplete.css">
<script type="text/javascript" src="keyboard.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="keyboard.css">
</head>

<body class="yui-skin-sam">


<div id="hotelmain">
<div id="sort">
<form id="frmsearch" name="frmsearch" action="" method="post">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td valign="top" ><input type="text" id="searchbar" name="searchbar" value="" class="searchbar1 head2 searchbara1 keyboardInput input"  onkeypress="searchenter(event);"/>
<div id="container1" style="width:300px; text-align:left;"></div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<?php
$query = mysql_query("select distinct city_English  from city");
			
			if(mysql_num_rows($query) > 0) {
				$string="";
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['city_English']))."\" ";
				}
				
				$string = substr($string,1);
			}
?>
<?php
$query = mysql_query("select distinct country_English  from country");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['country_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct name_English  from state");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['name_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct local_English  from local");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['local_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct village_English  from village");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['village_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct zipcode_English  from tbl_zip");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['zipcode_English']))."\" ";
				}
				
				
			}
?>
<?php
$query = mysql_query("select distinct hotel_name from tbl_hotel");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['hotel_name']))."\" ";
				}
			}
?>
var hotel = new Array(<?php echo $string;?>);
var myDataSource = new YAHOO.util.LocalDataSource(hotel);
var myAC = new YAHOO.widget.AutoComplete("searchbar", "container1", myDataSource);
</script>
                                            
                                            </td>
                                            <td valign="top">
                                            <a id="link" onclick="javascript:submitform();"><img src="images/searchbutton.png"  ></a>
                                            </td>
                                            <td></td>
                                            <td>
                                            <a href="searchres.php?by=prices">PRICE</a>
                                            <a href="searchres.php?by=rooms">ROOMS</a>
                                            <a href="searchres.php?by=rate">RATE</a>
                                            <a href="searchres.php?by=hotel_name">NAMES</a>
                                            <a href="searchres.php?by=city">CITY</a>
                                            </td>
                                            <td>
                                            	| <a href="../tr/searchres.php" ><img src="images/turkey.jpg"  /></a> | <a href="searchres.php"><img src="images/eng.png"  /></a>
                                            </td>
                                          </tr>
                                        </table>
                                        </form>
                                        
<script type="text/javascript">
function submitform()
{
	//alert("hjf");
	var s=document.getElementById("searchbar").value;
	document.getElementById("link").href="searchres.php?search="+s;
}

function fireEvent(obj, evt) 
{ 

	var fireOnThis = obj;
	if (document.createEvent) 
	{ //    alert("FF"); 
		var evtObj = document.createEvent('MouseEvents');  
		evtObj.initEvent(evt, true, false);   
		fireOnThis.dispatchEvent(evtObj);
	}
	else if (document.createEventObject) 
	{    // alert("IE");  
	     var evtObj = document.createEventObject();   
		 fireOnThis.fireEvent('on'+evt, evtObj);
	}
}

function searchenter(e)
{
	if (window.event) { e = window.event; }
        if (e.keyCode == 13)
        {    	 		
			fireEvent(document.getElementById("link"),'click');
 		}
		else
		{
			return;
		}      
}

</script>


</div>
 <?php
 if(isset($_REQUEST['by']) && $_REQUEST['by']=="rooms")
{
	for($j=0;$j<count($aval_id);$j++)
	{
		$sql="select * from tbl_hotel where id=".$aval_id[$j];
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		//echo $sql;
		?>
 		<div id="hotel1" class="floatleft">
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
            <?php echo $row['hotel_name'];?>
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
    </div>
		<div class="image2 floatleft">
        	<table>
            <tr>
            	<td height="25">
                </td>
            </tr>
            <tr>
            	<td class="avalhead" nowrap="nowrap" align="left">Room Availability</td>
            </tr>
            <tr>
            	<td class="avalvalue" nowrap="nowrap" align="left">Last (<font color="#FF0000">
                <?php 
				$room=0;
				$sql1=mysql_query("select * from availability where hotel_id=".$row['id']);
				
				while($res1=mysql_fetch_array($sql1))
				{
					$room+=$res1['rooms'];
				}
				echo $room;
				?>
                </font>) Rooms</td>
            </tr>
            <tr>
            	<td align="center" ><a href="book_hotel.php?id=<?php echo $row['id']?>"><img src="images/booknow.png" /></a></td>
            </tr>
            <tr height="4">
            </tr>
            <tr>
            	<td align="left"><img src="images/image.png" /></td>
            </tr>  
            <tr height="4">
            </tr>              
            </table>        	
        </div>
<div id="footerbar">
    <img src="images/line.png" />
</div>

<?php	}
}
else
{
 
 
if(mysql_num_rows($res)>0)
{

while($row=mysql_fetch_array($res))
{
?>
<div id="hotel1" class="floatleft">
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
            <?php echo $row['hotel_name'];?>
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
    </div>
		<div class="image2 floatleft">
        	<table>
            <tr>
            	<td height="25">
                </td>
            </tr>
            <tr>
            	<td class="avalhead" nowrap="nowrap" align="left">Room Availability</td>
            </tr>
            <tr>
            	<td class="avalvalue" nowrap="nowrap" align="left">Last (<font color="#FF0000">
                <?php 
				$room=0;
				$sql1=mysql_query("select * from availability where hotel_id=".$row['id']);
				
				while($res1=mysql_fetch_array($sql1))
				{
					$room+=$res1['rooms'];
				}
				echo $room;
				?>
                </font>) Rooms</td>
            </tr>
            <tr>
            	<td align="center" ><a href="book_hotel.php?id=<?php echo $row['id']?>"><img src="images/booknow.png" /></a></td>
            </tr>
            <tr height="4">
            </tr>
            <tr>
            	<td align="left"><img src="images/image.png" /></td>
            </tr>  
            <tr height="4">
            </tr>              
            </table>        	
        </div>
<div id="footerbar">
    <img src="images/line.png" />
</div>
<?php }
}
else
{
	echo "<center><strong><h2>No Hotels Found...</h2></strong></center>";
}
}
?>
</div>

</body>
</html>
