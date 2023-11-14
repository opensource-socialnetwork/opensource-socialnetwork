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
?>
<div class="col-lg-12">
	<div class="ossn-messages">
		<div class="row g-0">
			<div class="col-lg-4">
            	      <?php
					  	$toggle_mobile = '<span class="d-inline d-sm-none ossn-recent-messages-toggle"><i class="fas fa-angle-down"></i></span>';
	  					echo ossn_plugin_view('widget/view', array(
							'title' => ossn_print('inbox').' ('.OssnMessages()->countUNREAD(ossn_loggedin_user()->guid).')'.$toggle_mobile,
							'contents' => ossn_plugin_view('messages/pages/view/recent', $params),
							'class' => 'messages-recent',
						));
						?>
            </div>
            <div class="col-lg-8">
            	      <?php
					 echo "<div class='h-100 d-flex align-items-center justify-content-center ossn-messages-select-conv'><i class='fa fa-envelope'></i></div>";	
						?>
            </div>
    	</div>        
	</div>    
</div>
