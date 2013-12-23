<?php
require_once("../codelibrary/inc/variables.php");
session_unregister("sess_msg");
session_unregister("sess_admin_id");
session_unregister("sess_username");

$_COOKIE['sess_admin_id']="";
$_COOKIE['sess_username']="";
$_COOKIE['sess_type']="";
$_COOKIE['sess_email']="";
$_COOKIE['sess_phone']="";

setcookie("sess_admin_id", "", time()-3600*24);

setcookie("sess_username","", time()-3600*24);

setcookie("sess_type", "", time()-3600*24);

setcookie("sess_email","", time()-3600*24);

setcookie("sess_phone", "", time()-3600*24);

session_destroy();

header("Location: index.php");

?>