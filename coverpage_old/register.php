<?php
require_once("../codelibrary/inc/variables.php");
if(isset($_POST['signup']))
{
	$sel = "select * from tbl_user where email='".$_POST['email']."' and user_type='Member'";
	$res = mysql_query($sel) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		$msg = "Email address already exist.. please choose another or contact us.";
	}
	else
	{
		$insert = "insert into tbl_user set user_id='$_POST[userid]',password='$_POST[passwd]',full_name='$_POST[fname]',email='$_POST[email]',user_type='Member',status=1,post_date=now()";
		mysql_query($insert) or die(mysql_error());
		echo "<script>location.href='signin.php';</script>";
	}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" style="padding-left:20px; padding-right:20px;" border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td>Sign in to Otel24 </td>
  </tr>
  <tr>
    <td>Sign in using your Facebook account</td>
  </tr>
  <tr>
    <td><img src="images/facebook.png"  /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            	<form name="frmregister" method="post" action="" > 
                
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>...or sign in to your Otel24 account </td>
                  </tr>
                  <tr>
                    <td><?php echo $msg;?></td>
                  </tr>
                  <tr>
                    <td>Email address<br>
<input type="text" name="email" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Full name<br>
<input type="text" name="fname" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Pick a screen name(User id)<br>
<input type="text" name="userid" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Choose your password<br>
<input type="password" name="passwd" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  
                  <tr>
                    <td><input type="submit" name="signup" value="Sign in" ></td>
                  </tr>
                </table>            
                </form>
                </td>
            <td>
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>Already a Otel24 member?</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><a href="signin.php">Sign in</a></td>
                  </tr>
                </table>

            </td>
          </tr>
        </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
</body>
</html>