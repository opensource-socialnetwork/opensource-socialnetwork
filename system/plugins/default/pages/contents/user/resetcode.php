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
<div class="row">
       <div class="col-md-6 col-center ossn-page-contents">
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
