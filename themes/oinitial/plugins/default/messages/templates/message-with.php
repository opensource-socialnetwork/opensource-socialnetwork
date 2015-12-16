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
<div class="title">
    <a href="#"><?php echo ossn_print('inbox'); ?>
        (<?php echo OssnMessages()->countUNREAD(ossn_loggedin_user()->guid); ?>) </a>
</div>
<div class="inner">
    <?php
    if ($params['recent']) {
        foreach ($params['recent'] as $message) {
            if ($message->message_from == ossn_loggedin_user()->guid) {
                $user = ossn_user_by_guid($message->message_to);
                $text = strl($message->message, 22);
                $replied = "<div class='ossn-arrow-back'></div><div class='reply-text'>{$text}</div>";
            } else {
                $user = ossn_user_by_guid($message->message_from);
                $text = strl($message->message, 22);
                $replied = "<div class='reply-text-from'>{$text}</div>";
            }
            if ($message->viewed == 0 && $message->message_from !== ossn_loggedin_user()->guid) {
                $new = 'message-new';
            } else {
                $new = '';
            }
            ?>
            <div class="user-item <?php echo $new; ?>">
                <div class="image"><img
                        src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/small"/>
                </div>
                <div class="data">
                    <div class="name"><?php echo strl($user->fullname, 17); ?></div>
                    <br/>

                    <div class="reply"><?php echo $replied; ?></div>
                    <div class="time"><?php echo ossn_user_friendly_time($message->time); ?> </div>
                </div>
            </div>
        <?php
        }

    }?>


</div>