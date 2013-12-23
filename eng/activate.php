<?php
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$user=$_REQUEST['id'];
mysql_query("update tbl_user set status=1 where user_id='$user'") or die("hello");
$sql=mysql_query("select * from tbl_user where user_id='$user'");
$res=mysql_fetch_array($sql);
$subject="Activated Successfully";
			$msg="Hello,
			<br />Your Username is '".$res['user_id']."'"."
		 	<br /> THANK YOU,
			<br />YOU HAVE SUCCESSFULLY REGISTERED AS A MEMBER OF OTEL24.COM.TR 
			<br />
			<br />Regards,
			<br />OTEL24";
			$to=$res['email'];
			$from="noreply@otel.com";
			
// To send HTML mail, the Content-type header must be set			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" .
					  'X-Mailer: PHP/' . phpversion();
			@mail($to, $subject, $msg, $headers);
			header("location:index.php");
?>