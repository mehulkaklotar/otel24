<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$msg="";
if(isset($_POST['signin']))
{
	$sel = "select * from tbl_user where email='".mysql_real_escape_string($_POST['email'])."' and password='".mysql_real_escape_string($_POST['passwd'])."' and user_type='Member' and status=1";
	//echo $sel;
	$res = mysql_query($sel) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		$rowid = mysql_fetch_object($res);
		$_SESSION['userid'] = $rowid->id;?>
        <script type="text/javascript">
		parent.tb_remove();
		parent.reload();
		</script>
		<?php //header("location:index.php");
	}
	else
	{
		$msg = "Invalid login..";

	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="thickbox/thickbox.css" type="text/css" media="screen" />
<script type="text/javascript" src="thickbox/jquery-latest.js"></script>
<script type="text/javascript" src="thickbox/thickbox.js"></script>

</head>
<body>
<div id="signin_main">
<table cellspacing="4" cellpadding="4">
  <tr>
    <td class="signin1" colspan="2">OTEL 24 - Benim Hesabım</td>
  </tr>
  <tr>
    <td class="fb" colspan="2">&nbsp;</td>
  </tr>
  <tr><td width="13"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#f2f6eb">
    	<div id="signinmain" class="floatleft">
    	<div id="content" class="floatleft">
    	<table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            <form name="frmlogin" method="post" action="" >
            
            	<table border="0" cellspacing="0" cellpadding="0" >
                <tr>
                	<td><br /></td>
                </tr>
                  <tr>
                  	<tr>
                	<td><br /></td>
                </tr><td></td>
                    <td class="otel">Hesap Bilgilerinizi Giriniz,</td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center" style="color:#FF0000; height:25px;"><?php echo $msg;?></td>
                  </tr>
                  <tr>
                	<td><br /> <br /></td>
                </tr>
                  <tr><td></td>
                    <td>E-Posta Adresi<br>
						<input type="text" name="email" size="30" />                    </td>
                  </tr>
                  <tr>
                	<td><br /><br />					</td>
                </tr>
                  <tr><td></td>
                    <td>Şifre<br>
<input type="password" name="passwd" size="30" /> <a href="forgot.php">Şifremi Unuttum?</a></td>
                  </tr>
                  <tr>
                	<td><br /><br />					</td>
                </tr>
                  <tr><td></td>
                    <td><input type="submit" name="signin" value=" " class="signin">                    </td>
                  </tr>
                </table>
                </form>            </td>
          </tr>          
        </table>
        </div> 
         <div class="join1 floatleft">
            	<table  border="0" cellspacing="0" cellpadding="0" >
                  
                  <tr>
                    <td>Henüz bir hesabınız yok mu?</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><a href="register.php">Hesap Açın !</a></td>
                  </tr>
                </table>
        </div>
        </div>        </td>
  </tr>
</table>

</div>
</body>
</html>