<?php
session_start();
unset($_SESSION['userid']);
unset($_SESSION);
header("location:../index.php");
?>