//<script>
/**
 * 	Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.NotificationBox = function($title, $meta, $type, height, $extra) {
	//trigger notification box again:
  	Ossn.NotificationsCheck();
    
    $extra = $extra || '';
    if (height == '') {
        //height = '540px';
    }
    if ($type) {
        $('.selected').addClass($type);
    }
    if ($title) {
        $('.ossn-notifications-box').show()
        $('.ossn-notifications-box').find('.type-name').html($title+$extra);
    }
    if ($meta) {
        $('.ossn-notifications-box').find('.metadata').html($meta);
        $('.ossn-notifications-box').css('height', height);
    }
};
Ossn.NotificationBoxClose = function() {
   $('.ossn-notifications-box').hide()
    $('.ossn-notifications-box').find('.type-name').html('');
    $('.ossn-notifications-box').find('.metadata').html('<div><div class="ossn-loading ossn-notification-box-loading"></div></div><div class="bottom-all">---</div>');
    //$('.ossn-notifications-box').css('height', '140px');
    $('.selected').attr('class', 'selected');

};
Ossn.NotificationShow = function($div) {
	$('.ossn-notifications-box').show();
    $($div).attr('onClick', 'Ossn.NotificationClose(this)');
    Ossn.PostRequest({
        url: Ossn.site_url + "notification/notification",
        action:false,
        beforeSend: function(request) {
            Ossn.NotificationBoxClose();
            $('.ossn-notifications-friends').attr('onClick', 'Ossn.NotificationFriendsShow(this)');
            $('.ossn-notifications-messages').attr('onClick', 'Ossn.NotificationMessagesShow(this)');
            Ossn.NotificationBox(Ossn.Print('notifications'), false, 'notifications');
        },
        callback: function(callback) {
            var data = '';
            var height = '';
            if (callback['type'] == 1) {
                data = callback['data'];
               // height = '540px';
            }
            if (callback['type'] == 0) {
                data = callback['data'];
                //height = '100px';
            }
            Ossn.NotificationBox(Ossn.Print('notifications'), data, 'notifications', height,  callback['extra']);
        }
    });
};


Ossn.NotificationClose = function($div) {
    Ossn.NotificationBoxClose();
    $($div).attr('onClick', 'Ossn.NotificationShow(this)');
};

Ossn.NotificationFriendsShow = function($div) {
	$('.ossn-notifications-box').show();
    $($div).attr('onClick', 'Ossn.NotificationFriendsClose(this)');
    Ossn.PostRequest({
        url: Ossn.site_url + "notification/friends",
        action:false,
        beforeSend: function(request) {
            Ossn.NotificationBoxClose();
            $('.ossn-notifications-notification').attr('onClick', 'Ossn.NotificationShow(this)');
            $('.ossn-notifications-messages').attr('onClick', 'Ossn.NotificationMessagesShow(this)');
            Ossn.NotificationBox(Ossn.Print('friend:requests'), false, 'firends');

        },
        callback: function(callback) {
            var data = '';
            var height = '';
            if (callback['type'] == 1) {
                data = callback['data'];
            }
            if (callback['type'] == 0) {
                data = callback['data'];
                //height = '100px';
            }
            Ossn.NotificationBox(Ossn.Print('friend:requests'), data, 'firends', height);
        }
    });
};


Ossn.NotificationFriendsClose = function($div) {
    Ossn.NotificationBoxClose();
    $($div).attr('onClick', 'Ossn.NotificationFriendsShow(this)');
};

Ossn.AddFriend = function($guid) {
    action = Ossn.site_url + "action/friend/add?user=" + $guid;
    Ossn.ajaxRequest({
        url: action,
        form: '#add-friend-' + $guid,
        action:true,

        beforeSend: function(request) {
            $('#notification-friend-item-' + $guid).find('form').hide();
            $('#ossn-nfriends-' + $guid).append('<div class="ossn-loading"></div>');
        },
        callback: function(callback) {
            if (callback['type'] == 1) {
                $('#notification-friend-item-' + $guid).addClass("ossn-notification-friend-submit");
                $('#ossn-nfriends-' + $guid).addClass('friends-added-text').html(callback['text']);
            }
            if (callback['type'] == 0) {
                $('#notification-friend-item-' + $guid).find('form').show();
                $('#ossn-nfriends-' + $guid).find('.ossn-loading').remove();
            }
            Ossn.NotificationsCheck();
        }
    });
};

Ossn.removeFriendRequset = function($guid) {
    action = Ossn.site_url + "action/friend/remove?user=" + $guid;
    Ossn.ajaxRequest({
        url: action,
        form: '#remove-friend-' + $guid,
        action:true,

        beforeSend: function(request) {
            $('#notification-friend-item-' + $guid).find('form').hide();
            $('#ossn-nfriends-' + $guid).append('<div class="ossn-loading"></div>');
        },
        callback: function(callback) {
            if (callback['type'] == 1) {
                $('#notification-friend-item-' + $guid).addClass("ossn-notification-friend-submit");
                $('#ossn-nfriends-' + $guid).addClass('friends-added-text').html(callback['text']);
            }
            if (callback['type'] == 0) {
                $('#notification-friend-item-' + $guid).find('form').show();
                $('#ossn-nfriends-' + $guid).find('.ossn-loading').remove();
            }
            Ossn.NotificationsCheck();
        }
    });
};

Ossn.NotificationMessagesShow = function($div) {
	$('.ossn-notifications-box').show();
    $($div).attr('onClick', 'Ossn.NotificationMessagesClose(this)');
    Ossn.PostRequest({
        url: Ossn.site_url + "notification/messages",
        action:false,
        beforeSend: function(request) {
            Ossn.NotificationBoxClose();
            $('.ossn-notifications-notification').attr('onClick', 'Ossn.NotificationShow(this)');
            $('.ossn-notifications-friends').attr('onClick', 'Ossn.NotificationFriendsShow(this)');
	    Ossn.NotificationBox(Ossn.Print('messages'), false, 'messages');
        },
        callback: function(callback) {
            var data = '';
            var height = '';
            if (callback['type'] == 1) {
                data = callback['data'];
                height = '';
            }
            if (callback['type'] == 0) {
                data = callback['data'];
               // height = '100px';
            }
            Ossn.NotificationBox(Ossn.Print('messages'), data, 'messages', height);
        }
    });
};


Ossn.NotificationMessagesClose = function($div) {
    Ossn.NotificationBoxClose();
    $($div).attr('onClick', 'Ossn.NotificationMessagesShow(this)');
};
Ossn.NotificationsCheck = function() {
    Ossn.PostRequest({
        url: Ossn.site_url + "notification/count",
        action:false,
        callback: function(callback) {
            $notification = $('#ossn-notif-notification');
            $notification_count = $notification.find('.ossn-notification-container');

            $friends = $('#ossn-notif-friends');
            $friends_count = $friends.find('.ossn-notification-container');

            $messages = $('#ossn-notif-messages');
            $messages_count = $messages.find('.ossn-notification-container');

            if (callback['notifications'] > 0) {
                $notification_count.html(callback['notifications']);
                $notification.find('.ossn-icon').addClass('ossn-icons-topbar-notifications-new');
                $notification_count.attr('style', 'display:inline-block !important;');
            }
            if (callback['notifications'] <= 0) {
                $notification_count.html('');
                $notification.find('.ossn-icon').removeClass('ossn-icons-topbar-notifications-new');
                $notification.find('.ossn-icon').addClass('ossn-icons-topbar-notification');
                $notification_count.hide();
            }

            if (callback['messages'] > 0) {
                $messages_count.html(callback['messages']);
                $messages.find('.ossn-icon').addClass('ossn-icons-topbar-messages-new');
                $messages_count.attr('style', 'display:inline-block !important;');
            }
            if (callback['messages'] <= 0) {
                $messages_count.html('');
                $messages.find('.ossn-icon').removeClass('ossn-icons-topbar-messages-new');
                $messages.find('.ossn-icon').addClass('ossn-icons-topbar-messages');
                $messages_count.hide();
            }

            if (callback['friends'] > 0) {
                $friends_count.html(callback['friends']);
                $friends.find('.ossn-icon').addClass('ossn-icons-topbar-friends-new');
                $friends_count.attr('style', 'display:inline-block !important;');
            }
            if (callback['friends'] <= 0) {
                $friends_count.html('');
                $friends.find('.ossn-icon').removeClass('ossn-icons-topbar-friends-new');
                $friends.find('.ossn-icon').addClass('ossn-icons-topbar-friends');
                $friends_count.hide();
            }
        }
    });
};
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
    		$('.ossn-topbar-dropdown-menu').on('click', function(){
                    Ossn.NotificationBoxClose();
        	});
		$(document).on('click','.ossn-notification-mark-read', function(e){
				e.preventDefault();
   				Ossn.PostRequest({
        				url: Ossn.site_url + "action/notification/mark/allread",
        				action:false,
        				beforeSend: function(request) {
							$('.ossn-notification-mark-read').attr('style', 'opacity:0.5;');
 	       				},
        				callback: function(callback) {
           					if(callback['success']){
								Ossn.trigger_message(callback['success']);
								Ossn.NotificationBoxClose();
								Ossn.NotificationsCheck();
							}
							if(callback['error']){
								Ossn.trigger_message(callback['error']);								
							}
							$('.ossn-notification-mark-read').attr('style', '1;');								
        				}
    			 });
		});
    });
});
