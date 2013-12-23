<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
//validate_user();
@extract($_REQUEST);
$aa=$_REQUEST['id1'];
$bb=$_REQUEST['sel'];
if($_REQUEST['id1']){ ?>
	<select name="local" id="localeng" class="txtfld txt" style="width:250px; "  onchange="javascript:linkprofilevillageeng(this.value)"  >
		<option value="">Please Select Local</option>
<?php //SELECT * FROM `city` WHERE 1`id`, `state_id`, `city`, `status`, `country_id`
$sql_local=mysql_query("SELECT * FROM local where city_id='".$aa."' and status=1 order by local_English asc");
if(@mysql_num_rows($sql_local)>0){
	while($localline=mysql_fetch_array($sql_local)){
?>
					<option value="<?php echo $localline['id'];?>" <?php if($bb==$localline['id']){ echo 'selected';}?>><?php echo $localline['local_English'];?></option>
	<?php } }?>
					
					</select>
<?php
}else{ ?>
	<select name="local" id="localeng" class="txtfld txt" style="width:250px; ">
		<option value="">Please Select Local</option>
      
		</select>

<?php }

?>
