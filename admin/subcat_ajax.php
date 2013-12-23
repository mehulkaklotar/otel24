<?php session_start();
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
//validate_user();
@extract($_REQUEST);
$aa=$_REQUEST['id1'];
$bb=$_REQUEST['sel'];
if($_REQUEST['id1']){ ?>
	<select name="subcategory" class="txtfld txt" style="width:250px; ">
		<option value="">Please Select Sub Category</option>
<?php //SELECT * FROM `tbl_subcategory` WHERE 1`id`, `subcategory`, `cat_id`, `status`, `post_date`
$sql_scat=mysql_query("SELECT * FROM tbl_subcategory where cat_id='".$aa."' and status=1");
if(@mysql_num_rows($sql_scat)>0){
	while($scatline=mysql_fetch_array($sql_scat)){
?>
					<option value="<?php echo $scatline['id'];?>"<?php if($bb==$scatline['id']){ echo 'selected';}?>><?php echo $scatline['subcategory_English'];?></option>
	<?php } }?>
					
					</select>
<?php
}else{ ?>
	<select name="subcategory" class="txtfld txt" style="width:250px; ">
		<option value="">Select Category First</option>
		</select>

<?php }

?>
