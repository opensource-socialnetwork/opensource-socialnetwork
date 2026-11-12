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
$friends = $params['user']->getFriends(false, array(
		'limit' => 9
));

$has_friends = !empty($friends);
$container_class = $has_friends ? 'ossn-profile-module-friends has-friends' : 'ossn-profile-module-friends no-friends';

echo '<div class="' . $container_class . ' text-center">';
if($has_friends) {
		foreach($friends as $friend) {
				$url       = $friend->iconURL()->large;
				$profile   = $friend->profileURL();
				$user_name = $friend->fullname;
				echo "<a href='{$profile}'>
          <div class='user-image'>
            <img src='{$url}' title='{$friend->fullname}'/>
			<div class='user-name'>{$user_name}</div>
		   </div>
		</a>";
		}
} else {
		echo '<h3 class="no-friends-text">' . ossn_print('no:friends') . '</h3>';
}
echo '</div>';