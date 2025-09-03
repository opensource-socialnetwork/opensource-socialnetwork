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
$OssnMessages     = new OssnMessages;
$params['count'] =  $OssnMessages->recentChat(ossn_loggedin_user()->guid, true);
?>
<div class="messages-inner">

    <div class="ossn-notification-messages">
<?php
if($params['recent']) {
		$loggedin_guid = ossn_loggedin_user()->guid;
		foreach($params['recent'] as $message) {
				$args = array(
						'instance'  => clone $message,
						'view_type' => 'messages/templates/message-with-notifi',
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
						$replied = "<i class='fa fa-reply'></i><div class='reply-text'>{$replied}</div>";
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
                ?>
                <div class="user-item <?php echo $new; ?>"
                     onclick="Ossn.redirect('messages/message/<?php echo $user->username; ?>');">
                    <div class="user-item-inner">
                        <div class="image"><img
                                src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/small"/></div>
                        <div class="data">
                            <div class="name">
				<?php echo $user->fullname; ?>
			    </div>
			     <div class="time"><?php echo ossn_user_friendly_time($message->time); ?> </div>				
                            <div class="reply"><?php echo $replied; ?></div>
                        </div>
                    </div>
                </div>
            <?php
            }

        }
	echo ossn_view_pagination($params['count'],10, array(
			'offset_name' => 'offset_message_xhr_recent',															 
	));
		?>

    </div>
</div>
<div class="bottom-all">
    <a href="<?php echo ossn_site_url("messages/all"); ?>"><?php echo ossn_print('see:all'); ?></a>
</div>
