<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$friends = ossn_loggedin_user()->getFriends();
foreach($friends as $friend){
    $vars['entity'] = $friend;
    $vars['icon'] = $friend->iconURL()->smaller;
	$have = 1;
    echo ossn_view('components/OssnChat/views/OssnChat/friends/friend-item', $vars);
}
if($have !== 1){
  echo '<div class="ossn-chat-none">No one is online</div>';	
}