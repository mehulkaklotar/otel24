<tr>
 	 <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="704" class="footer" valign="top">
            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td >&nbsp;</td>
                  </tr>
                  <tr>
                    <td >Otel24.com.tr gives leisure travelers the inside track to the best travel deals and discounts around.<br />
With our exclusive deal search technology and negotiating power, Otel24.com.tr consistently delivers more ways to save on discount cheap hotel rooms, </td>
                  </tr>
                  <tr>
                    <td>
                    <?php
                    $content_sql="select id,menus from tbl_content order by id asc";
$content_res=mysql_query($content_sql);
				while($content_rss=mysql_fetch_array($content_res))
				{

					?>
                    <a href="footerlinks.php?id=<?php echo $content_rss['id'];?>&TB_iframe=true&height=628&width=750" class="thickbox"><?php echo $content_rss['menus'];?></a>>> &nbsp; 
                <?php
				}
				?>    
                    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>All material herein © 2010 – 2011 otel24.com.tr Incorporated, all rights reserved. Hotel Management Software by RGB MEDYA</td>
                  </tr>
            </table>            </td>
            <td>&nbsp;</td>
            <td valign="top" width="242" class="brd" style="padding-left:10px;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><img src="images/apple.png"  /></td>
                  </tr>
                  <tr>
                    <td class="hoteltitle">FREE mobile applications</td>
                  </tr>
                </table>            </td>
          </tr>
        </table>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

</body>
</html>