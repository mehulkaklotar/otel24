<?php
include_once("../codelibrary/inc/functions.php");
include_once("../codelibrary/inc/variables.php");
$user=$_REQUEST['id'];
mysql_query("update tbl_user set status=1 where user_id='$user'") or die("hello");
$sql=mysql_query("select * from tbl_user where user_id='$user'");
$res=mysql_fetch_array($sql);
$subject="Hesabınız başarıyla aktif edildi. Kutlarız!";
			$msg="Merhaba,
			<br />Kullanıcı ID '".$res['user_id']."'"."
		 	<br /> Teşekkür Ederiz,
			<br />OTEL 24 Akıllı Rehber, Rezervasyon ve Oda Satış sistemi için hesap kurulum işlemleriniz tamamladı. İyi bir oda dileriz.  
			<br />
			<br />Saygılarımızla,
			<br />OTEL 24";
			$to=$res['email'];
			$from="noreply@otel.com.tr";
			
// To send HTML mail, the Content-type header must be set			
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: ' . $from . "\r\n" .
						'Reply-To: ' . $from . "\r\n" .
					  'X-Mailer: PHP/' . phpversion();
			@mail($to, $subject, $msg, $headers);
			header("location:index.php");
?>