<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
//unused pagebar skeleton when ads are disabled #628 
if(ossn_is_hook('newsfeed', "sidebar:right")) {
	$newsfeed_right = ossn_call_hook('newsfeed', "sidebar:right", NULL, array());
	$sidebar = implode('', $newsfeed_right);
	$isempty = trim($sidebar);
}
//show center:top div only when there is something otherwise on phone it results empty div with padding/whitebg.
if(ossn_is_hook('newsfeed', "center:top")) {
	$newsfeed_center_top = ossn_call_hook('newsfeed', "center:top", NULL, array());
	$newsfeed_center_top = implode('', $newsfeed_center_top);
	$isempty_top 	     = trim($newsfeed_center_top);
}
?>
<div class="container-fluid">
	<div class="row">
       	<?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>    
		<div class="ossn-layout-newsfeed">
			<div class="col-md-7">
				<?php if(!empty($isempty_top)){ ?>
				<div class="newsfeed-middle-top">
					<?php echo $newsfeed_center_top; ?>
				</div>
				 <?php } ?>
				<div class="newsfeed-middle">
					<?php echo $params['content']; ?>
				</div>
			</div>
			<div class="col-md-4">
            			<?php if(!empty($isempty)){ ?>
				<div class="newsfeed-right">
					<?php
						echo $sidebar;
						?>                            
				</div>
                		<?php } ?>
			</div>
		</div>
	</div>
	<?php echo ossn_plugin_view('theme/page/elements/footer');?>
</div>
