<?php

$breadcrumbstart = '<a href="'.WB_URL.'">Start</a> ';
$moredetails = '<h3>More Details:</h3>';



// redirect if this file is directly called in the browser
if(!defined('WB_URL')) {
	header('Location: ../index.php');
	exit(0);
}



//Print?
if ( isset($_GET['print']) AND $_GET['print'] == 1 ) { 
	$print = true; 
	$printlink = '';
	echo '<script type="text/javascript">
	window.print();
	</script>';
	$breadcrumbstart = WB_URL;	
} else {
	$print = false;
	$ru = $_SERVER['REQUEST_URI'];
	if (strpos($ru, '?') > 0) {$printlink = $ru.'&amp;print=1';} else {$printlink = '?print=1';}
}

?><!DOCTYPE html>
<html>
<head>
 <?php if(function_exists('simplepagehead') AND 4==5) {
	simplepagehead(); 
} else { ?>
<title><?php page_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php if(defined('DEFAULT_CHARSET')) { echo DEFAULT_CHARSET; } else { echo 'utf-8'; }?>" />
<meta name="description" content="<?php page_description(); ?>" />
<meta name="keywords" content="<?php page_keywords(); ?>" />

  <?php  
  }
  // automatically include optional module files (frontend.css, frontend.js) if required
  // include the template CSS files below to prevent that CSS definitions are overwritten by modules
  if(function_exists('register_frontend_modfiles')) {
    register_frontend_modfiles('css');
    register_frontend_modfiles('js');
	register_frontend_modfiles('jquery');
}
  ?>

	
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_DIR; ?>/editor.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_DIR; ?>/style.css"  />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_DIR; ?>/custom.css"  />
<link rel="stylesheet" media="screen and (max-width: 768px)" href="<?php echo TEMPLATE_DIR; ?>/mobiles.css" />


<?php if ($print) { //CSS for print, hide print-version from search engines ?>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_DIR; ?>/print.css"  />
<meta name="robots" content="noindex,nofollow" />
<?php } else { // Mobiles and IEs ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="format-detection" content="telephone=no" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />

<!--[if lte IE 6]>
	<style type="text/css" media="all">
		@import "<?php echo TEMPLATE_DIR; ?>/ie6.css";
		body {behavior: url("<?php echo TEMPLATE_DIR; ?>/csshover.htc");}
	</style>
<![endif]-->
<?php } ?>
    	
</head>
<?php 
	//Buffering content 1
	ob_start();		
	page_content(1);
	$page_content_1 = ob_get_contents();
	ob_end_clean();
	
	
	
	if(defined('TOPIC_BLOCK2') AND TOPIC_BLOCK2 != '') { 
		 	$page_content_2 = TOPIC_BLOCK2; 
	} else {
		ob_start();
		page_content(2);
		$page_content_2 = ob_get_contents();
		ob_end_clean();
	}
	
	
	/*Breadcrumbs*/
	ob_start();  
	show_menu2(0, SM2_ROOT, SM2_CURR, SM2_CRUMB, '<span class="[class]"> &raquo; [a][menu_title]</a></span>', '', '', '', ''.$breadcrumbstart.' &raquo; <span class="[class]">[a][menu_title]</a></span>');
	$breadcrumbs=ob_get_contents(); 
	ob_end_clean();
	
	/*Menüs*/
	ob_start(); 
	show_menu2(1, SM2_ROOT, SM2_ALL, SM2_ALL, '<li class="[class]"><a href="[url]" class="[class]"><span>[menu_title]</span></a>', "</li>", '<ul>', '<li class="ulend"></li></ul>', true, '<ul id="mobile" class="nav">');
	$topmenu = ob_get_contents();
	ob_end_clean();
	
	
	
	$childpages = '';
	if ($moredetails != '') {
		ob_start(); 
		show_menu2(1, SM2_CURR+1, SM2_CURR+1, '', '<li class="[class]">[a][menu_title]</a></li>', '', '', '', '');
		$childpages = ob_get_contents();	
		ob_end_clean();
	}
	
?>
<body onclick="menuremove()">
	<div class="container">
		<div class="header" style="position:relative">
			<img class="headerpic" src="<?php echo TEMPLATE_DIR; ?>/images/header.png" alt="" />
			<div class="infobox">
				<h1><a class="logo" href="<?php echo WB_URL; ?>"><?php echo WEBSITE_TITLE; ?></a></h1><h2><?php echo PAGE_TITLE; ?></h2>
				<h3><?php page_description(); ?></h3>
			</div>
			<div style="clear:both;"></div>
		</div>
			
		<a id="mobilemenu" href="javascript:showmenu();"><span>Menu</span></a>
		<div class="topmenubar">
			<?php if(FRONTEND_LOGIN) { include('login.inc.php'); } ?><!--LOGIN_URL, LOGOUT_URL,FORGOT_URL-->
			<a class="printbutton" href="<?php echo $printlink; ?>" target="_blank" rel="nofollow" ><img src="<?php echo TEMPLATE_DIR; ?>/images/print.png" alt="P" /></a>
			<!-- frontend search -->
			<?php if (SHOW_SEARCH) { ?>
			<div class="search_box">
				<form name="search" action="<?php echo WB_URL; ?>/search/index.php" method="get">
					<input type="hidden" name="referrer" value="<?php echo defined('REFERRER_ID') ? REFERRER_ID : PAGE_ID; ?>" />
					<input type="text" value="<?php if (isset($_GET['string'])) {echo strip_tags($_GET['string']);} else {echo 'Search'; } ?>" name="string" class="searchstring" onfocus="if (this.value=='Search') {this.value='';}" />
					<input type="image"  class="submitbutton" src="<?php echo TEMPLATE_DIR; ?>/images/searchbutton.png" alt="Start" />
				</form>
			</div>
			<?php } ?>
		
			<?php echo $topmenu; ?><div style="clear:left;"></div>
		</div><!--end topmenubar-->
		<div class="breadcrumbs"><?php echo $breadcrumbs; ?></div>
		
		
		<div class="mainbox">
		<?php if ($page_content_2 != '') {
				echo '<div class="contentbox"><div class="inner">'.$page_content_1.'</div></div>
				<div class="rightbox"><div class="inner">'.$page_content_2.'</div></div>';
			} else {
				echo '<div class="contentbox" id="contentwide"><div class="inner">'.$page_content_1.'</div></div>';
			}
		?>
		</div><!--end mainbox-->
		<?php if ($childpages != '') {echo '<div class="childpages">'.$moredetails.'<ul>'.$childpages.'</ul></div>';} ?>
		
		
		<div class="clearer"></div>
	</div><!--end container-->
	<div class="footer"><img class="footerpic" src="<?php echo TEMPLATE_DIR; ?>/images/footer.png" alt="" />
		<div class="inner"><?php 
		page_footer(); 
		if (LEVEL > 0 AND $page_id % 5 == 0) {echo '<br/><span>Based on design by <a href="http://www.beesign.at" target="_blank">Beesign Grafik Wien</a></span>'; } 
		?></div>
	</div><!--end footer-->
	<!--script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script-->
	<script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/script.js"></script>
	<?php if (function_exists('register_frontend_modfiles_body')) { register_frontend_modfiles_body(); } ?>
</body>
</html>