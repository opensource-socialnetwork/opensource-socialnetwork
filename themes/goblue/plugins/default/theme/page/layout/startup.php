<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<div class="ossn-layout-startup">
	<div class="container">
		<div class="row">
            <?php echo ossn_plugin_view('theme/page/elements/system_messages'); ?>        
			<div class="ossn-home-container">
				<div class="inner">
					<?php echo $params['content']; ?>
				</div>
			</div>
		</div>
		<?php echo ossn_plugin_view('theme/page/elements/footer');?>
	</div>
</div>