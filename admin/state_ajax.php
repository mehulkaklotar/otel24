<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
//validate_user();
@extract($_REQUEST);
$aa=$_REQUEST['id1'];
$bb=$_REQUEST['sel'];

if($_REQUEST['id1']){ ?>
	<select name="state" id="stateturkey" class="txtfld txt" style="width:250px; "  onchange="javascript:linkprofile2(this.value);">
		<option value="">Please Select State</option>
<?php 
$sql_scat=mysql_query("SELECT * FROM state where country_id='".$aa."' and status=1 order by name_Turkish asc");
if(@mysql_num_rows($sql_scat)>0){
	while($scatline=mysql_fetch_array($sql_scat)){
?>
					<option value="<?php echo $scatline['id'];?>"<?php if($bb==$scatline['id']){ echo 'selected';}?>><?php echo $scatline['name_Turkish'];?></option>
	<?php } }?>
					
					</select>
<?php
}else{ ?>
	<select name="state" id="stateturkey" class="txtfld txt" style="width:250px; ">
		<option value="">Please Select State</option>
         
		</select>

<?php }

?>
