/**
 * 	Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        /*
         * Friends List Open
         */

        $('.friends-tab').on('click', function(e) {
            var $friends_list;
            $friends_list = $('.friends-list');
            if ($friends_list.is(":not(:visible)")) {
                $friends_list.show();
            } else {
                $friends_list.hide();
            }
        });

        /*
         * Reboot chat after every 5 seconds
         */
        setInterval(function() {
            Ossn.ChatBoot()
        }, 5000);

        /*
         * Process sidebar chat height;
         */
        var sidebarheight = $(document).height();
        sidebarheight = sidebarheight - 45;
        $(".ossn-chat-windows-long").find('.inner').height(sidebarheight + 'px');

    });
});
Ossn.ChatOpenTab = function($user) {
    var $tabitem = $('#ftab-i' + $user);
    if ($tabitem.find('.tab-container').is(":not(:visible)")) {
        Ossn.ChatMarkViewed($user);
        $tabitem.find('.tab-container').show();
        $tabitem.css('width', '256px');
        $tabitem.find('form').show();
        $tabitem.find('input[type="text"]').show();
        $('#ftab' + $user).removeClass('ossn-chat-tab-active');
        $tabitem.find('.ossn-chat-new-message').hide();
        //$tabitem.find('.ossn-chat-new-message').html('');           
        Ossn.ChatScrollMove($user);
    }
};
Ossn.ChatCloseTab = function($user) {
    var $tabitem = $('#ftab-i' + $user);
    $tabitem.find('.tab-container').hide();
    $tabitem.find('form').hide();
    $tabitem.css('width', '200px');
    $tabitem.find('input[type="text"]').hide();
    $tabitem.removeClass('ossn-chat-tab-active');
};
Ossn.ChatTerminateTab = function($user) {
    return Ossn.CloseChat($user);
};
Ossn.ChatBoot = function() {
    $.ajax({
        url: Ossn.site_url + 'ossnchat/boot/ossn.boot.chat.js',
        dataType: "script",
        async: true,
        success: function(fetch) {
            fetch;
        }
    });
};

Ossn.ChatSendForm = function($user) {
    Ossn.ajaxRequest({
        url: Ossn.site_url + "action/ossnchat/send",
        form: '#ossn-chat-send-' + $user,

        beforeSend: function(request) {
            $('#ftab-i' + $user).find('.ossn-chat-message-sending').show();
        },
        callback: function(callback) {
            if (callback['type'] == 1) {
                $('#ftab-i' + $user).find('.ossn-chat-message-sending').hide();
                $('#ftab-i' + $user).find('.data').append(callback['message']);
                $('#ftab-i' + $user).find('input[name="message"]').val('');
                Ossn.ChatScrollMove($user);
            }
        }
    });
};

Ossn.ChatnewTab = function($user) {
    Ossn.PostRequest({
        url: Ossn.site_url + "ossnchat/selectfriend?user=" + $user,
        action: false,
        callback: function(callback) {
            if ($('#ftab-i' + $user).length == 0) {
                if ($(".ossn-chat-containers").children(".friend-tab-item").size() < 4) {
                    $('.ossn-chat-containers').append(callback);
                }
            }
        }
    });
};
Ossn.ChatMarkViewed = function($fid) {
    Ossn.PostRequest({
        url: Ossn.site_url + "action/ossnchat/markread?fid=" + $fid,
        callback: function(callback) {
            return true;
        }
    });
};
Ossn.CloseChat = function($fid) {
    Ossn.PostRequest({
        url: Ossn.site_url + "action/ossnchat/close?fid=" + $fid,
        callback: function(callback) {
            if (callback == 1) {
                var $tabitem = $('#ftab-i' + $fid);
                $tabitem.remove();
            }
            if (callback == 0) {
                Ossn.MessageBox('syserror/unknown');
            }
        }
    });
};
Ossn.ChatplaySound = function() {
    document.getElementById('ossn-chat-sound').play();
};

Ossn.ChatScrollMove = function(fid) {
    var message = document.getElementById('ossn-chat-messages-data-' + fid);
    if (message) {
        message.scrollTop = message.scrollHeight;
        return message.scrollTop;
    }
};

Ossn.ChatInsertSmile = function($code, $tab) {
    var ChatTab = $('#ossn-chat-input-' + $tab);
    var chatval = ChatTab.val();
    ChatTab.val(chatval + ' ' + $code);
};

Ossn.ChatShowSmilies = function($tab) {
    $box = $('#ftab-i' + $tab).find('.ossn-chat-icon-smilies');
    if ($box.is(":not(:visible)")) {
        $box.slideDown('slow');
    } else {
        $box.slideUp('slow');
    }
};

Ossn.ChatExpand = function($username) {
    window.location = Ossn.site_url + 'messages/message/' + $username;
};
