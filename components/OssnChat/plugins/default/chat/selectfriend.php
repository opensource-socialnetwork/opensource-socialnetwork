<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$user = $params['user'];
if (OssnChat::getChatUserStatus($user->guid) == 'online') {
    $status = 'ossn-chat-icon-online';
} else {
    $status = 'ossn-chat-icon-offline';
}
$messages = ossn_chat()->getNew($user->guid, ossn_loggedin_user()->guid);
$total = '';
if ($messages) {
    $total = get_object_vars($messages);
    $total = count($total);
}
$tab_class = '';
$style = '';

if ($total > 0) {
    $tab_class = 'ossn-chat-tab-active';
    $style = 'style="display:block;"';
}

?>
<!-- Item -->
<div class="friend-tab-item" id="ftab-i<?php echo $user->guid; ?>">

    <!-- $arsalan.shah tab container start -->
    <div class="tab-container">

        <div class="ossn-chat-tab-titles" id="ftab-t<?php echo $user->guid; ?>"
             onclick="Ossn.ChatCloseTab(<?php echo $user->guid; ?>);">
            <div class="text ossn-chat-inline-table"><?php echo $user->fullname; ?></div>
            <div class="options ossn-chat-inline-table">
                <div class="ossn-chat-inline-table ossn-chat-icon-expend" title="Popout Chat"
                     onclick="Ossn.ChatExpand('<?php echo $user->username; ?>')"></div>
                <div class="ossn-chat-inline-table ossn-chat-tab-close" id="ftab-c<?php echo $user->guid; ?>"
                     onclick="Ossn.ChatTerminateTab(<?php echo $user->guid; ?>);"> X
                </div>
            </div>
        </div>
 		<script>
			Ossn.ChatLoading(<?php echo $user->guid; ?>);
	 	</script>
        <!-- $arsalan.shah datatstart -->
        <div class="data" id="ossn-chat-messages-data-<?php echo $user->guid; ?>">
            <?php
		$messages_meta  = ossn_chat()->getWith(ossn_loggedin_user()->guid, $user->guid);
		$messages_count = ossn_chat()->getWith(ossn_loggedin_user()->guid, $user->guid, true);
		echo ossn_view_pagination($messages_count, 10, array(
			'offset_name' => "offset_message_xhr_with_{$user->guid}",															 
		));			
            if ($messages_meta) {
                foreach ($messages_meta as $message) {
			$deleted = false;
			$class = '';
			if(isset($message->is_deleted) && $message->is_deleted == true){
				$deleted = true;
				$class = ' ossn-message-deleted';
			}							
			$vars['message'] = ossn_message_print($message->message);
			$vars['time'] = $message->time;
			$vars['id'] = $message->id;
			$vars['deleted'] = $deleted;
			$vars['class'] = $class;	
			$vars['instance'] = (clone $message);
                    	if (ossn_loggedin_user()->guid == $message->message_from) {
                      	  	echo ossn_plugin_view('chat/message-item-send', $vars);
                   	 } else {
                        	$vars['reciever'] = ossn_user_by_guid($message->message_from);
                        	echo ossn_plugin_view('chat/message-item-received', $vars);
                    	}
                }
            }
            ?>

        </div>
        <!-- $arsalan.shah datatend -->

    </div>
    <!-- $arsalan.shah tab container end -->
    <div class="inner friend-tab <?php echo $tab_class; ?>" id="ftab<?php echo $user->guid; ?>"
         onclick="Ossn.ChatOpenTab(<?php echo $user->guid; ?>);">
        <script>Ossn.ChatSendForm(<?php echo $user->guid;?>);</script>
        <form autocomplete="off" id="ossn-chat-send-<?php echo $user->guid; ?>">
            <input type="text" name="message" autocomplete="off" id="ossn-chat-input-<?php echo $user->guid; ?>"/>
            <div class="ossn-chat-message-sending">
               <div class="ossn-chat-sending-icon"></div>
            </div>
            <div class="ossn-chat-inline-table ossn-chat-icon-smile-set">
                <?php if(com_is_active('OssnSmilies')){ ?>
                    <div class="ossn-chat-icon-smile" onClick="Ossn.OpenEmojiBox('#ossn-chat-input-' + <?php echo $user->guid; ?>);"></div>
                <?php } ?>
            </div>
             <?php echo ossn_plugin_view('input/security_token'); ?>
            <input type="hidden" name="to" value="<?php echo $user->guid; ?>"/>
        </form>
        <div class="ossn-chat-new-message" <?php echo $style; ?>><?php echo $total; ?></div>
        <div id="ossnchat-ustatus-<?php echo $user->guid; ?>" class="<?php echo $status; ?>">
            <div class="ossn-chat-inner-text">
                <?php echo $user->fullname; ?>
            </div>
        </div>
    </div>

</div>
<!-- Item End -->
    
