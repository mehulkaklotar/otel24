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
                    <td >OTEL24 adeta subjektif bir rehber ( Guide ), rezervasyon ve oda satış hizmetidir. OTEL 24 yerel ihtiyaçlara yönelik hizmet sağlamaktadır ve Türkiye ile Kıbrıs'ı kapsamaktadır. OTEL 24 Kişilerden ya da kurumlardan oda satışı üzerinden komisyon almaz, sadece her rezervasyon için yapandan 5 EURO işlem ücreti tahsil eder. 
                      <p>&nbsp;
</td>
                  </tr>
                  <tr>
                    <td> <?php
                    $content_sql="select id,menus_Turkish from tbl_content order by id asc";
$content_res=mysql_query($content_sql);
				while($content_rss=mysql_fetch_array($content_res))
				{

					?>
                    <a href="footerlinks.php?id=<?php echo $content_rss['id'];?>&TB_iframe=true&height=628&width=750" class="thickbox"><?php echo $content_rss['menus_Turkish'];?></a>>> &nbsp; 
                <?php
				}
				?>    </td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>Telif Hakkı © 2011 <a href="#" target="_blank">PRF TURİZM</a> / TÜRSAB BELGE NO : 6414 - <strong>Yazılım</strong> : <a href="http://oktaybala.com" target="_blank">RGB MEDYA</a></td>
                  </tr>
            </table>            </td>
            <td>&nbsp;</td>
            <td valign="top" width="242" class="brd" style="padding-left:10px;">
            	<table width="100%" border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td><img src="images/apple.png"  /></td>
                  </tr>
                  <tr>
                    <td align="center" class="hoteltitle">PEK YAKINDA !<br  />Tüm Akıllı Cihazlarda...</td>
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