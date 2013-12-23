<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<!--<tr>
	  <td class="menuLeft"><a href="admin_home.php" class="menuBoldText">Home</a> </td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>-->
	  <tr>
	  <td class="menuLeft"><a href="admin_email.php" class="menuBoldText">Şifre İşlemleri</a></td>
  </tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="profile.php" class="menuBoldText">Benim Hesabım</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <?php if($_SESSION['sess_type']=='Super Admin' ){?>
	  <tr>
	  <td class="menuLeft"><a href="country_list.php" class="menuBoldText">Manage Country</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="state_list.php" class="menuBoldText">Manage State</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="city_list.php" class="menuBoldText">Manage City</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
      
      <tr>
	  <td class="menuLeft"><a href="local_list.php" class="menuBoldText">Manage Local</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
      
      <tr>
	  <td class="menuLeft"><a href="village_list.php" class="menuBoldText">Manage Village</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
      
	  <tr>
	  <td class="menuLeft"><a href="zip_list.php" class="menuBoldText">Manage Zip</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  
	    <? }?>
		<?php if($_SESSION['sess_type']=='Super Admin'){?>
        <tr>
	  <td class="menuLeft"><a href="category_list.php" class="menuBoldText">Manage Category</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="subcategory_list.php" class="menuBoldText">Manage Sub Category</a></td>
	</tr>
    <?php
	}
	if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Admin'){?>

	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="user_list.php" class="menuBoldText">Kullanıcı Yönetimi</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
      
       <tr>
	  <td class="menuLeft"><a href="members_list.php" class="menuBoldText">Ziyaretçi Yönetimi</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	<? } ?>
    <?php
		if($_SESSION['sess_type']!='Member' ){?> 
	  <tr>
	  <td class="menuLeft"><a href="hotel_list.php" class="menuBoldText">Tesis Yönetimi</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="guest_list.php" class="menuBoldText">Ziyaretçi Defteri</a></td>
	</tr>
    <tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
  <?php } ?>
   <?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Admin' || $_SESSION['sess_type']=='Hotel Owners' ){?> 
     <tr>
	  <td class="menuLeft"><a href="availability_list.php" class="menuBoldText">Oda Satışları</a></td>
	</tr>
    <tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
     <tr>
	  <td class="menuLeft"><a href="reservation_list.php" class="menuBoldText">Rezervasyonlar</a></td>
	</tr>
    <tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
<? }?>	  
      <?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Admin' ){?> 
	  <tr>
	  <td class="menuLeft"><a href="content_list.php" class="menuBoldText">OTEL24 Sayfaları</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <? }?>
	  <tr>
	  <td class="menuLeft"><a href="logout.php" class="menuBoldText">Çıkış ( <?php echo $_COOKIE['sess_username'];?>)</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	</tr>
</table>