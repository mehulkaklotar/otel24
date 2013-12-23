<?php
session_start();
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$msg="";
if(isset($_POST['signup']))
{
	if($_POST['userid']=="" || $_POST['passwd']=="" || $_POST['email']=="" || $_POST['fname']=="")
	{
		$msg ="The fields can't be left blank...";
	}
	else
	{
		$sel = "select * from tbl_user where email='".$_POST['email']."' or user_id='".$_POST['userid']."' and user_type='Member'";
		$res = mysql_query($sel) or die(mysql_error());
		if(mysql_num_rows($res) > 0)
		{
			$msg = "Email address or User ID already exist.. please choose another or contact us.";
		}
		else
		{
			$insert = "insert into tbl_user set user_id='$_POST[userid]',password='$_POST[passwd]',full_name='$_POST[fname]',email='$_POST[email]',user_type='Member',status=0,post_date=now()";
			mysql_query($insert) or die(mysql_error());
			$subject="Email Activation";
			$msg="Hello,<br>Your Username is '".$_POST['userid']."' and Password is '".$_POST['passwd']."'. <br> Click Here to <a href='http://www.otel24.com.tr/eng/activate.php?id=".$_POST['userid']."'>Activate</a> your Account.<br><br>Regards,<br>OTEL24";
			$to=$_POST['email'];
			$from="noreply@otel.com";
	
	// To send HTML mail, the Content-type header must be set			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" .
					  'X-Mailer: PHP/' . phpversion();
					  
			@mail($to, $subject, $msg, $headers);
			echo "<script>location.href='thanks.php';</script>";
	}
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
<div id="signup_main">
<table  border="0" cellspacing="4" cellpadding="4">
  <tr>
    <td  class="signin1" colspan="2">Sign in to Otel24 </td>
  </tr>
  <tr>
    <td class="fb" colspan="2">&nbsp;</td>
  </tr>
  <tr><td></td>
    <td >&nbsp;</td>
  </tr>
 
  <tr>
 
    <td bgcolor="#f2f6eb" colspan="2">
     <div id="signupmain">
    	<table  border="0" cellspacing="0" cellpadding="0" width="100%" style="padding-top:20px;">
         <tr>
                    	<td colspan="2" class="otel" >Sign in to your Otel24 account </td>
                  </tr>   
        <tr>
               <td colspan="2" style="color:#FF0000; height:25px;" align="center"><?php echo $msg;?></td>
          </tr>
          <tr>          
            <td >
            	
                <form name="frmregister" method="post" action="" > 
                <table  border="0" cellspacing="0" cellpadding="0">                                
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><td></td>
                    <td>Email address<br>
<input type="text" name="email" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><td></td>
                    <td>Full name<br>
<input type="text" name="fname" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><td></td>
                    <td>Pick a screen name(User id)<br>
<input type="text" name="userid" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><td></td>
                    <td>Choose your password<br>
<input type="password" name="passwd" size="30" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  
                  <tr><td></td>
                    <td><!--<input type="submit" name="signup" value="Sign in" >-->
                   <input type="submit" name="signup" value=" " class="signup">                    </td>
                  </tr>
                </table>            
                </form>            </td>
            <td align="left">
            	<div class="joinsignup">
            	<table border="0" cellspacing="0" cellpadding="0">
                  <tr><td></td>
                    <td>Already a Otel24 member?</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr><td></td>
                    <td><a href="signin.php">Sign in</a></td>
                  </tr>
                </table>
                </div>            </td>
          </tr>
        </table>  </div>      </td>
  </tr>
</table>
</div>
</body>
</html>