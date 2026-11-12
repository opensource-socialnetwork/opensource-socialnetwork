<?php
/**
 * Open Source Social Network
 *
 * @package     Open Source Social Network (OSSN)
 * @author      OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license     Open Source Social Network License (OSSN LICENSE)   http://www.opensource-socialnetwork.org/licence
 * @link        https://www.opensource-socialnetwork.org/
 */

if(ossn_is_hook('newsfeed', "sidebar:right")) {
	$newsfeed_right = ossn_call_hook('newsfeed', "sidebar:right", NULL, array());
	$sidebar = implode('', $newsfeed_right);
	$isempty = trim($sidebar);
}

if(ossn_is_hook('newsfeed', "center:top")) {
	$newsfeed_center_top = ossn_call_hook('newsfeed', "center:top", NULL, array());
	$newsfeed_center_top = implode('', $newsfeed_center_top);
	$isempty_top         = trim($newsfeed_center_top);
}
?>
<div class="container-fluid fbui-newsfeed-container">
	<div class="ossn-layout-newsfeed">
		<!-- Added justify-content-between to push left/right sidebars to screen edges -->
		<div class="row justify-content-between g-0">
			
			<!-- 1. Left Navigation Sidebar -->
			<div class="col-12 col-xl-3 col-lg-3 newsfeed-col-left d-none d-lg-block">
				<div class="fbui-left-sidebar">
					<?php echo ossn_plugin_view('theme/page/elements/sidebar'); ?>
				</div>
			</div>

			<!-- 2. Middle Newsfeed Wall -->
			<div class="col-12 col-xl-6 col-lg-6 newsfeed-col-wall"> 
				<?php if(!empty($isempty_top)){ ?>
				<div class="newsfeed-middle-top">
					<?php echo $newsfeed_center_top; ?>
				</div>
				<?php } ?>
				<div class="newsfeed-middle">
					<?php echo $params['content']; ?>
				</div>
			</div>
			
			<!-- 3. Right Sidebar (Ads & Widgets + Footer inside) -->
			<div class="col-12 col-xl-3 col-lg-3 newsfeed-col-sidebar">
                <div class="newsfeed-right-sticky-wrapper">
                    <div class="newsfeed-right">
                        <?php echo $sidebar; ?>
                    </div>
                    <?php echo ossn_plugin_view('theme/page/elements/footer');?>
                </div>
			</div>
			
		</div>
	</div>
</div>


<style>
/*************************************************
	FBUI Container Fluid + Centered Feed Layout
**************************************************/
/* 1. Full Width Container Padding */
.fbui-newsfeed-container {
	padding-left: 16px !important;
	padding-right: 16px !important;
	max-width: 100% !important;
}

/* 2. Middle Newsfeed Wall Constraints */
.newsfeed-col-wall {
	max-width: 680px;
    width: 100%;
    margin-top: 10px;
}

.newsfeed-middle, 
.newsfeed-middle-top {
	max-width: 100% !important;
	margin: 0 auto !important;
}

/* 3. Left & Right Sidebar Flex Baselines */
.newsfeed-col-left {
	max-width: 360px !important;
	width: 100% !important;
}

.newsfeed-col-sidebar {
	max-width: 360px;
	width: 100%;
	margin-top: 10px;
}

/* Wrapper to isolate sticky widgets from the footer */
.newsfeed-right-sticky-wrapper {
    position: relative;
}

/* Responsive Scaling for Mid-sized Monitors */
@media (max-width: 1200px) {
	.newsfeed-col-wall {
		max-width: 580px !important;
	}
	.newsfeed-col-left,
	.newsfeed-col-sidebar {
		max-width: 280px !important;
	}
}
</style>