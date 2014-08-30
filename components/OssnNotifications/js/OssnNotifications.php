//<script>
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
