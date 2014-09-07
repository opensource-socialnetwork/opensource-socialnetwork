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

define('__OSSN_NOTIF__', ossn_route()->com.'OssnNotifications/');
require_once(__OSSN_NOTIF__.'classes/OssnNotifications.php');
function ossn_notifications(){
  //css
  ossn_extend_view('css/ossn.default', 'components/OssnNotifications/css/notifications');
  //js
  ossn_extend_view('js/opensource.socialnetwork', 'components/OssnNotifications/js/OssnNotifications');
  
  //pages
  ossn_register_page('notification', 'ossn_notification_page');
  ossn_register_page('notifications', 'ossn_notifications_page');
  
  //callbacks
  ossn_register_callback('like', 'created', 'ossn_notification_like');
  ossn_register_callback('wall', 'post:created', 'ossn_notification_walltag');
  ossn_register_callback('annotations', 'created', 'ossn_notification_annotation');
}
function ossn_notification_annotation($type, $event_type, $params){
	$notification = new OssnNotifications;
	$notification->add(
					   $params['type'], 
					   $params['owner_guid'], 
					   $params['subject_guid'],
					   $params['annotation_guid']
					   ); 
}
function ossn_notification_page($pages){
	$page = $pages[0];
        if(empty($page)){
		ossn_error_page();
	}
	header('Content-Type: application/json'); 
	switch($page){
		case 'notification':
        $get = new  OssnNotifications;
		 $notifications['notifications'] = $get->get(ossn_loggedin_user()->guid, true);
		 $notifications['seeall'] = ossn_site_url("notifications/all");
		 if(!empty($notifications['notifications'])){
		 $data = ossn_view('components/OssnNotifications/pages/notification/notification', $notifications);
		 echo json_encode(array(
					'type' => 1, 
					'data' => $data,
		  ));
		 } else {
		   echo json_encode(array(
					'type' => 0, 
					'data' => '<div class="ossn-no-notification">Nothing to show</div>',
					)); 
		 }
		break;
		case 'friends':
		 $friends['friends'] = ossn_loggedin_user()->getFriendRequests();
		 $friends_count = count($friends['friends']);
		 if($friends_count > 0 && !empty($friends['friends'])){
                  $data = ossn_view('components/OssnNotifications/pages/notification/friends', $friends);
		 echo json_encode(array(
					'type' => 1, 
					'data' => $data,
					 ));
		 } else {
		   echo json_encode(array(
					'type' => 0, 
					'data' => '<div class="ossn-no-notification">Nothing to show</div>',
					 ));
		 }
		break;	
		
		case 'messages':
		 $OssnMessages = new OssnMessages;
     	 $params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
		 $data = ossn_view('components/OssnMessages/templates/message-with-notifi', $params);
		 if(!empty($params['recent'])){	 
		 echo json_encode(array(
					'type' => 1, 
					'data' => $data,
					 ));
		 } else {
		   echo json_encode(array(
					'type' => 0, 
					'data' => '<div class="ossn-no-notification">Nothing to show</div>',
					 ));
		 }
		break;	
		case 'read';
		if(!empty($pages[1])){
			$notification = new OssnNotifications;
			$guid = $notification->getbyGUID($pages[1]);
			if($guid->owner_guid == ossn_loggedin_user()->guid){
			   $notification->setViewed($pages[1]);
			   $url = urldecode(input('notification'));
			   header("Location: {$url}");
			} else {
			   redirect();
			} 
		} else {
		  redirect();	
		}
		break;
		default:
		 ossn_error_page();
		break;
		
	}
}
function ossn_notifications_page($pages){
	$page = $pages[0];
    if(empty($page)){
		return false;
	}
	switch($page){
		case 'all':
		$title = 'Notifications';
        $contents = array(
			'content' =>  ossn_view('components/OssnNotifications/pages/all'),
			);
	    $content = ossn_set_page_layout('media', $contents);
        echo ossn_view_page($title, $content);	
		
		break;
		default:
		 ossn_error_page();
		break;
		
	}
}
function ossn_notification_like($type, $event_type, $params){
	$notification = new OssnNotifications;
	$notification->add(
					   $params['type'], 
					   $params['owner_guid'], 
					   $params['subject_guid'],
					   $params['subject_guid']
					   );
}
function ossn_notification_walltag($type, $ctype, $params){
	$notification = new OssnNotifications;
	if(is_array($params['friends'])){		
	foreach($params['friends'] as $friend){
	  if($params['poster_guid'] > 0
				 && $params['subject_guid'] > 0
				 && $friend > 0 ){
	   $notification->add(
			        'wall:friends:tag', 
				$params['poster_guid'], 
				$params['subject_guid'],
				NULL,
				$friend
				);
	  }
	}
	}
}

function OssnMessages(){
  $OssnMessages = new OssnMessages;
  return $OssnMessages; 	
}
ossn_register_callback('ossn', 'init', 'ossn_notifications');
