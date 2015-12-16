<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
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
					<div class="page-sidebar">
						<?php
							if (com_is_active('OssnAds')) {
							  		echo ossn_plugin_view('ads/page/view');
							}
							?>
					</div>
				</div>
			</div>
		</div>
	</div>
 	 <?php echo ossn_plugin_view('theme/page/elements/footer');?> 
</div>