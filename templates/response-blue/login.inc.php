<div id="showlogin"><a href="javascript:showloginbox();"><img src="<?php echo TEMPLATE_DIR; ?>/images/key.png" alt="K" /></a>
<?php
if(FRONTEND_LOGIN AND !$wb->is_authenticated() AND VISIBILITY != 'private' ) {
			$redirect_url = ((isset($_SESSION['HTTP_REFERER']) && $_SESSION['HTTP_REFERER'] != '') ? $_SESSION['HTTP_REFERER'] : WB_URL );
			$redirect_url = (isset($thisApp->redirect_url) ? $thisApp->redirect_url : $redirect_url );



?>

<div id="login-box" style="display:none;">
<form class="loginform" name="login" action="<?php echo LOGIN_URL; ?>" method="post">
<input type="hidden" name="redirect" value="<?php echo $redirect_url;?>" />
<table>			
	<tr><td><?php echo $TEXT['USERNAME']; ?>:</td><td><input type="text" name="username" class="inputfield" /></td></tr>
	<tr><td><?php echo $TEXT['PASSWORD']; ?>:</td><td><input type="password" name="password" class="inputfield"/></td></tr> 
	<tr><td>&nbsp;</td><td><input type="image"  class="loginsubmit" src="<?php echo TEMPLATE_DIR; ?>/images/login.gif" alt="Start" /></td></tr> 
	<!--input type="submit" name="submit" value="<?php echo $TEXT['LOGIN']; ?>" class="submit" alt="Login" /-->
	
	<tr><td colspan="2">
	<p>
	<!-- frontend signup -->
	<?php	if (is_numeric(FRONTEND_SIGNUP)) { echo ' | <a href="'.SIGNUP_URL.'">'.$TEXT['SIGNUP'].'</a>'; } ?>
	</p></td></tr> 		
</table></form></div>
<?php 



} else  {
?><div id="login-box" style="display:none;">
<form class="loginform" name="logout" action="<?php echo LOGOUT_URL; ?>" method="post">
<?php echo $TEXT['WELCOME_BACK']; ?>, <?php echo $wb->get_display_name(); ?> 
 <input type="submit" name="submit" value="<?php echo $MENU['LOGOUT']; ?>" class="inputfield"  />
<p><a href="<?php echo PREFERENCES_URL; ?>"><?php echo $MENU['PREFERENCES']; ?></a></p>

</form></div>
		
<?php } 	?>
</div>