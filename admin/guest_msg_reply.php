<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
validate_admin();
@extract($_REQUEST);
if ($_POST['submitForm'] == "yes")
{
  /*    
    $text = $_POST['content']; 
    $subject = $_POST['title']; 
    $from = $_POST['from']; 
    $to = $_POST['to'];
    if($_FILES[upload_file][name] && $_FILES[upload_file][size]>0)
    {
        $file = $_FILES['upload_file']['tmp_name']; 
    
        $boundary = uniqid( ""); 
        $headers = "Content-type: multipart/mixed; boundary= $boundary\r\n"; 
        $headers .= "From:$from\r\n"; 
        
        if($_FILES['upload_file']['type']) 
        $mimeType = $_FILES['upload_file']['type']; 
        else 
        $mimeType ="application/unknown"; 


        $fileName = $_FILES['upload_file']['name']; 

        $fp = fopen($file, "r"); 
        $read = fread($fp, filesize($file)); 
        $read = base64_encode($read); 
        //把这个长字符串切成由每行76个字符组成的小块 
        $read = chunk_split($read); 
        //现在我们可以建立邮件的主体 
        $body = "--$boundary 
        Content-type: text/plain; charset=iso-8859-1 
        Content-transfer-encoding: 8bit 
        $text 
        --$boundary 
        Content-type: $mimeType; name=$fileName 
        Content-disposition: attachment; filename=$fileName 
        Content-transfer-encoding: base64 
        $read 
        --$boundary--"; 
    }else
    {
			$headers = 'From: '.$from."\r\n";
			$body = $text;
    }
    
    //发送邮件 
    if(mail($to, $subject,$body,$headers)) 
    print "OK! the mail $from --- $to has been send<br>"; 
    else 
    print "fail to send mail <br>";

    exit();
   */
    $text = $_POST['content']; 
    $subject = $_POST['title']; 
    $from = $_POST['from']; 
    $to = $_POST['to'];
    
  require_once "../codelibrary/inc/class.phpmailer.php";
	$mail = new PHPMailer();
	$mail->IsSMTP(); // send via SMTP
	$mail->Mailer   = "mail"; // SMTP servers

	$mail->From     = $from;
	$mail->FromName = "";
	$mail->AddAddress($to,""); 
	//$mail->AddReplyTo($reply_to,$SITE_NAME);
	$mail->WordWrap = 50;                              // set word wrap
	$mail->IsHTML(true);                               // send as HTML
	$mail->Subject  =  $subject;
	$mail->Body     =  $text;
	if($_FILES[upload_file][name] && $_FILES[upload_file][size]>0)
	{
    if($_FILES['upload_file']['type'])
    {
      $mimeType = $_FILES['upload_file']['type']; 
      $mail->AddAttachment($_FILES['upload_file']['tmp_name'],$_FILES[upload_file][name],"base64",$mimeType);
    }
    else
    {
      $mail->AddAttachment($_FILES['upload_file']['tmp_name'],$_FILES[upload_file][name]);
    }
  }
	$mail->Send();	
	if($mail->IsError())
	{
    $_SESSION['sess_msg'] = "fail to send mail <br>";
	}else
	{
    $_SESSION['sess_msg'] = "OK! the mail $from --- $to has been send<br>";
    executeQuery("update tbl_user_msg_hotel set is_replay=1 where id='$id'"); 
  }
}
 
if($id){
	$result=executeQuery("select * from tbl_user_msg_hotel where id='$id'");
	$num=mysql_num_rows($result);
	if($line=ms_stripslashes(mysql_fetch_array($result))){
	@extract($line);
	}

}
$userinfosql=executeQuery("select * from tbl_user where id='".$_SESSION['sess_admin_id']."'");
$userinfo=mysql_fetch_array($userinfosql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ucfirst(SITE_ADMIN_TITLE);?></title>
<script src="ajax.js"></script>
<script>

function valid_form(obj)
{
	if(obj.title.value =='')
	{
		alert("Please Enter title!");
		obj.title.focus();
		return false;
	}
	else if(obj.content.value =='')
	{
    alert("Please Enter content!");
		obj.content.focus();
		return false;
	}
	else
	{
		return true;
	}
}
function changeform(reply)
{
    if(reply == true)
    {
        document.getElementById("replayform").style.display = "block";
        document.getElementById("contentform").style.display = "none";
    }
    else
    {
        document.getElementById("replayform").style.display = "none";
        document.getElementById("contentform").style.display = "block";
    }
}
</script>

<link href="codelibrary/css/style.css" rel="stylesheet" type="text/css" />
</head>
<body >
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
                      <td width="76%" height="25"><img src="images/heading_icon.gif" width="16" height="16" hspace="5">Reply Guest Message </td>
                      <td width="24%" align="right">&nbsp;</td>
                    </tr>
              </table>
			</td>
          </tr>
          <tr>
            <td height="400" align="center" valign="top"><br>
 <div id="contentform" style="display: block;">   
         <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground">Guest Message Content</TD>
				</TR>
			   <?php if($_SESSION['sess_msg']!=''){?>
				<tr>
					<td colspan="2" align="center"  class="warning"><?php print $_SESSION['sess_msg']; $_SESSION['sess_msg']='';?></td>
				</tr>
				<?php }?> 
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Name</strong></td>
					<td align="left" class="txt" ><?=$line['guest_name']?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Email</strong></td>
					<td align="left" class="txt" ><?=$line['guest_email']?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>phone</strong></td>
					<td align="left" class="txt" ><?=$line['guest_phone']?></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>Message</strong></td>
					<td align="left" class="txt" ><?=$line['guest_msg']?></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; ">&nbsp;</td>
					<td align="right" class="txt" >&nbsp;<a href="javascript:void('0')" onclick="changeform(true)">Show Reply Form</a></td>
				</tr>
				</table>
</div>
<div id="replayform" style="display: none;">
          <form method="post" enctype="multipart/form-data"  name="userfrm" onsubmit="return valid_form(this);">
			    <input type="hidden" name="submitForm" value="yes">
			    <input type="hidden" name="id" value="<?php echo $id;?>">
			    <input type="hidden" name="from" value="<?=$userinfo['email']?>">
			    <input type="hidden" name="to" value="<?=$line['guest_email']?>">
        <table width="68%" border="0" align=center cellpadding="4" cellspacing="0" class="greyBorder">
				<TR align="left" bgcolor="#4096AF"> 
					<TD height="25" colspan="2" class="blueBackground">Reply Guest Message</TD>
				</TR>
				<tr class="oddRow">
					<td class="txt" align="right" colspan="2"><span class="warning">*</span> - Required Fields</td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><span class="warning">*</span><strong>Title</strong></td>
					<td align="left" ><input type="text" size="40" name="title" value="<?=$title?>"/></td>
				</tr>
				<tr  class="oddRow">
					<td class="txt" align="right" style="padding-left:80px; "><span class="warning">*</span><strong>Content</strong></td>
					<td align="left" ><textarea name="content" cols="40" rows="6"><?=$content?></textarea></td>
				</tr>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; "><strong>File</strong></td>
					<td align="left" class="txt"><input type="file" name="upload_file" size="40"></td>
				</tr>
				<TR class="oddRow">
					<TD align=center colspan=100%><input type="submit" class="button" value="Submit"/>&nbsp;<input type="reset" name="reset" class="button" value="Reset" /></TD>
				</TR>
				<tr  class="evenRow">
					<td class="txt" align="right" style="padding-left:80px; ">&nbsp;</td>
					<td align="right" class="txt" >&nbsp;<a href="javascript:void('0')" onclick="changeform(false)">Show Message Content</a></td>
				</tr>
				</table>
				</form>
</div>
				</td>
       </tr>
	   				<TR>
					<TD align=center colspan=100%>&nbsp;</TD>
				</TR>

     </table>
	</td>
  </tr>
</table>
<?php include("footer.inc.php");?>
</body>
</html>
