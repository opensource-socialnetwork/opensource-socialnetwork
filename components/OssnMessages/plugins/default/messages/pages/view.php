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
			<div class="col-lg-4 d-none d-md-block">
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
					//[B] Message send form not showing #2314
					if(isset($params['user']) && $params['user'] instanceof OssnUser){
					$status = 'ossn-inmessage-status-offline';	
						if($params['user']->isOnline(10)){
					$status = 'ossn-inmessage-status-online';	
					}
						$status_container = "<span class='ossn-inmessage-status-circle'></span>";
					$delete = "<a data-guid='{$params['user']->guid}' class='ossn-message-delete-conversation' href='javascript:void(0);'><i class='fas fa-trash-alt'></i></a>";
							$image = ossn_plugin_view('output/image', array(
							'src' => $params['user']->iconURL()->smaller,
							'class' => 'user-icon-smaller',
					));
						echo ossn_plugin_view('widget/view', array(
					'title' => $image.$status_container.$params['user']->fullname.$delete,
					'id' => 'message-with-user-widget',
					'data-guid' => $params['user']->guid,
					'contents' => ossn_plugin_view('messages/pages/view/with', $params),
					'class' => "messages-with {$status}",
					));
					}  else {
					echo "<div class='h-100 d-flex align-items-center justify-content-center ossn-messages-select-conv'><i class='fa fa-envelope'></i></div>";	
					}
					?>
			</div>
		</div>
	</div>
	<audio id="ossn-chat-sound" src="<?php echo ossn_site_url("components/OssnMessages/sound/pling.mp3"); ?>" preload="auto"></audio>
</div>