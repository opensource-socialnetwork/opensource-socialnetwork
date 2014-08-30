<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$friends = $params['user']->getFriends(); 
echo '<div class="ossn-profile-modlue-friends">';
if(is_array($friends)){
foreach($params['user']->getFriends() as $friend){
  $url = ossn_site_url("avatar/{$friend->username}/large");
  echo "<img src='{$url}' />";	
}
} else {
 echo '<h3>'.ossn_print('no:friends').'</h3>';	
}
echo '</div>';