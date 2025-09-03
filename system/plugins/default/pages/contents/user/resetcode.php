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
<div class="row">
       <div class="col-lg-6 col-center ossn-page-contents">
    	<?php 
			$contents = ossn_view_form('user/resetpassword', array(
  					 'action' => ossn_site_url('action/resetpassword'),
    				 'class' => 'ossn-reset-login',
			));
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('reset:password'),
						'contents' => $contents,
			));
			?>	       			
       </div>     
</div>	
