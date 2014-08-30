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
 
/**
 * Check if the user is logged in or not
 *
 * @return bool
 */ 
function ossn_isLoggedin(){
  $user = forceObject($_SESSION['OSSN_USER']);
  if(isset($user)  && is_object($user) && $user instanceof OssnUser){
	  return true;	
  }
return false;
}
/**
 * Check if the admin is logged in or not
 *
 * @return bool
 */ 
function ossn_isAdminLoggedin(){
  $user = forceObject($_SESSION['OSSN_USER']);
  if(isset($user) && is_object($user) && $user instanceof OssnUser){
	   if($user->type == 'admin'){
	      return true;	
	   }
  }
return false;
}
/**
 * Get a logged in user entity
 *
 * @return object
 */ 
function ossn_loggedin_user(){
  if(ossn_isLoggedin()){
	  return forceObject($_SESSION['OSSN_USER']);  
  }
}
/**
 * Get a user by username
 *
 * @param $username 'username' of user
 *
 * @return object
 */ 
function ossn_user_by_username($username){
   $user = new OssnUser;
   $user->username = $username;
   return $user->getUser();
}
/**
 * Get a user by user id
 *
 * @param $guid 'guid' of user
 *
 * @return object
 */ 
function ossn_user_by_guid($guid){
 	  $user = new OssnUser;
	  $user->guid = $guid;
	  return $user->getUser();
}
/**
 * Get a user friends
 *
 * @param $guid 'guid' of user
 *
 * @return object
 */ 
function get_user_friends($guid){
	$friends = new OssnUser;
	return $friends->getFriends($guid);
}
/**
 * Check if the user is from with other user
 *
 * @param $guid 'guid' of user 
 *        $friend guid of other user
 *
 * @return bool
 */ 
function ossn_user_is_friend($guid, $friend){
	$friends = new OssnUser;
    if($friends->isFriend($guid, $friend)){
	 return true;	
	}
return false;	
}
/**
 * Add user a friend
 *
 * @param $form  'guid' of user 
 *        $to guid of other user
 *
 * @return bool
 */ 
function ossn_add_friend($from, $to){
	$add = new OssnUser;
	if($add->sendRequest($from, $to)){
	  return true;	
	}
return false;	
}
/**
 * Remove user from friend list
 *
 * @param $form  'guid' of user 
 *        $to guid of other user
 *
 * @return bool
 */
function ossn_remove_friend($from, $to){
	$remove = new OssnUser;
	if($remove->deleteFriend($from, $to)){
	  return true;	
	}
return false;	
}
/**
 * Get total site users
 *
 * @return object
 */
function ossn_total_site_users(){
	$users = new OssnUser;
	return count(get_object_vars($users->getSiteUsers()));
}
/**
 * Get total online users
 *
 * @return int
 */
function ossn_total_online(){
   $users = new OssnUser;
   return $users->online_total();
}
/**
 * Get friends suggestion
 *
 * @param $guid 'guid' of user 
 *
 * @return bool
 */
function ossn_friends_suggestion($guid){
  $user = new OssnUser;
  $friends = $user->getFriends($guid);
   foreach($friends as $friend){
     $friends_friend[] = $user->getFriends($friend->guid);
   }
	return $friends_friend;
}
/**
 * Update user last activity time
 *
 * @return void
 */
function update_last_activity(){
   $update = new OssnUser;
   $update->update_last_activity();
}
/**
 * Convert time to to user recognize from
 *
 * @param $tm => time stamp
 *
 * @return bool
 */
function ossn_user_friendly_time($tm, $rcs = 0) {
  $cur_tm = time(); 
  $dif = $cur_tm - $tm;
  $pds = array(
			   'second',
			   'minute',
			   'hour',
			   'day',
			   'week',
			   'month',
			   'year',
			   'decade');
  $lngh = array(1,60,3600,86400,604800,2630880,31570560,315705600);

  for ($v = count($lngh) - 1; ($v >= 0) && (($no = $dif / $lngh[$v]) <= 1); $v--);
    if ($v < 0)
      $v = 0;
  $_tm = $cur_tm - ($dif % $lngh[$v]);

  $no = ($rcs ? floor($no) : round($no)); // if last denomination, round

  if ($no != 1)
    $pds[$v] .= 's';
  $x = $no . ' ' . $pds[$v];

  if (($rcs > 0) && ($v >= 1))
    $x .= ' ' . $this->ossn_user_friendly_time($_tm, $rcs - 1);

  return $x.' ago';
}
