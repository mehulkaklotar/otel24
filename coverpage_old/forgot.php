<?php
require_once("../codelibrary/inc/variables.php");
if(isset($_POST['fpasswrd']))
{
	$sel = "select * from tbl_user where email='".$_POST['email']."' and user_type='Member'";
	$res = mysql_query($sel) or die(mysql_error());
	if(mysql_num_rows($res) > 0)
	{
		$row = mysql_fetch_object($res);
		$to = $_POST['email'];
		$subject = 'Otel24.com forgot password request';
		$msg = "Below are the details of it: \n\n";
		$msg .="Email: $_POST[email] \n";
		$msg .="User id: $row->user_id \n";
		$msg .="Password: $row->password \n";
		
		$msg .="Regards, \nOtel24.com team.";
		$email = "noreply@otel24.com";
		$headers = 'From: ' . $email . "\r\n" .
					'Reply-To: ' . $email . "\r\n" .
				  'X-Mailer: PHP/' . phpversion();
		 
		@mail($to, $subject, $msg, $headers);
		$msg = "Password successfully sent your email address.";
		
	}
	else
	{
		$msg = "Email address doesnt exist in our records.";
		
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
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            	<form name="frmregister" method="post" action="" > 
                
            	<table width="100%" border="0" cellspacing="4" cellpadding="4">
                  <tr>
                    <td>Forgot your Password</td>
                  </tr>
                  <tr>
                    <td>We will send email to reset it.</td>
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
                    <td><input type="submit" name="fpasswrd" value="Submit" >&nbsp;<input type="button" name="back" value="Back" onclick="javascript:location.href=='signin.php';"  /></td>
                  </tr>
                </table>            
                </form>            </td>
          </tr>
        </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>