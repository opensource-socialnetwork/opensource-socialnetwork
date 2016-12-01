<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
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
							'contents' => ossn_plugin_view('messages/pages/view/with', $params),
							'class' => 'messages-with',
						));
						?>
            </div>            
</div>    
<?php } ?>
<audio id="ossn-chat-sound" src="<?php echo ossn_site_url("components/OssnMessages/sound/pling.mp3"); ?>" preload="auto"></audio>		