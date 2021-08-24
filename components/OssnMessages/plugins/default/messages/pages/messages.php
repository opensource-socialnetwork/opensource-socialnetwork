<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if (isset($params['user']->guid)) { ?>
<div class="row ossn-messages">
			<div class="col-md-5">
            	      <?php
	  					echo ossn_plugin_view('widget/view', array(
							'title' => ossn_print('inbox').' ('.OssnMessages()->countUNREAD(ossn_loggedin_user()->guid).')',
							'href' => ossn_site_url('messages/all'),
							'contents' => ossn_plugin_view('messages/pages/view/recent', $params),
							'class' => 'messages-recent',
												   
						));
						?>
            </div>
            <div class="col-md-7">
            	      <?php
	  					echo ossn_plugin_view('widget/view', array(
							'title' => $params['user']->fullname,
							'id' => 'message-with-user-widget',
							'data-guid' => $params['user']->guid,							
							'contents' => ossn_plugin_view('messages/pages/view/with', $params),
							'class' => 'messages-with',
						));
						?>
            </div>            
</div>    
<?php } ?>	
