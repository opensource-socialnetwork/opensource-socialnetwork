<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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
<script>$(window).ready(function(){$('body').addClass('ossn-layout-startup-background');}); </script>
