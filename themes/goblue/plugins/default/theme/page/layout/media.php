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
					<?php if (ossn_is_hook( 'theme', 'sidebar:right')) { ?>
						<div class="page-sidebar">
						<?php
						$modules = ossn_call_hook('theme', 'sidebar:right', null); 
						echo implode( '', $modules);
						?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
 	 <?php echo ossn_plugin_view('theme/page/elements/footer');?> 
</div>
