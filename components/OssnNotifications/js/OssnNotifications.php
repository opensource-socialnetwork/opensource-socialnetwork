/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
Ossn.NotificationBox = function($title, $meta, $type, height){
	 if(height == ''){
		 height = '540px';
	 }
	 if($type){
		$('.selected').addClass($type); 
	 }
      if($title){
	    $('.ossn-notifications-box').show()
	    $('.ossn-notifications-box').find('.type-name').html($title);
	  }
	  if($meta){
	   $('.ossn-notifications-box').find('.metadata').html($meta);
       $('.ossn-notifications-box').css('height', height);
	  }
};
Ossn.NotificationBoxClose = function(){
	    $('.ossn-notifications-box').hide()
	    $('.ossn-notifications-box').find('.type-name').html('');
	    $('.ossn-notifications-box').find('.metadata').html('<div style="height: 66px;"><div class="ossn-loading ossn-notification-box-loading"></div></div><div class="bottom-all"><a href="#">See All</a></div>');
		$('.ossn-notifications-box').css('height', '140px');
		$('.selected').attr('class', 'selected'); 

};
Ossn.NotificationShow = function($div){
	             $($div).attr('onClick', 'Ossn.NotificationClose(this)');
				 Ossn.PostRequest({
			      url: Ossn.site_url+"notification/notification",
			      beforeSend: function(request){
				  Ossn.NotificationBoxClose();
   	              $('.ossn-notifications-friends').attr('onClick', 'Ossn.NotificationFriendsShow(this)');
				  $('.ossn-notifications-messages').attr('onClick', 'Ossn.NotificationMessagesShow(this)');
				  Ossn.NotificationBox('Notifications', false, 'notifications');	
				  
			      },
			      callback: function(callback){
					var data = '';
					var height = ''; 
					 if(callback['type'] == 1){
						 data = callback['data'];
						 height = '540px';	 
					  } if(callback['type'] == 0){
						 data = callback['data'];
						 height = '100px';
					  }
					  Ossn.NotificationBox('Notifications', data, 'notifications', height);	  
 	  		       }
			     });
};


Ossn.NotificationClose = function($div){
			  Ossn.NotificationBoxClose();
			  $($div).attr('onClick', 'Ossn.NotificationShow(this)');
};

Ossn.NotificationFriendsShow = function($div){
	             $($div).attr('onClick', 'Ossn.NotificationFriendsClose(this)');
				 Ossn.PostRequest({
			      url: Ossn.site_url+"notification/friends",
			      beforeSend: function(request){
				   Ossn.NotificationBoxClose();	  
	                $('.ossn-notifications-notification').attr('onClick', 'Ossn.NotificationShow(this)');
				    $('.ossn-notifications-messages').attr('onClick', 'Ossn.NotificationMessagesShow(this)');
		          Ossn.NotificationBox('Friend Requests', false, 'firends');	
				  
			      },
			      callback: function(callback){
					 var data = '';
					 var height = '';
					  if(callback['type'] == 1){
						 data = callback['data'];
					  } if(callback['type'] == 0){
						 data = callback['data'];
						 height = '100px';
					  }
					  Ossn.NotificationBox('Friend Requests', data, 'firends', height);	
 	  		       }
			     });
};


Ossn.NotificationFriendsClose = function($div){
			  Ossn.NotificationBoxClose();
			  $($div).attr('onClick', 'Ossn.NotificationFriendsShow(this)');
};

Ossn.AddFriend = function($guid){
	     action = Ossn.site_url+"action/friend/add?user="+$guid;
		 Ossn.ajaxRequest({		  
			  url: action,
			  form: '#add-friend-'+$guid,
			 
			  beforeSend: function(request){
				 $('#notification-friend-item-'+$guid).find('form').hide();  
				 $('#ossn-nfriends-'+$guid).append('<div class="ossn-loading"></div>');
			  },
			  callback: function(callback){
				  if(callback['type'] == 1){
					$('#notification-friend-item-'+$guid).attr('style', 'background:#FFF9D7;');
					$('#ossn-nfriends-'+$guid).addClass('friends-added-text').html(callback['text']);
				  }
				  if(callback['type'] == 0){
				 $('#notification-friend-item-'+$guid).find('form').show();  
				 $('#ossn-nfriends-'+$guid).find('.ossn-loading').remove();  
				  }
			  }
			  });
};

Ossn.removeFriendRequset = function($guid){
	     action = Ossn.site_url+"action/friend/remove?user="+$guid;
		 Ossn.ajaxRequest({		  
			  url: action,
			  form: '#remove-friend-'+$guid,
			 
			  beforeSend: function(request){
				 $('#notification-friend-item-'+$guid).find('form').hide();  
				 $('#ossn-nfriends-'+$guid).append('<div class="ossn-loading"></div>');
			  },
			  callback: function(callback){
				  if(callback['type'] == 1){
					$('#notification-friend-item-'+$guid).attr('style', 'background:#FFF9D7;');
					$('#ossn-nfriends-'+$guid).addClass('friends-added-text').html(callback['text']);
				  }
				  if(callback['type'] == 0){
				 $('#notification-friend-item-'+$guid).find('form').show();  
				 $('#ossn-nfriends-'+$guid).find('.ossn-loading').remove();  
				  }
			  }
			  });
};

Ossn.NotificationMessagesShow = function($div){
	             $($div).attr('onClick', 'Ossn.NotificationMessagesClose(this)');
				 Ossn.PostRequest({
			      url: Ossn.site_url+"notification/messages",
			      beforeSend: function(request){
				  Ossn.NotificationBoxClose();	  
	              $('.ossn-notifications-notification').attr('onClick', 'Ossn.NotificationShow(this)');
   	              $('.ossn-notifications-friends').attr('onClick', 'Ossn.NotificationFriendsShow(this)');

			      },
			      callback: function(callback){
					  var data = '';
					  var height = '';   
					  if(callback['type'] == 1){
						 data = callback['data'];
						 height = '';
					  } if(callback['type'] == 0){
						 data = callback['data'];
						 height = '100px';
					  }
					  Ossn.NotificationBox('Messages', data, 'messages', height);	
 	  		       }
			     });
};


Ossn.NotificationMessagesClose = function($div){
			  Ossn.NotificationBoxClose();
			  $($div).attr('onClick', 'Ossn.NotificationMessagesShow(this)');
};
Ossn.NotificationsCheck = function(){
Ossn.PostRequest({
			  url: Ossn.site_url+"notification/count",
			  callback: function(callback){
				$notification = $('#ossn-notif-notification');
				$notification_count = $notification.find('.ossn-notification-container');
														 
				$friends = $('#ossn-notif-friends');
				$friends_count = $friends.find('.ossn-notification-container');
				
				$messages = $('#ossn-notif-messages');
				$messages_count = $messages.find('.ossn-notification-container');
								
				if(callback['notifications']){
				   	if(callback['notifications'] > 0){
                       $notification_count.html(callback['notifications']);
					   $notification.find('.ossn-icon').addClass('ossn-icons-topbar-notifications-new');
					   $notification_count.attr('style', ' display:inline-block;');
                    }
                    if(callback['notifications'] <= 0){
                       $notification_count.html('');
					   $notification.find('.ossn-icon').removeClass('ossn-icons-topbar-notifications-new');
					   $notification.find('.ossn-icon').addClass('ossn-icons-topbar-notification');
					   $notification_count.hide();       
                    }
				} 
				
				if(callback['messages']){
					if(callback['messages'] > 0){
  				      $messages_count.html(callback['messages']);
					  $messages.find('.ossn-icon').addClass('ossn-icons-topbar-messages-new');
					  $messages_count.attr('style', ' display:inline-block;');
					} 
					if(callback['messages'] <= 0) {
					  $messages_count.html('');
					  $messages.find('.ossn-icon').removeClass('ossn-icons-topbar-messages-new');
					 $messages.find('.ossn-icon').addClass('ossn-icons-topbar-messages');			  
					  $messages_count.hide();	
					}
				} 
				
				if(callback['friends']){
                  if(callback['friends'] > 0){
				      $friends_count.html(callback['friends']);
					  $friends.find('.ossn-icon').addClass('ossn-icons-topbar-friends-new');
					  $friends_count.attr('style', ' display:inline-block;');
                   }
                   if(callback['friends'] <= 0){
				      $friends_count.html('');
					  $friends.find('.ossn-icon').removeClass('ossn-icons-topbar-friends-new');
					  $friends.find('.ossn-icon').addClass('ossn-icons-topbar-friends');
					  $friends_count.hide();                   
                   }
				} 				
}
			  }); 	
};
Ossn.RegisterStartupFunction(function(){
  $(document).ready(function () {
     setInterval(function(){Ossn.NotificationsCheck()}, 5000);     
    });
});

