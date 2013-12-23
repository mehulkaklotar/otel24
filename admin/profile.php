<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();?>
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
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td width="1"><img src="images/spacer.gif" width="1" height="1" /></td>
    <td height="400" align="center" valign="top">
		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td height="21" align="left" class="txt">
				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="title">
                    <tr>
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Hesap Bilgileri ( <?php echo $_COOKIE['sess_username'];?> )</td>
                      <td width="24%" align="right"></td>
                    </tr>
              </table>
			</td>
          </tr>
		  <?php 
$sql=executeQuery("select * from tbl_user where id='".$_SESSION['sess_admin_id']."'");
$line=mysql_fetch_array($sql);?>
          <tr>
            <td height="400" align="center" valign="top"><br>
              <table width="98%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                  <td width="23%" align="left" valign="top" class="txt"><strong>Kullanıcı ID</strong></td>
				  <td width="77%" align="left" valign="top"class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $line['user_id'];?></td>
                </tr>
				<tr>
                  <td align="left" valign="top"  class="txt"><strong>Adı Soyadı</strong></td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $line['full_name']; ?></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt" ><strong>E-Posta</strong></td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:<?php echo $line['email']; ?>" class="orangetxt"><?php echo $line['email']; ?></a></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt">&nbsp;</td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $line['contact_info']; ?></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt"><strong>Statü</strong></td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php if($line['status']==1){ echo "Active";}else{ echo 'Inactive';} ?></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt"><strong>Kullanıcı Tipi</strong></td>
				  <td align="left" valign="top"class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords($line['user_type']); ?></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt"><strong>Son Giriş Tarihi</strong></td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $line['last_login_date']; ?></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt"><strong>Son IP Bilgisi</strong></td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $line['last_login_ip']; ?></td>
                </tr>
				<tr>
                  <td align="left" valign="top" class="txt"><strong>Toplam Giriş Sayısı</strong></td>
				  <td align="left" valign="top" class="txt">:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $line['total_loged_in'] ?></td>
                </tr>
			   <tr align="center">
                 <td></td>
               </tr>
               <tr align="center">
                 <td>&nbsp;</td>
               </tr>
            </table>
         </td>
       </tr>
     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>