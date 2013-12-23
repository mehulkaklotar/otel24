<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
//validate_user();
@extract($_REQUEST);
$aa=$_REQUEST['id1'];
$bb=$_REQUEST['sel'];
if($_REQUEST['id1']){ ?>
	<select name="city" id="cityeng" class="txtfld txt" style="width:250px; "  onchange="javascript:linkprofilelocaleng(this.value)" >
		<option value="">Please Select City</option>
<?php //SELECT * FROM `city` WHERE 1`id`, `state_id`, `city`, `status`, `country_id`
$sql_scat=mysql_query("SELECT * FROM city where state_id='".$aa."' and status=1 order by city_English asc");
if(@mysql_num_rows($sql_scat)>0){
	while($scatline=mysql_fetch_array($sql_scat)){
?>
					<option value="<?php echo $scatline['id'];?>"<?php if($bb==$scatline['id']){ echo 'selected';}?>><?php echo $scatline['city_English'];?></option>
	<?php } }?>
					
					</select>
<?php
}else{ ?>
	<select name="city" id="cityeng" class="txtfld txt" style="width:250px; ">
		<option value="">Please Select City</option>
         
		</select>

<?php }

?>
