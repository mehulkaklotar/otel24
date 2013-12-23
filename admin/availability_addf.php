<?php 
session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
if($_SESSION['lang_id'])
{
	$lang_id=$_SESSION['lang_id'];
}
?>

<?php
$sql="select * from availability where hotel_id='".$_GET['id']."'";


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="fade.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<link type="text/css" rel="stylesheet" href="autocomplete.css">
<link href="dhtmlgoodies_calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="dhtmlgoodies_calendar.js">
</script>
<script>

function GetXmlHttpObject() 
  {
    var xmlhttp=null;
    try 
	{
        
        xmlhttp=new XMLHttpRequest();
    }
    catch (e) 
	{
       
        try 
		{
            xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e) 
		{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlhttp;
}

function edittype(a,b)
{
	var xmlhttp = GetXmlHttpObject();
	if(xmlhttp==null) 
	{  
       alert ("Your browser does not support AJAX!");
       return;
    }
  xmlhttp.onreadystatechange = function()
   {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
	 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
	 //alert(xmlhttp.responseText);
	}
   }				
   	var params="op=up&id="+a+"&rid="+b;
	var url ="availability_content.php";		
	xmlhttp.open("POST",url,true);
   	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");	
    xmlhttp.send(params);	
}

function room_edit_oe(a,b,e)
{
 
 	if (window.event) { e = window.event; }
        if (e.keyCode == 13)
        {    	 		
			room_edit(a,b);
 		}
		else
		{
			return;
		}      

}


function editrooms(type,id,hid,val,e)
{
	
	
	if (window.event) { e = window.event; }
			if (e.keyCode == 13)
			{    	 		
				var xmlhttp = GetXmlHttpObject();
				if(xmlhttp==null) 
				{  
				   alert ("Your browser does not support AJAX!");
				   return;
				}
			  xmlhttp.onreadystatechange = function()
			   {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
				 //alert(xmlhttp.responseText);
				}
			   }		
			  	
				var params="op=edit&id="+hid+"&rid="+id+"&type="+type+"&val="+val;
				//alert(params);
				var url ="availability_edit.php";		
				xmlhttp.open("POST",url,true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader("Content-length", params.length);
				xmlhttp.setRequestHeader("Connection", "close");	
				xmlhttp.send(params);	
			}
			else
			{
				return;
			}      

}

function room_edit(a,b)
{

var xmlhttp = GetXmlHttpObject();
	if(xmlhttp==null) 
	{  
       alert ("Your browser does not support AJAX!");
       return;
    }
  xmlhttp.onreadystatechange = function()
   {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
	 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
	 //alert(xmlhttp.responseText);
	}
   }		
   var rt=document.getElementById("txtup").value;	
   	//alert(rt);	
   	var params="op=edit&id="+a+"&rid="+b+"&rt="+rt;
	var url ="availability_edit.php";		
	xmlhttp.open("POST",url,true);
   	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");	
    xmlhttp.send(params);	
}

function editprice(type,id,hid,val,e)
{
	if (window.event) { e = window.event; }
			if (e.keyCode == 13)
			{    	 		
				var xmlhttp = GetXmlHttpObject();
				if(xmlhttp==null) 
				{  
				   alert ("Your browser does not support AJAX!");
				   return;
				}
			  xmlhttp.onreadystatechange = function()
			   {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
				 //alert(xmlhttp.responseText);
				}
			   }		
			  	
				var params="op=edit&id="+hid+"&rid="+id+"&type="+type+"&val="+val;
				//alert(params);
				var url ="availability_edit.php";		
				xmlhttp.open("POST",url,true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader("Content-length", params.length);
				xmlhttp.setRequestHeader("Connection", "close");	
				xmlhttp.send(params);	
			}
			else
			{
				return;
			}      

}

function editcindate(type,id,hid,val)
{
	/*if (window.event) { e = window.event; }
			if (e.keyCode == 13)
			{ */   	 		
				var xmlhttp = GetXmlHttpObject();
				if(xmlhttp==null) 
				{  
				   alert ("Your browser does not support AJAX!");
				   return;
				}
			  xmlhttp.onreadystatechange = function()
			   {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
				 //alert(xmlhttp.responseText);
				}
			   }		
			  	
				var params="op=edit&id="+hid+"&rid="+id+"&type="+type+"&val="+val;
				//alert(params);
				var url ="availability_edit.php";		
				xmlhttp.open("POST",url,true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader("Content-length", params.length);
				xmlhttp.setRequestHeader("Connection", "close");	
				xmlhttp.send(params);	
		/*	}
			else
			{
				return;
			}*/     

}


function editcoutdate(type,id,hid,val)
{

	/*if (window.event) { e = window.event; }
			if (e.keyCode == 13)
			{   */ 	 		
				var xmlhttp = GetXmlHttpObject();
				if(xmlhttp==null) 
				{  
				   alert ("Your browser does not support AJAX!");
				   return;
				}
			  xmlhttp.onreadystatechange = function()
			   {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
				 //alert(xmlhttp.responseText);
				}
			   }		
				var params="op=edit&id="+hid+"&rid="+id+"&type="+type+"&val="+val;
				//alert(params);
				var url ="availability_edit.php";		
				xmlhttp.open("POST",url,true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader("Content-length", params.length);
				xmlhttp.setRequestHeader("Connection", "close");	
				xmlhttp.send(params);	
			/*}
			else
			{
				return;
			} */     

}

function editcurr(type,id,hid,val)
{

	/*if (window.event) { e = window.event; }
			if (e.keyCode == 13)
			{   */ 	 	
				var xmlhttp = GetXmlHttpObject();
				if(xmlhttp==null) 
				{  
				   alert ("Your browser does not support AJAX!");
				   return;
				}
			  xmlhttp.onreadystatechange = function()
			   {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
				 //alert(xmlhttp.responseText);
				}
			   }		
				var params="op=edit&id="+hid+"&rid="+id+"&type="+type+"&val="+val;
				//alert(params);
				var url ="availability_edit.php";		
				xmlhttp.open("POST",url,true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader("Content-length", params.length);
				xmlhttp.setRequestHeader("Connection", "close");	
				xmlhttp.send(params);	
			/*}
			else
			{
				return;
			} */     

}

function editprice(type,id,hid,val,e)
{
	if (window.event) { e = window.event; }
			if (e.keyCode == 13)
			{    	 		
				var xmlhttp = GetXmlHttpObject();
				if(xmlhttp==null) 
				{  
				   alert ("Your browser does not support AJAX!");
				   return;
				}
			  xmlhttp.onreadystatechange = function()
			   {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
				 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
				 //alert(xmlhttp.responseText);
				}
			   }		
			  	
				var params="op=edit&id="+hid+"&rid="+id+"&type="+type+"&val="+val;
				//alert(params);
				var url ="availability_edit.php";		
				xmlhttp.open("POST",url,true);
				xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlhttp.setRequestHeader("Content-length", params.length);
				xmlhttp.setRequestHeader("Connection", "close");	
				xmlhttp.send(params);	
			}
			else
			{
				return;
			}      

}





function addrtype(hotelid)
{

var xmlhttp = GetXmlHttpObject();
	if(xmlhttp==null) 
	{  
       alert ("Your browser does not support AJAX!");
       return;
    }
  xmlhttp.onreadystatechange = function()
   {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
	 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
	 //alert(xmlhttp.responseText);
	}
   }		
   
   	var params="op=add&hotelid="+hotelid;
	var url ="roomtype_addf.php";		
	xmlhttp.open("POST",url,true);
   	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");	
    xmlhttp.send(params);	
}


function insertrt(hid)
{

var xmlhttp = GetXmlHttpObject();
	if(xmlhttp==null) 
	{  
       alert ("Your browser does not support AJAX!");
       return;
    }
  xmlhttp.onreadystatechange = function()
   {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
	{
	 document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
	 //alert(xmlhttp.responseText);
	}
   }
   var roomtype1=document.getElementById("rt1").value;
   var roomtype=document.getElementById("rt").value;
      var rooms=document.getElementById("rooms").value;
	     var cindate=document.getElementById("cindate").value;
		    var coutdate=document.getElementById("coutdate").value;
			   var price=document.getElementById("price").value;
			    
		if(roomtype1=="" && roomtype=="")
		{
			 document.getElementById("rt1").focus();
			 alert("Select Room Type");
			 return;
		}
		else if(roomtype1!="" && roomtype!="")
		{
			 
			 	document.getElementById("rt").focus();
			  alert("Both Room Type Not Allowed");
				 return;
			 
			
		}
		
		else if(rooms=="")
		{
		     //alert("Please enter country Name...!");
			 document.getElementById("rooms").focus();
			 //document.getElementById("d_rooms").innerHTML="*";
			 alert("Enter No Of Rooms");
			 return;
		
		}	
		else if(cindate=="")
		{
		     //alert("Please enter country Name...!");
			 document.getElementById("cindate").focus();
			// document.getElementById("d_cindate").innerHTML="*";
			alert("Enter Check In Date");
			 return;
		
		}	
		else if(coutdate=="")
		{
		     //alert("Please enter country Name...!");
			 document.getElementById("coutdate").focus();
			 //document.getElementById("d_coutdate").innerHTML="*";
			 alert("Enter Check out Date");
			 return;
		
		}	
		else if(price=="")
		{
		     //alert("Please enter country Name...!");
			 document.getElementById("price").focus();
			// document.getElementById("d_price").innerHTML="*";
			alert("Enter Price");
			 return;
		
		}	
   		else
		{
			var params="op=insert&roomtype="+roomtype+"&roomtype1="+roomtype1+"&rooms="+rooms+"&cindate="+cindate+"&coutdate="+coutdate+"&price="+price+"&id="+hid;
			var url ="availability_edit.php";
		}
		//alert(params);
   			
	xmlhttp.open("POST",url,true);
   	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");	
    xmlhttp.send(params);	
}

function checkall()
{
	
	total_ids=document.getElementById("total_ids").value;
	total_ids=total_ids.split(",");
	
	var objname;

	for(i=0;i<=total_ids.length-1;i++)
	{
		
			objname="document.getElementById('C1_" + total_ids[i] + "').checked=true";
			if(objname != "document.getElementById('C1_0').checked=true")
			{
				eval(objname); //is used to execute dynamic javascript code
			}
		
	}
}

function checknone()
{
	total_ids=document.getElementById("total_ids").value;
	total_ids=total_ids.split(",");
	
	var objname;

	for(i=0;i<=total_ids.length-1;i++)
	{

			objname="document.getElementById('C1_" + total_ids[i] + "').checked=false";
			if(objname != "document.getElementById('C1_0').checked=false")
			{	
				eval(objname); //is used to execute dynamic javascript code
			}
	}
}

function mdelete(id)
 {
 
   var md=document.getElementById("total_ids").value;
	md=md.split(",");
  var xmlhttp;
  if(window.XMLHttpRequest)
  {
    xmlhttp = new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function()
  {
    if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
     {
	   document.getElementById("avaltable").innerHTML = xmlhttp.responseText;
	 }
   } 
   
   var id_delete="";
   for(var i=1;i<=md.length-1;i++)
   {
     if(eval("document.getElementById('C1_"+md[i]+"').checked==true"))
	  {		
	   id_delete  += "," + md[i] ;
	  }
    }
	
	if(id_delete == "")
	{
	  alert("Please select atleast one record to delete!");
	  return;
	}
   else
   {
    var con = confirm("Are u sure u want to delete?");
    if (con == true)
    {    
    
	 var url = "availability_edit.php?op=delete&id_delete="+id_delete+"&id="+id;
	 //alert(url);
    }
	else
	{
	  return checknone();
	}
   
   }
   xmlhttp.open("GET",url,true);
   xmlhttp.send();
  
  }



</script>
</head>
<body class="yui-skin-sam">
<?php include("header.inc.php");?>

<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?php include("left_menu.inc.php");?></td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
      
    <br />
    <br /></td>
   <td width="1" bgcolor="#398FA8"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
    
    <table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr bgcolor="#EDEDED">
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Oda Satış Yönetimi </td>
                      <td width="8%" align="right">
					  <input name="b1" type="button" class="button" id="b1" value="Ana Sayfa" onClick="location.href='availability_list.php'">
                      &nbsp;</td>
                      <td width="8%" align="right"><input name="b2" type="button" class="button" id="b2" value="Oda Satış Ekle" onClick="addrtype(<?php echo $_REQUEST['id']; ?>);">
                      &nbsp;</td>
                      

                    </tr>
              </table>
              
			</td>
          </tr>
     </table>
    
    	<form name="availability" method="post" action="" enctype="multipart/form-data">
    	<div class="avaltable" id="avaltable">
        <?php include("availability_content.php"); ?>
       
		</div>
        </form>
         </td>
       </tr>
     </table>
	</td>
	<td width="20" valign="top" bgcolor="#EDEDED">&nbsp;</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
