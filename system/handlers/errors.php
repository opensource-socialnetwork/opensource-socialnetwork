<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network (OSSN)
 * @author     OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */
$email = ossn_site_settings('owner_email');
$icon  = ossn_theme_url().'images/broken.png';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo ossn_site_settings('site_name'); ?></title>
		<link rel="stylesheet" href="<?php echo ossn_site_url(); ?>themes/<?php echo ossn_site_settings('theme'); ?>/plugins/default/css/exception.css" type="text/css"/>
	</head>
	<body>
		<div class="ossn-exception-topbar">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
			<span><?php echo ossn_site_settings('site_name'); ?></span>
		</div>
		
		<div class="ossn-exception-handler">
			<div class="container-inner">
				<div class="icon-wrapper">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
				</div>
				<div class="title"><?php echo ossn_print('ossn:exception:title', array($email)); ?></div>
			</div>

			<div class="ossn-exception-description">
				<div class="terminal-header">
					<div class="dot red"></div>
					<div class="dot yellow"></div>
					<div class="dot green"></div>
				</div>
				<?php 
				//[E] Display Errors #2393
				//[B] Undefined property: stdClass::$wwww" in file /system/handlers/errors.php (line 30) #2444
				if(ossn_isAdminLoggedin() || file_exists(ossn_route()->www . 'DISPLAY_ERRORS')){ 
				?>
					<pre><?php echo $params['exception']; ?></pre>
				<?php } else { ?>
					<pre style="text-align:center;">#<?php echo $params['time']; ?>|<?php echo $params['session_id'];?></pre>
				<?php } ?>
			</div>
		</div>
	</body>
</html>