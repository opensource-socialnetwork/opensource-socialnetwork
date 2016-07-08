<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="row">
       <div class="col-md-6 col-center ossn-page-contents">
    	<?php 
			$contents = ossn_view_form('user/resetlogin', array(
 				   'action' => ossn_site_url('action/resetlogin'),
  				   'class' => 'ossn-reset-login',
			));
			echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('reset:password'),
						'contents' => $contents,
			));
			?>	       			
       </div>     
</div>	
