<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to otel24</title>
<link rel="stylesheet" type="text/css" href="ajaxtabs/ajaxtabs.css" />
<script type="text/javascript" src="ajaxtabs/ajaxtabs.js"></script>
<script type="text/javascript" src="keyboard.js" charset="UTF-8"></script>
<link rel="stylesheet" type="text/css" href="keyboard.css">
<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" media="screen" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="thickbox/jquery-latest.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>
</head>
<body>
<?php require_once "header.php";?>
  <tr>
    <td class="brd">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                	<ul id="countrytabs" class="shadetabs" style="padding-left:10px;">
						<li><a href="#" rel="#default" class="selected" style="padding-left:30px; padding-right:30px;">Smart Search</a></li>
                        <li><a href="bymap.php" rel="countrycontainer" style="padding-left:30px; padding-right:30px;">By Map</a></li>

					</ul>

                    <div id="countrydivcontainer" style="border:1px solid gray; border-left:none; border-right:none; width:960px; padding:10px 0px 10px 10px;">
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td class="searchback">
                                        
                                        <table align="center" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td valign="top" ><input type="text" name="searchbar" value=" Country, State, City, Local, Village, Zip, Hotel" class="searchbar head2 searchbara keyboardInput" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"   /></td>
                                            <td valign="top"><input type="submit" name="search" value=" " class="search"  /></td>
                                          </tr>
                                        </table>                                        </td>
                                      </tr>
                                    </table>
                    </div>                </td>
              </tr>
              <tr>
                <td style="padding:10px;">
                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="editor">EDITOR’S PICKS</td>
                        <td align="right"><a href="javascript:stepcarousel.stepBy('mygallery', -1)"><img src="images/leftarrow.png"  /></a><a href="javascript:stepcarousel.stepBy('mygallery', 1)"><img src="images/rightarrow.png"  /></a></td>
                      </tr>
                    </table>				</td>
              </tr>
              <tr>
                <td>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="stepcarousel.js"></script>
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

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>

<div class="panel">
	<table width="139" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="citytitle">İSTANBUL <span style="font-size:7px;">>></span></td>
      </tr>
      <tr>
        <td><img src="images/image1.png"   /></td>
      </tr>
      <tr>
        <td class="hoteltitle">Hotel Calacoto</td>
      </tr>
      <tr>
        <td><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /><img src="images/star.png"  /></td>
      </tr>
      <tr>
        <td class="hoteldesc">Located opposite the green Stadtpark right on the >>></td>
      </tr>
      <tr>
        <td class="hotelprice" align="right">from € 168</td>
      </tr>
    </table>
</div>
</div>
</div>
<script type="text/javascript">
var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()
</script>				</td>
              </tr>
            </table>     </td>
  </tr>
<?php
require_once("footer.php");
?>  
