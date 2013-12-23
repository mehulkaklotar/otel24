<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
//validate_user();
@extract($_REQUEST);
$aa=$_REQUEST['id1'];
$bb=$_REQUEST['sel'];
if($_REQUEST['id1']){ ?>
	<select name="zipcode" id="zipcodeturkey" class="txtfld txt" style="width:250px; ">
		<option value="" selected="selected">Please Select Zipcode</option>
<?php //SELECT * FROM `tbl_zip` WHERE 1`id`, `zipcode`, `city_id`, `state_id`, `country_id`, `status`
$sql_zip=mysql_query("SELECT * FROM tbl_zip where village_id='".$aa."' and status=1 order by zipcode_Turkish asc");
if(@mysql_num_rows($sql_zip)>0){
	while($zipline=mysql_fetch_array($sql_zip)){
?>
					<option value="<?php echo $zipline['id'];?>"<?php if($bb==$zipline['id']){ echo 'selected';}?>><?php echo $zipline['zipcode_Turkish'];?></option>
	<?php } }?>
					
					</select>
<?php
}else{ ?>
	<select name="zipcode" id="zipcodeturkey" class="txtfld txt" style="width:250px; ">
		<option value="" selected="selected">Please Select Zipcode</option>
        
		</select>

<?php }

?>
