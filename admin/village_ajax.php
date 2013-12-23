<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
//validate_user();
@extract($_REQUEST);
$aa=$_REQUEST['id1'];
$bb=$_REQUEST['sel'];

if($_REQUEST['id1']){ ?>
	<select name="village" id="villageturkey" class="txtfld txt" style="width:250px; " onchange="javascript:linkprofile3(this.value);">
		<option value="">Please Select Village</option>
<?php //SELECT * FROM `city` WHERE 1`id`, `state_id`, `city`, `status`, `country_id`
$sql_village=mysql_query("SELECT * FROM village where local_id='".$aa."' and status=1 order by village_Turkish asc");
if(@mysql_num_rows($sql_village)>0){
	while($villageline=mysql_fetch_array($sql_village)){
?>
					<option value="<?php echo $villageline['id'];?>"<?php if($bb==$villageline['id']){ echo 'selected';}?>><?php echo $villageline['village_Turkish'];?></option>
	<?php } }?>
					
					</select>
<?php
}else{ ?>
	<select name="village" id="villageturkey" class="txtfld txt" style="width:250px; ">
		<option value="" >Please Select village</option>
      
		</select>

<?php }

?>
