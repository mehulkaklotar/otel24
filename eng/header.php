<table  width="971" align="center" cellpadding="0" cellspacing="0" border="0">
  <!--<tr>
    <td width="971" class="headback">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="65%"><span class="head1">Biliyor muydunuz?</span>&nbsp;<span class="head2">Otel24’ü Türkçe görüntüleyebilirsiniz.</span></td>
            <td width="32%"><img src="images/tukce.png" width="119" height="19" alt=""  /></td>
            <td width="3%" align="right"><img src="images/close.png" width="17" height="16" alt=""  /></td>
          </tr>
          <tr>
            <td colspan="3"><input type="checkbox" name="checkb"  /> <span class="head2">Dil tercihini hatırla.</span></td>
          </tr>
        </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;    </td>
</tr>-->
  <tr>
    <td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><img src="images/logo.png"  /></td>
            <td align="right">
            	<table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><img src="images/slogon.png"  /></td>
                            <td align="right" class="headlink" valign="top">
                                    <table cellspacing="0" cellpadding="0" border="0">
                                      <tr>
                                        <td valign="top" class="hellousr"><?php if($_SESSION['userid']){
										$user_sql=mysql_query("select user_id from tbl_user where id='".$_SESSION['userid']."'");
										$user_res=mysql_fetch_array($user_sql);
										echo "Hello, <b>".$user_res['user_id']."</b><font size='3' color='grey'> |&nbsp;</font>";
										}?> </td>
                                       
                                        <td valign="top">  <?php if($_SESSION['userid']){?><a href="signout.php">Sign out</a><?php }else{?><a href="signin.php?keepThis=true&TB_iframe=true&height=628&width=750" title="" class="thickbox">Sign in</a><?php }?> | <a href="register.php?keepThis=true&TB_iframe=true&height=628&width=750" title="" class="thickbox">Register Now!</a> | <a href="../tr/index.php" ><img src="images/turkey.jpg"  /></a> | <a href="index.php"><img src="images/eng.png"  /></a></td>
                                      </tr>
                                    </table> 				
                             </td>
                          </tr>
                        </table>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><img src="images/banner.jpg"  /></td>
                        <td>&nbsp;</td>
                        <td valign="bottom" align="right"><img src="images/micro_banner.jpg"  /></td>
                      </tr>
                    </table>

                    </td>
                  </tr>
                </table>
            </td>
           
          </tr>
        </table>    
   </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>