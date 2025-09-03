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
$error = input('error');
?>
<div class="row">
       <div class="col-lg-6 col-center ossn-page-contents">
    <?php if ($error == 1) { ?>
        <div class="alert alert-danger">
            <strong><?php echo ossn_print('login:error'); ?></strong><br/>
            <p><?php echo ossn_print('login:error:sub'); ?></p>
        </div>
    	<?php } ?>       
    	<?php 
			$contents = ossn_view_form('login2', array(
            		'id' => 'ossn-login',
           			'action' => ossn_site_url('action/user/login'),
        	));
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('site:login'),
						'contents' => $contents,
			));
			?>	       			
       </div>     
</div>	
