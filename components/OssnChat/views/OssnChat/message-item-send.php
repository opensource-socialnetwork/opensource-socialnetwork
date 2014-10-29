<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<div class="message-sender">
    <div class="ossn-chat-text-data-right">
        <div class="ossn-chat-triangle ossn-chat-triangle-blue"></div>
        <div class="text">
            <div class="inner" title="<?php echo OssnChat::messageTime($params['time']); ?>">
                <?php echo OssnChat::replaceIcon($params['message']); ?>
            </div>
        </div>
    </div>
</div>