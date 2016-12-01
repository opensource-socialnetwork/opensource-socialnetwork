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
?>
<div class="messages-inner">

    <div class="ossn-notification-messages">
        <?php
        if ($params['recent']) {
            foreach ($params['recent'] as $message) {
                if ($message->message_from == ossn_loggedin_user()->guid) {
                    $user = ossn_user_by_guid($message->message_to);
                    $text = $message->message;
                    $replied = "<div class='reply-text'>{$text}</div>";
                } else {
                    $user = ossn_user_by_guid($message->message_from);
                    $text = $message->message;
                    $replied = "<div class='reply-text-from'>{$text}</div>";
                }
                if ($message->viewed == 0 && $message->message_from !== ossn_loggedin_user()->guid) {
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

        }?>

    </div>
</div>
<div class="bottom-all">
    <a href="<?php echo ossn_site_url("messages/all"); ?>"><?php echo ossn_print('see:all'); ?></a>
</div>
