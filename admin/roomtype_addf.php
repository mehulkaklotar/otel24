<?php
require_once("../codelibrary/inc/variables.php");
require_once("../codelibrary/inc/functions.php");
?>
<table cellpadding="5" cellspacing="5">

<tr>
	<td>Oda Tipi :</td>
    <td><select id="rt1" name="rt1">
      <option value="" selected="selected">Listeden Seçiniz</option>
    <option value="standard twin">standard twin</option>
   <option value="standard double">standard double</option>
   <option value="suit">suit</option>
   <option value="executive room">executive room</option>
   <option value="executive suit">executive suit</option>
   <option value="bussiness suit">bussiness suit</option>
   <option value="king suit">king suit</option>
<option value="presantal suit">presantal suit</option>
    </select>
    <strong>ya da</strong>
    <input type="text" name="rt" id="rt" class="txtfld txt"  />
    </td>
</tr>

<tr>
	<td>Oda Say&#305;s&#305; :</td>
    <td><input type="text" name="rooms" id="rooms" class="txtfld txt"  /><br />
<span style="color:#FF0000; font-size:10px;">Sat&#305;&#351;a a&ccedil;mak istedi&#287;iniz oda say&#305;s&#305;n&#305; belirtiniz. </span></td>
</tr>

<tr>
	<td>Ba&#351;. Trh:</td>
    <td><input type="text" name="cindate" id="cindate" class="txtfld txt" onfocus="displayCalendar(document.availability.cindate,'yyyy-mm-dd',this)" /><br />
<span style="color:#FF0000; font-size:10px;">Belirtilen oda/odaların sat&#305;&#351;a a&ccedil;&#305;k olduğu ilk g&uuml;n tarihini belirtiniz.</span></td>
</tr>

<tr>
	<td>Biti&#351; Trh :</td>
    <td><input type="text" name="coutdate" id="coutdate" class="txtfld txt" onfocus="displayCalendar(document.availability.coutdate,'yyyy-mm-dd',this)"/><br />
<span style="color:#FF0000; font-size:10px;">Belirtilen oda/odaların sat&#305;&#351;a a&ccedil;&#305;k olduğu son g&uuml;n tarihini belirtiniz. </span></td>
</tr>

<tr>
	<td>Oda Fiyat&#305; :</td>
    <td><input type="text" name="price" id="price" class="txtfld txt"  /> <select name="curren" >
    <option value="TL">TL</option>
    <option value="EURO">EURO</option>
    </select><br />
<span style="color:#FF0000; font-size:10px;">Belirtilen odalar&#305;n sat&#305;&#351;a a&ccedil;&#305;k oldu&#287;u s&uuml;re i&ccedil;inde görüntülenecek 1 oda fiyat&#305;n&#305; belirleyiniz. </span>
    </td>
</tr>


<tr>
	<td colspan="2" align="center"><input type="button" name="submit" id="submit" value="Giri&#351;" class="button" onclick="insertrt(<?php echo $_REQUEST['hotelid']; ?>);"/></td>
</tr>



</table>
