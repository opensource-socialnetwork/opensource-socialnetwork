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
$friend = $params['entity'];
if ($friend->isOnline(10)) {
    $status = 'ossn-chat-icon-online';
} else {
    $status = '';
}
?>
<div class="friends-list-item" id="friend-list-item-<?php echo $friend->guid; ?>"
     onClick="Ossn.ChatnewTab(<?php echo $friend->guid; ?>);">
    <div class="friends-item-inner">
        <div class="icon"><img class="<?php echo $status; ?> ustatus" src="<?php echo $params['icon']; ?>"/></div>
        <div class="name"><?php echo $friend->fullname; ?></div>
    </div>
</div>
