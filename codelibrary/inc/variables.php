<?php

error_reporting(0);
session_start();
/******************************************************************************
*		File : config.inc.php                                                 *
*       Date Created : Wednesday 11 July 2007, 10:53 AM                       *
*       Date Modified : Wednesday 11 July 2007, 10:53 AM                      *
*       File Comment : This file contain functions which will use in coding.  *
*******************************************************************************/


if($_SERVER['HTTP_HOST']=="localhost" || $_SERVER['HTTP_HOST']=="system14" ||  $_SERVER['HTTP_HOST']=="pd" ) {
	// Config setting for localhost.
	define(DBSERVER,"mysql11.000webhost.com");
	define(DBNAME,"a6005492_bhotel");
	define(DBUSER,"a6005492_root");
	define(DBPASS,"gj5dq2985");
	
	
	define(SITE_PATH,"http://otel24.hostzi.com/");
} else {
	
	
	define(DBSERVER,"mysql11.000webhost.com");
	define(DBNAME,"a6005492_bhotel");
	define(DBUSER,"a6005492_root");
	define(DBPASS,"gj5dq2985");
	
	
	define(SITE_PATH,"http://otel24.hostzi.com/");
}
// Database Connection Establishment String
$con = mysql_connect(DBSERVER,DBUSER,DBPASS);


// Database Selection String
mysql_select_db(DBNAME);

mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET COLLATION_CONNECTION = 'utf8_turkish_ci'");

// Some common settings
define(SITE_TITLE,"Otel24");
define(SITE_ADMIN_TITLE,"Otel24 - Secure Admin Erea");
define(PAGING_SIZE,15);

$dat1=date('Y');
$years=@range($dat1,$dat);
?>
