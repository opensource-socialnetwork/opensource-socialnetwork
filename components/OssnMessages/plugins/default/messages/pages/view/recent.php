 	<div id="get-recent" style="display:none;"></div>
        <div class="messages-from">
            <div class="inner">
<?php 
if($params['recent']) {
		$loggedin_guid = ossn_loggedin_user()->guid;
		foreach($params['recent'] as $message) {
				$args = array(
						'instance'  => clone $message,
						'view_type' => 'messages/pages/view/recent',
				);
				$yes_replied = false;

				$actual_to   = $message->message_to;
				$actual_from = $message->message_from;

				if($message->message_from == $loggedin_guid) {
						$message->message_from = $actual_to;
						$yes_replied           = true;
				}
				//if answered and is message from loggedin user
				//as of 5.3 it shows message form owner too so old logic need to be changed
				if(($message->answered && $message->message_from == $loggedin_guid) || $yes_replied) {
						$user    = ossn_user_by_guid($message->message_from);
						$text    = ossn_call_hook('messages', 'message:smilify', $args, strl($message->message, 32));
						$replied = ossn_print('ossnmessages:replied:you', array(
								$text,
						));
						if(isset($message->is_deleted) && $message->is_deleted == true) {
								$replied = ossn_print('ossnmessages:deleted');
						}
						$viewed_check = "";
						if($message->viewed == 1){
							$viewed_check = "<i class='ossn-msgrecent-check-read fa fa-check'></i>";
						}
						$replied = "<i class='fa fa-reply'></i><div class='reply-text'>{$replied}{$viewed_check}</div>";
				} else {
						$user = ossn_user_by_guid($message->message_from);
						$text = ossn_call_hook('messages', 'message:smilify', $args, strl($message->message, 32));
						if(isset($message->is_deleted) && $message->is_deleted == true) {
								$text = ossn_print('ossnmessages:deleted');
						}
						$replied = "<div class='reply-text-from'>{$text}</div>";
				}
				if($message->viewed == 0 && $actual_from !== ossn_loggedin_user()->guid) {
						$new = 'message-new';
				} else {
						$new = '';
				}
				$status = 'ossn-recent-message-status-offline';
				if($user->isOnline(10)){
					$status = 'ossn-recent-message-status-online';
				}
?>
                        <div data-guid="<?php echo $user->guid;?>" class="ossn-recent-message-item d-flex flex-row user-item <?php echo $new; ?> <?php echo $status;?>" onclick="Ossn.redirect('messages/message/<?php echo $user->username; ?>');">
								<div class="msg-flex-c1">
 		                               <img class="image user-icon-smaller" src="<?php echo $user->iconURL()->smaller; ?>"/>
                                       <span class="ossn-inmessage-status-circle"></span>
                         	   </div>    
                         	   <div class="msg-flex-c2 data">
                         	       <div class="name"><?php echo strl($user->fullname, 17); ?></div>
                         	       <div class="time time-created"><?php echo ossn_user_friendly_time($message->time); ?> </div>
                         	       <div class="reply"><?php echo $replied; ?></div>
                            	</div>
                        </div>
<?php
     }

}
echo ossn_view_pagination($params['count_recent'], 10, array(
		'offset_name' => 'offset_message_xhr_recent',															 
));
?>		    
            </div>
        </div>
