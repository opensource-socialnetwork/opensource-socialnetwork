/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$new_all = ossn_chat()->getNewAll(array('message_from'));
$allfriends = OssnChat::AllNew();

foreach(OssnChat::GetActiveSessions() as $friend){
 $messages = ossn_chat()->getNew($friend, ossn_loggedin_user()->guid);
 $construct_active[$friend] =  array(
								'status' => $status
						    	);
  foreach($messages as $message){
    if(ossn_loggedin_user()->guid == $message->message_from){
	    $vars['message'] = $message->message;
	    $vars['time'] = $message->time;	
		$messageitem =  ossn_view('components/OssnChat/views/OssnChat/message-item-send', $vars); 
	} else {
		$vars['reciever'] = ossn_user_by_guid($message->message_from);
		$vars['message'] = $message->message;
		$vars['time'] = $message->time;
		$messageitem =  ossn_view('components/OssnChat/views/OssnChat/message-item-received', $vars); 	 
	}
   $total = get_object_vars($messages);	
   $new_messages[] = array(
						'fid' => $friend,
						'message' => $messageitem,
						'total' => count($total)
					);	 
   }
   
   if(OssnChat::getChatUserStatus($friend, 10) == 'online'){
	 $status = 'ossn-chat-icon-online';   
   } else {
	 $status = 'ossn-chat-icon-offline';   
   }
   $construct_active[$friend] = array('status' => $status);
}
$api = json_encode(array(
					   'active_friends' =>  $construct_active, 
					   'allfriends' => $allfriends,
					   'friends' => array(
										'online' => ossn_chat()->countOnlineFriends('', 10),
										'data' =>  ossn_view('components/OssnChat/views/OssnChat/friendslist'),
										),
					   'newmessages' => $new_messages,
					   'all_new' => $new_all,
					   
					   ));

echo 'var OssnChat = ';
echo preg_replace('/[ ]{2,}/', ' ', $api);
echo ';';
?>

/**
 * Count Online friends and put then in friends list
 *
 * @params OssnChat['friends'] Array
 */	
$friends_online = $('.ossn-chat-online-friends-count').find('span');
if(OssnChat['friends']['online'] > $friends_online.text() || OssnChat['friends']['online'] < $friends_online.text()){
   $('.friends-list').find('.data').html(OssnChat['friends']['data']);
}
$friends_online.html(OssnChat['friends']['online']);

/**
 * Reset the user status
 *
 * @params OssnChat['active_friends'] Array
 */	
if(OssnChat['active_friends']){
$.each(OssnChat['active_friends'], function(key, data){
               $('#ossnchat-ustatus-'+key).attr('class', data['status']);
});
}
/**
 * Add all friends in sidebar
 *
 * @params OssnChat['active_friends'] Array
 */	
if(OssnChat['allfriends']){
  $.each(OssnChat['allfriends'], function(key, data){
       var $item  = $(".ossn-chat-windows-long .inner").find('#friend-list-item-'+data['guid']);
       if($item){
          $item.find('.ustatus').removeClass('ossn-chat-icon-online');
          $item.find('.ustatus').addClass(data['status']);
        } else {
         var appendata = '<div class="friends-list-item" id="friend-list-item-'+data['guid']+'" onClick="Ossn.ChatnewTab('+data['guid']+');"><div class="friends-item-inner"><div class="icon"><img src="'+data['icon']+'" /></div> <div class="name">'+data['name']+'</div><div class="'+data['status']+' ustatus"></div> </div></div>';    
          $(".ossn-chat-windows-long .inner").append(appendata);
        }
  });
}

/**
 * Check if there is new message then put them in tab
 *
 * @params OssnChat['newmessages'] Array
 */	
if(OssnChat['newmessages']){
$.each(OssnChat['newmessages'], function(key, data){
            if($('.ossn-chat-base').find('#ftab-i'+data['fid'])){
                   
                      $totalelement = $('#ftab-i'+data['fid']).find('.ossn-chat-new-message');
                      if(data['total'] > 0 &&  data['total'] != $totalelement.text()){
                           $('#ftab-i'+data['fid']).find('.data').append(data['message']); 
                           
                           if($('.ossn-chat-base').find('#ftab-i'+data['fid']).find('.tab-container').is(":not(:visible)")){
                               $('#ftab-i'+data['fid']).find('#ftab'+data['fid']).addClass('ossn-chat-tab-active');
                               $totalelement.html(data['total']);
                               $totalelement.show();
                           } else {
                               Ossn.ChatMarkViewed(data['fid']);
                           }
                           Ossn.playSound();
                           Ossn.ChatScrollMove(data['fid']);

                       }
                 
            }
});
}
/**
 * Open new tab on new message
 *
 * @params OssnChat['all_new'] Array
 */	
if(OssnChat['all_new']){
$.each(OssnChat['all_new'], function(key, data){
     if($(".ossn-chat-containers").children(".friend-tab-item").size() < 4){   						   
         var $friend = data['message_from'];
         Ossn.ChatnewTab($friend);         
           if(!$('#ftab-i'+$user)){   						     
              Ossn.playSound();
              Ossn.ChatScrollMove(data['message_from']);
           }
     }
});
}