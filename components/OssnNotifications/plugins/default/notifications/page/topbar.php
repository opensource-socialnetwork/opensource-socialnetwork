<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright (C) OpenTeknik LLC
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */

//declear empty variables;
$friends_c = '';
//init classes
$notification = new OssnNotifications;
$count_notif = $notification->countNotification(ossn_loggedin_user()->guid);

if(class_exists('OssnMessages')){
	$messages = new OssnMessages;
	$count_messages = $messages->countUNREAD(ossn_loggedin_user()->guid);
} else {
	$messages = false;
}

$friends = ossn_loggedin_user()->getFriendRequests();
if ($friends) {
    $friends_c = count($friends);
}
?>
<li id="ossn-notif-friends">
    <a onClick="Ossn.NotificationFriendsShow(this);" class="ossn-notifications-friends" href="javascript:void(0);" >
                       <span>
                      <?php if ($friends_c > 0) { ?>
                          <span class="ossn-notification-container"><?php echo $friends_c; ?></span>
                          <div class="ossn-icon ossn-icons-topbar-friends-new"><i class="fa fa-users"></i></div>
                      <?php } else { ?>
                          <span class="ossn-notification-container d-none"></span>
                          <div class="ossn-icon ossn-icons-topbar-friends"><i class="fa fa-users"></i></div>
                      <?php } ?>
                       </span>
    </a>
</li>
<?php if($messages){ ?>
<li id="ossn-notif-messages">
    <a onClick="Ossn.NotificationMessagesShow(this)" href="javascript:void(0);" class="ossn-notifications-messages" >
    
                       <span>
                        <?php if ($count_messages > 0) { ?>
                            <span class="ossn-notification-container"><?php echo $count_messages; ?></span>
                            <div class="ossn-icon ossn-icons-topbar-messages-new"><i class="fa fa-envelope"></i></div>
                        <?php } else { ?>
                            <span class="ossn-notification-container d-none"></span>
                            <div class="ossn-icon ossn-icons-topbar-messages"><i class="fa fa-envelope"></i></div>
                        <?php } ?>
                       </span>
    </a></li>
   <?php } ?> 
<li id="ossn-notif-notification">
    <a href="javascript:void(0);" class="ossn-notifications-notification" onClick="Ossn.NotificationShow(this)"> 
                       <span>
                       <?php if ($count_notif > 0) { ?>
                           <span class="ossn-notification-container"><?php echo $count_notif; ?></span>
                           <div class="ossn-icon ossn-icons-topbar-notifications-new"><i class="fa fa-globe-americas"></i></div>
                       <?php } else { ?>
                           <span class="ossn-notification-container d-none"></span>
                           <div class="ossn-icon ossn-icons-topbar-notification"><i class="fa fa-globe-americas"></i></div>
                       <?php } ?>
                       </span>
    </a>
 
</li>
  <div id="notificationBox" class="dropdown">
  		<div class="dropmenu-topbar-icons ossn-notifications-box">
        	     <div class="selected"></div>
            	 <div class="type-name"> <?php echo ossn_print('notifications'); ?> </div>
            	<div class="metadata">
                	<div style="height: 66px;">
                   		 	<div class="ossn-loading ossn-notification-box-loading"></div>
               	 	</div>
                	<div class="bottom-all">
                    	<a href="#"><?php echo ossn_print('see:all'); ?></a>
                	</div>
             </div>
   		</div> 
   </div>
