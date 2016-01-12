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
$friend = $params['entity'];
?>
<div class="friends-list-item" onClick="Ossn.ChatnewTab(<?php echo $friend->guid; ?>);">
    <div class="friends-item-inner">
        <div class="icon"><img src="<?php echo $params['icon']; ?>"/></div>
        <div class="name"><?php echo $friend->fullname; ?></div>
        <div class="ossn-chat-icon-online"></div>
    </div>
</div>
