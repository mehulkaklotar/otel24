<table width="100%"  border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td class="menuLeft"><a href="admin_home.php" class="menuBoldText">Home</a> </td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="profile.php" class="menuBoldText">Profile</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Editors'){?>
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
	  <td class="menuLeft"><a href="zip_list.php" class="menuBoldText">Manage Zip</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="category_list.php" class="menuBoldText">Manage Category</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="subcategory_list.php" class="menuBoldText">Manage Sub Category</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="user_list.php" class="menuBoldText">Manage User</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <? }?>
	  <tr>
	  <td class="menuLeft"><a href="hotel_list.php" class="menuBoldText">Manage Hotel</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="guest_list.php" class="menuBoldText">Guest Book</a></td>
	</tr>
	<?php if($_SESSION['sess_type']=='Super Admin' || $_SESSION['sess_type']=='Editors'){?>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <tr>
	  <td class="menuLeft"><a href="content_list.php" class="menuBoldText">Content Manager </a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	  </tr>
	  <? }?>
	  <tr>
	  <td class="menuLeft"><a href="logout.php" class="menuBoldText">Logout ( <?php echo $_COOKIE['sess_username'];?>)</a></td>
	</tr>
	<tr>
	  <td><img src="images/spacer.gif" width="1" height="1" /></td>
	</tr>
</table>