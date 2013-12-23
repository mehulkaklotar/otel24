<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
<script src="../codelibrary/js/script_tmt_validator.js" type="text/javascript"></script>
</head>
<body onload="javascript:document.frm.new_email.focus()">
<?php include("header.inc.php");?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="180" valign="top" class="rightBorder">
      <table width="100%"  border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center">
          <select name="a">
          <?php
		  $sel = "select * from testing order by a asc";
		  $res = mysql_query($sel) or die(mysql_error());
		  while($row = mysql_fetch_object($res))
		  {
		  ?>
          <option value="<?php echo $row->a;?>"><?php echo $row->a;?></option>
          <?php
		  }
		  ?>
          </select>
          </td>
        </tr>
        <tr>
          <td width="23">&nbsp;</td>
        </tr>
      </table>
   </td>
  </tr>
</table>
</body>
</html>
