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
$friend = $params['entity'];
if ($friend->isOnline(10)) {
    $status = 'ossn-chat-icon-online';
} else {
    $status = '';
}
?>
<div class="friends-list-item" id="friend-list-item-<?php echo $friend->guid; ?>"
     onClick="Ossn.ChatnewTab(<?php echo $friend->guid; ?>);" data-toggle="tooltip" title="<?php  echo $friend->fullname;?>">
    <div class="friends-item-inner">
        <div class="icon"><img class="user-icon-small <?php echo $status; ?> ustatus" src="<?php echo $params['icon']; ?>"/></div>
    </div>
</div>
