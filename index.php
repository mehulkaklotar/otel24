<?php
session_start();

	include_once('ip2c/ip2country.php');
	$ip2c=new ip2country();
	$ip2c->mysql_host='localhost';
	$ip2c->db_user='root';
	$ip2c->db_pass='';
	$ip2c->db_name='booking_ihotel';
	$ip2c->table_name='ip2c';
	$country_code=$ip2c->get_country_code();
	if($country_code=="TR")
	{
		header("location:tr/index.php");
	}
	else
	{
		header("location:eng/index.php");
	}

?>
