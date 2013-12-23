<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
if(isset($_REQUEST['op']))
{
	if($_REQUEST['op']=='edit')
	{
		if(isset($_REQUEST['type']))
		{
			if($_REQUEST['type']=="nr")
			{
				$sqlupdate="update availability set rooms='".$_REQUEST['val']."' where room_id='".$_REQUEST['rid']."'";
				mysql_query($sqlupdate);
			}
			else if($_REQUEST['type']=="pr")
			{
				$sqlupdate="update availability set price='".$_REQUEST['val']."' where room_id='".$_REQUEST['rid']."'";
				mysql_query($sqlupdate);
			}
			else if($_REQUEST['type']=="cur")
			{
				$sqlupdate="update availability set currency='".$_REQUEST['val']."' where room_id='".$_REQUEST['rid']."'";
				mysql_query($sqlupdate);
			}	
			else if($_REQUEST['type']=="cin")
			{
				$sqlupdate="update availability set cindate='".$_REQUEST['val']."' where room_id='".$_REQUEST['rid']."'";
				mysql_query($sqlupdate);
			}
			else if($_REQUEST['type']=="cout")
			{
				$sqlupdate="update availability set coutdate='".$_REQUEST['val']."' where room_id='".$_REQUEST['rid']."'";
				mysql_query($sqlupdate);
			}	
		}	
		else
		{
			$sqlupdate="update rooms set room_type='".$_REQUEST['rt']."' where id='".$_REQUEST['rid']."'";
			mysql_query($sqlupdate);
		}		
	}
	
	
	else if($_REQUEST['op']=='insert')
	{
		if($_REQUEST['id'])
		{
				$email_dup_query=executeQuery("select id from rooms where hotel_id='".$_REQUEST['id']."' and room_type='".$_REQUEST['roomtype']."'");
	    }
		else
		{
				$email_dup_query=executeQuery("select id from rooms where room_type='".$_REQUEST['roomtype']."'");
		}
		
		if(mysql_num_rows($email_dup_query)>0)
		
		{
					
 			echo 'This Room Type already exist';
		}
		else
		{
			if($_REQUEST['roomtype1'])
			{
			$sqlinsert="insert into rooms set room_type='".$_REQUEST['roomtype1']."', hotel_id='".$_REQUEST['id']."'";
			}
			else
			{
			$sqlinsert="insert into rooms set room_type='".$_REQUEST['roomtype']."', hotel_id='".$_REQUEST['id']."'";
			}
					
			mysql_query($sqlinsert);		
			$id=mysql_insert_id();
			
			$sqlinsert1="insert into availability set room_id=".$id.",rooms='".$_REQUEST['rooms']."',cindate='".$_REQUEST['cindate']."',coutdate='".$_REQUEST['coutdate']."',price='".$_REQUEST['price']."',currency='".$_REQUEST['curren']."', hotel_id='".$_REQUEST['id']."'";
			mysql_query($sqlinsert1);
		}
	}
	
	else if($_GET['op']=='delete')
	{
		$id_delete=$_GET['id_delete'];
		$id_del=substr($id_delete,1);
		$id_delete=explode(",",$id_delete);
  
  		if($id_delete!="")
		{		  
	    	$sql_delete="delete from availability where room_id in(".$id_del.")";
			mysql_query($sql_delete);
			$sql_delete1="delete from rooms where id in(".$id_del.")";
			mysql_query($sql_delete1);
	  
		}
	}
}

include("availability_content.php");
?>