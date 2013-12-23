<?php
session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
	$sql = "select * from tbl_user where id='".$_SESSION['sess_admin_id']."'";
	$rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		$rc = mysql_fetch_array($rs);
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="209" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><?php include("left_menu.inc.php");?></td>
        </tr>

      </table>
    <br />
    <br /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
			<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="top" style="width:800px;">
<table style="border-bottom:solid #CCCCCC 2px;" align="center" border="0" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td align="center"><h1 style="color:#FF3300; text-transform:uppercase;">Site Statistics</h1></td>
</tr>
</table>

<table align="center" border="0" width="470" cellpadding="5" cellspacing="2">

<tr align="center" bgcolor="#CCCCCC">
  <td colspan="2" class="txt"><strong>Last Login IP: </strong> 
  <?php echo $rc['last_login_ip'];?></td>

  </tr>
<tr align="center" bgcolor="#CCCCCC">
  <td colspan="2" class="txt"><strong>Last Login Name: </strong><?php echo $rc['user_id'];?></td>
</tr>
<tr align="center" bgcolor="#CCCCCC" >
  <td colspan="2" class="txt"><strong>Last Login Date: </strong><?php echo $rc['last_login_date'];?></td>
</tr>
</table>

<table style="padding-top:10px;" align="center" border="0" width="100%" cellpadding="0" cellspacing="0">

<tr>
	<td align="center">
	<div align="center" style=" border: solid #CCCCCC 1px">
	<h1 style="color:#666666; font-weight:400; font-family:Verdana, Arial, Helvetica, sans-serif;"> Latest Message </h1>
	<table width="100%" border="0" cellspacing="1" cellpadding="5">
  	<tr class="blueBackground">
		<th>Name</th>
		<th width="200px;">Hotel</th>

		<th width="150px;">Date</th>
		<th width="50px;">Status</th>
	  </tr>
	  	</table>
	</div>
	</td>
</tr>
</table>

</td>
          </tr>
		  
		  <tr><td>&nbsp;</td></tr>
		  <tr><td>&nbsp;</td></tr>
		  
        </table>
		</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
