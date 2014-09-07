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
define('__OSSN_MESSAGES__', ossn_route()->com.'OssnMessages/');
require_once(__OSSN_MESSAGES__.'classes/OssnMessages.php');

function ossn_messages(){
  ossn_extend_view('css/ossn.default', 'components/OssnMessages/css/message');
  ossn_register_page('messages', 'ossn_messages_page');
  ossn_extend_view('js/opensource.socialnetwork', 'components/OssnMessages/js/OssnMessages');

  if(ossn_isLoggedin()){
    ossn_register_action('message/send', __OSSN_MESSAGES__.'actions/message/send.php');	  
	  
    $user_loggedin = ossn_loggedin_user();
    $icon = ossn_site_url('components/OssnMessages/images/messages.png');
    ossn_register_sections_menu('newsfeed', array(
								   'text' => ossn_print('user:messages'), 
								   'url' => ossn_site_url('messages/all'), 
								   'section' => 'links',
								   'icon' => $icon
								   ));	

  }	
}

function ossn_messages_page($pages){
	if(!ossn_isLoggedin()){
		ossn_error_page();
	}
    $OssnMessages = new OssnMessages;
	$page = $pages[0];
    if(empty($page)){
		$page = 'messages';
	}
	switch($page){
		case 'message':
		$username = $pages[1];
        if(!empty($username)){
		   $user = ossn_user_by_username($username);
		   $OssnMessages->markViewed($user->guid, ossn_loggedin_user()->guid);
		   $params['data'] = $OssnMessages->get(ossn_loggedin_user()->guid, $user->guid);
		   $params['user'] = $user;
		   $params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
 		   $contents = array(
						'content' =>  ossn_view('components/OssnMessages/pages/view', $params),
						);
	       $content = ossn_set_page_layout('media', $contents);
           echo ossn_view_page($title, $content); 

		} else {
            ossn_error_page();
         }
  		break;
		case 'all':
		   $params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
		   $active = $params['recent'][0];  
		   if($active->message_to == ossn_loggedin_user()->guid){
			    $getuser = $active->message_from;
		   }
		   if($active->message_from  == ossn_loggedin_user()->guid){
			   $getuser = $active->message_to;
		   }
		   $user = ossn_user_by_guid($getuser);
		   $OssnMessages->markViewed($getuser, ossn_loggedin_user()->guid);
		   $params['data'] = $OssnMessages->get(ossn_loggedin_user()->guid, $getuser);
		   
		   $params['user'] = $user;
		   
 		   $contents = array(
						'content' =>  ossn_view('components/OssnMessages/pages/messages', $params),
						);
	       $content = ossn_set_page_layout('media', $contents);
           echo ossn_view_page($title, $content); 
  		break;	
		case 'getnew':
		 $username = $pages[1];
		 $guid = ossn_user_by_username($username)->guid;
         $messages = $OssnMessages->getNew($guid, ossn_loggedin_user()->guid);
         foreach($messages as $message){
		 $user = ossn_user_by_guid($message->message_from);
         $message = $message->message; 
         $params['user'] = $user;
         $params['message'] = $message;
         echo ossn_view('components/OssnMessages/templates/message-send', $params);
		 }
		 $check = get_object_vars($messages);
		 if(!empty($check)){
			$OssnMessages->markViewed($guid, ossn_loggedin_user()->guid);
			echo '<script>Ossn.playSound();</script>';
		 }
	    break;
		
		 case 'getrecent':
     	 $params['recent'] = $OssnMessages->recentChat(ossn_loggedin_user()->guid);
		 echo ossn_view('components/OssnMessages/templates/message-with', $params);
	   break;
	   default:
	     ossn_error_page();
	   break;
		
	}
}
ossn_register_callback('ossn', 'init', 'ossn_messages');
