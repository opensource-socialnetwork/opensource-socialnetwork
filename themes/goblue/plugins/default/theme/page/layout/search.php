<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

//unused pagebar skeleton when ads are disabled #628 
if(ossn_is_hook('newsfeed', "sidebar:right")) {
	$newsfeed_right = ossn_call_hook('newsfeed', "sidebar:right", NULL, array());
	$sidebar = implode('', $newsfeed_right);
	$isempty = trim($sidebar);
} 
?>
<div class="container-fluid">
	<?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>    
	<div class="ossn-layout-newsfeed">
		<div class="row">
			<div class="col-md-2">
				<div class="coloum-left ossn-page-contents">
					<?php
						if (ossn_is_hook('search', "left")) {
						   	$searchleft = ossn_call_hook('search', "left", NULL, array());
						  		echo implode('', $searchleft);
						}
						?>   
				</div>
			</div>
			<div class="col-md-6">
				<div class="newsfeed-middle ossn-page-contents">
					<?php echo $params['content']; ?>
				</div>
			</div>
			<div class="col-md-3">
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