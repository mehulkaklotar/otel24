<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
?>

<table align="center" height="250" border="0" width="100%">
        <tr>
         <?php 
			$sql="select a.id,a.room_id,a.hotel_id,a.cindate,a.coutdate,a.price,a.currency,a.rooms,c.id,c.room_type,c.hotel_id from availability a, rooms c where a.room_id=c.id and a.hotel_id=".$_REQUEST['id'];
			//echo $sql;
			$res=mysql_query($sql);
			$cnt=0;
			$total_id="0";
			while($row=mysql_fetch_array($res))
			{
			$cnt++;
			$total_id.=",".$row['id'];
			
			?>
        	<td width="25%" >
          
            
            	<table border="0">
                <tr>
                <td colspan="2">
                	<table width="100%">
                    <tr>
                    <td nowrap="nowrap">
                	<input type="checkbox" name="C1_<?php echo $row['room_id']; ?>" id="C1_<?php echo $row['room_id']; ?>" /> 
					<?php 
					if(isset($_REQUEST['op']))
					{						
						if($_REQUEST['op']=='up')
						{
							if($row['room_id']==$_REQUEST['rid'])
							{?>
									  <input type="text" value="<?php echo $row['room_type']; ?>" id="txtup" class="txtfld txt" name="txtup" onKeyPress="room_edit_oe(<?php echo $_REQUEST['id']; ?>,<?php echo $_REQUEST['rid']; ?>,event)"/>
                                       <a onclick="room_edit(<?php echo $_REQUEST['id']; ?>,<?php echo $_REQUEST['rid']; ?>);"><img src="images/success.gif" /></a>
					<?php	}
							else
							{	?>
								<strong><?php echo $row['room_type']; ?></strong>
                                 <a onclick="edittype('<?php echo $_REQUEST['id']; ?>',<?php echo $row['room_id'] ?>);"><img src="images/edit-icon.png" /></a>
					<?php	}					                       
						}
						else
						{
						?>
								<strong><?php echo $row['room_type']; ?></strong>
                                 <a onclick="edittype('<?php echo $_REQUEST['id']; ?>',<?php echo $row['room_id'] ?>);"><img src="images/edit-icon.png" /></a>
								<?php
						}
						
					}
					else
					{
					?>
							<strong><?php echo $row['room_type']; ?></strong>
                             <a onclick="edittype('<?php echo $_REQUEST['id']; ?>',<?php echo $row['room_id'] ?>);"><img src="images/edit-icon.png" /></a>
                            <?php
					}
					?>
                    
                   
                   </td>
                    <td></td>
                	<td align="right"> <input type="text" name="text1" class="txtfld txt" id="text1" value="<?php echo $row['rooms']; ?>" onKeyPress="editrooms('nr',<?php echo $row['room_id'];?>,<?php echo $_REQUEST['id']; ?>,this.value,event);"/></td>
                    </tr>
                    </table>
                 </td>
                 <tr>
                 <td> Başlangıç Tarihi :<br /><input type="text" name="text2" value="<?php echo $row['cindate']; ?>" class="txtfld txt" id="text2_<?php echo $row['room_id']; ?>" onfocus="displayCalendar(document.getElementById('text2_<?php echo $row['room_id']; ?>'),'yyyy-mm-dd',this);" onChange="javascript:editcindate('cin',<?php echo $row['room_id'];?>,<?php echo $_REQUEST['id']; ?>,this.value);"/></td>
                 <td> Bitiş Tarihi :<br /><input type="text" name="text3" value="<?php echo $row['coutdate']; ?>" class="txtfld txt" id="text3_<?php echo $row['room_id']; ?>" onfocus="displayCalendar(document.getElementById('text3_<?php echo $row['room_id']; ?>'),'yyyy-mm-dd',this);" onChange="javascript:editcoutdate('cout',<?php echo $row['room_id'];?>,<?php echo $_REQUEST['id']; ?>,this.value);"/></td>                                  
                 </tr>
                 <tr>
                 <td align="center"><srong>
                 1 Oda Fiyatı :</strong></td>
                 <td><input type="text" name="price" value="<?php echo $row['price']; ?>" class="txtfld txt" onKeyPress="editprice('pr',<?php echo $row['room_id'];?>,<?php echo $_REQUEST['id']; ?>,this.value,event);"/> <select name="curren" onchange="editcurr('cur',<?php echo $row['room_id'];?>,<?php echo $_REQUEST['id']; ?>,this.value);" >
    <option value="TL" <?php if($row['currency'] == "TL") { echo "selected='selected'"; } ?>>TL</option>
    <option value="EURO" <?php if($row['currency'] == "EURO") { echo "selected='selected'"; } ?>>EURO</option>
    </select></td>
                  </tr>
                
                 </table>
            </td>
            	<?php if($cnt%4==0){echo "</tr><tr>";} ?>
                <?php 
				
				} 
				
				
				?>                                    
        </tr>
        
        <tr>
        	
        	<td align="center" colspan="4">
            	<input type="button" id="check"  onclick="checkall();" class="button" value="Hepsini Seç"/>
                <input type="button" id="check"  onclick="checknone();" class="button" value="Seçilenleri kaldır"/>
                        
            <?php if($_SESSION['sess_type']=='Super Admin'  || $_SESSION['sess_type']=='Admin' || $_SESSION['sess_type']=='Hotel Owners'){?><input type="button" name="delete" value="Sil" class="button" onclick="mdelete(<?php echo $_REQUEST['id']; ?>);" /><? }?>
                                    
            <input type="hidden" id="total_ids" name="total_ids" size="2" value="<?php echo $total_id;?>"/>
            </td>
            
        </tr>
        </table>
