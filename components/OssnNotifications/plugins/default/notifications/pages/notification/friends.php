<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="messages-inner">
    <div class="notification-friends">
        <?php
        if ($params['friends']) {
            $confirmbutton = ossn_print('ossn:notifications:friendrequest:confirmbutton');
            $denybutton = ossn_print('ossn:notifications:friendrequest:denybutton');
            foreach ($params['friends'] as $users) {
                $baseurl = ossn_site_url();
                $url = $users->profileURL();
                $img = "<img class='user-icon-small' src='{$users->iconURL()->small}' />";
                $messages[] = "<li id='notification-friend-item-{$users->guid}'>
		              <div class='ossn-notifications-friends-inner'>
		                <div class='image'>{$img}</div> 
		                <div class='notfi-meta'>
		                
						<a href='{$url}' class='user'>{$users->fullname}</a>
						  <div class='controls' id='ossn-nfriends-{$users->guid}'>
						  <script>
						  Ossn.AddFriend($users->guid); 
						  Ossn.removeFriendRequset($users->guid);
						  </script>
						  <form id='add-friend-{$users->guid}'>
                           <input class='btn btn-primary btn-sm' type='submit' value='{$confirmbutton}' />
						   </form>
						   	<form id='remove-friend-{$users->guid}'>
						   <input class='btn btn-default btn-sm' type='submit' value='{$denybutton}' />
						   </form>

                           </div>
  
						</div>
						</div>
						</li>";
            }
        }
        echo implode('', $messages);
        ?>
    </div>
</div>
<div class="bottom-all">
    <!-- <a href="#">See All</a> -->
</div>
