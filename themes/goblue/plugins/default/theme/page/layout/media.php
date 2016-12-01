<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

//unused pagebar skeleton when ads are disabled #628  
 if(com_is_active('OssnAds')){
	 $ads = ossn_plugin_view('ads/page/view');
 	 $ads = trim($ads);
 }
?>
<div class="container">
	<div class="row">
       <?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>    
		<div class="ossn-layout-media">
			<div class="row">
				<div class="col-md-8">
					<div class="content">
						<?php echo $params['content']; ?>
					</div>
				</div>
				<div class="col-md-3">
                 <?php if(!empty($ads)){ ?>
					<div class="page-sidebar">
						<?php
								echo $ads;
							?>
					</div>
                    <?php } ?>
				</div>
			</div>
		</div>
	</div>
 	 <?php echo ossn_plugin_view('theme/page/elements/footer');?> 
</div>