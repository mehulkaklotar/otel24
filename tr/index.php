<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OTEL 24 - Bi Oda Lütfen...</title>
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>
<script type="text/javascript" src="keyboard.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="keyboard.css">
<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" media="screen" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="autocomplete.css">
<script type="text/javascript" src="thickbox/jquery-latest.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>
<script type="text/javascript" src="fade.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
</head>
<body class="yui-skin-sam">
<?php require_once "header.php";
?>
  <tr>
    <td class="brd">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                	<ul class="tabs">
    <li><a href="#tab1">Akıllı Arama</a></li>
    <li><a href="#tab2">Google Harita</a></li>
</ul>

<div class="tab_container">
    <div id="tab1" class="tab_content">
        <!--Content-->
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td class="searchback">
                                        
                                        <form id="frmsearch" name="frmsearch" action="" method="post">
                                        <table align="center" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td valign="top" ><input type="text" id="searchbar" name="searchbar" value="Lütfen 'Şehir' ya da 'Otel Adı' ile aratınız. " class="searchbar head2 searchbara keyboardInput input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" onkeypress="searchenter(event);"/>
<div id="container1" style="width:600px; text-align:left;"></div>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/yahoo-dom-event/yahoo-dom-event.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/datasource/datasource-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/animation/animation-min.js"></script>
<script type="text/javascript" src="http://yui.yahooapis.com/2.6.0/build/autocomplete/autocomplete-min.js"></script>
<script type="text/javascript">
<?php
$query = mysql_query("select distinct city_Turkish from city");
			if(mysql_num_rows($query) > 0) {
				$string="";
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['city_Turkish']))."\" ";
				}
				$string = substr($string,1);
			}
?>
<?php
$query = mysql_query("select distinct country_Turkish from country");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['country_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct name_Turkish from state");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['name_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct local_Turkish from local");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['local_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct village_Turkish from local");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['village_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct zipcode_Turkish from tbl_zip");
			if(mysql_num_rows($query) > 0) {
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['zipcode_Turkish']))."\" ";
				}
			}
?>
<?php
$query = mysql_query("select distinct hotel_name_Turkish  from tbl_hotel");
			
			if(mysql_num_rows($query) > 0) {
				
				while($get = mysql_fetch_array($query)) 
				{
					$string .= ", ". "\"". str_replace(")","",str_replace("(","",$get['hotel_name_Turkish']))."\" ";
				}
				
				
			}
?>
var hotel = new Array(<?php echo $string;?>);
var myDataSource = new YAHOO.util.LocalDataSource(hotel);
var myAC = new YAHOO.widget.AutoComplete("searchbar", "container1", myDataSource);
</script>
                                            
                                            </td>
                                            <td valign="top">
                                            <a id="link" onclick="javascript:submitform();" class="thickbox"><img src="images/searchbutton.png"  ></a>
                                            </td>
                                          </tr>
                                        </table>
                                        </form>
                                        
                                        </td>                                        
                                      </tr>
                                    </table>
    </div>
    <div id="tab2" class="tab_content">
       <!--Content-->
       <?php include("bymap.php");?>
    </div>
</div>
                
                
                
                	<!--<ul id="countrytabs" class="shadetabs" style="padding-left:10px;">
						<li><a href="#" rel="#default" class="selected" style="padding-left:30px; padding-right:30px;">Smart Search</a></li>
                        <li><a href="bymap.php" rel="countrycontainer" style="padding-left:30px; padding-right:30px;">By Map</a></li>

					</ul>

                    <div id="countrydivcontainer" style="border:1px solid gray; border-left:none; border-right:none; width:960px; padding:10px 0px 10px 10px;">
                                    
                    </div>             -->   </td>
              </tr>
              <tr>
                <td style="padding:10px;">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="editor">TOP 25 OTEL</td>
                        <td align="right"><a href="javascript:stepcarousel.stepBy('mygallery', -1)"><img src="images/leftarrow.png"  /></a><a href="javascript:stepcarousel.stepBy('mygallery', 1)"><img src="images/rightarrow.png"  /></a></td>
                      </tr>
                    </table>				</td>
              </tr>
              <tr>
                <td>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="stepcarousel.js"></script>
<script type="text/javascript">
function submitform()
{
	//alert("hjf");
	//document.frmsearch.submit();
	var s=document.getElementById("searchbar").value;
	//alert("searchres.php?TB_iframe=true&height=786&width=611&search="+s);
	
	document.getElementById("link").href="searchres.php?search="+s+"&TB_iframe=true&height=628&width=750";
	//location.href="searchres.php?TB_iframe=true&height=520&width=670";
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

$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

})


</script>
<style type="text/css">

.stepcarousel{
position: relative; /*leave this value alone*/
overflow: scroll; /*leave this value alone*/
width: 970px; /*Width of Carousel Viewer itself*/
height: 242px; /*Height should enough to fit largest content's height*/
}

.stepcarousel .belt{
position: absolute; /*leave this value alone*/
left: 0;
top: 0;
}

.stepcarousel .panel{
float: left; /*leave this value alone*/
overflow: hidden; /*clip content that go outside dimensions of holding panel DIV*/
width: 145px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then.
 */
 padding:10px;
 border:#d3d3d3 solid 1px;
 border-left:none;
}
</style>
<script type="text/javascript">
stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:false, moveby:1, pause:3000},
	panelbehavior: {speed:500, wraparound:false, wrapbehavior:'slide', persist:true},
	defaultbuttons: {enable: false, moveby: 1, leftnav: ['http://i34.tinypic.com/317e0s5.gif', -5, 80], rightnav: ['http://i38.tinypic.com/33o7di8.gif', -20, 80]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['ajax', 'path_to_external_file']
})
</script>

<div id="mygallery" class="stepcarousel">
<div class="belt">
<?php

$top_sql="select distinct hotel_id from tbl_online_reservation order by post_date desc limit 0,25";
$top_res=mysql_query($top_sql);
$id="";
while($top_row=mysql_fetch_array($top_res))
{
	$id.=",".$top_row['hotel_id'];
}
$id=substr($id,1);
$top_hotel_sql="select * from tbl_hotel where id in($id)";
$top_hotel_res=mysql_query($top_hotel_sql);
while($top_hotel_row=mysql_fetch_array($top_hotel_res))
{
?>
<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">
        <?php
			$city_sql="select city_English from city where id=".$top_hotel_row['city'];
			$city_res=mysql_query($city_sql);			
			if(mysql_num_rows($city_res)>0)
			{
				$city_row=mysql_fetch_array($city_res);
				echo $city_row['city_English'];
			}
			else
			{
				echo "City Unknown";
			}
		?>
        <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"/></td>
      </tr>
      <tr>
        <td class="hoteltitle"><?php echo $top_hotel_row['hotel_nam_Turkish']; ?></td>
      </tr>
      <tr>
        <td><?php 
					if($top_hotel_row['rate']=="boutique")
					{
						echo "Boutique";
					}
					else
					{
						for($i=1;$i<=$top_hotel_row['rate'];$i++)
						{
							echo "<img src='images/star1.png' height='15' width='15'>";
						}
					}
			
			 ?></td>
      </tr>
      <tr>
        <td class="hoteldesc"> <?php
			 $desc=$top_hotel_row['description'];
			 $description=substr($desc,1,15);
			 echo $description."...<a href='video_gallery.php?id=$top_hotel_row[id]&keepThis=true&TB_iframe=true&height=628&width=750' class='thickbox indexlink'>>>></a>";
			 ?></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">min. € <?php echo $top_hotel_row['prices'];?></td>
      </tr>
    </table>
</div>
<?php }?>
</div>
</div>
				</td>
              </tr>
            </table>     </td>
  </tr>
<?php
require_once("footer.php");
?>  
