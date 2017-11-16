/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.SendMessage = function($user) {
    Ossn.ajaxRequest({
        url: Ossn.site_url + "action/message/send",
        form: '#message-send-' + $user,
        action:true,
        beforeSend: function(request) {
            $('#message-send-' + $user).find('input[type=submit]').hide();
            $('#message-send-' + $user).find('.ossn-loading').removeClass('ossn-hidden');
        },
        callback: function(callback) {
            $('#message-append-' + $user).append(callback);
            $('#message-send-' + $user).find('textarea').val('');
            $('#message-send-' + $user).find('input[type=submit]').show();
            $('#message-send-' + $user).find('.ossn-loading').addClass('ossn-hidden');
            Ossn.message_scrollMove($user);

        }
    });

};
Ossn.getMessages = function($user, $guid) {
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/getnew/" + $user,
        action: false,
        callback: function(callback) {
            $('#message-append-' + $guid).append(callback);
            if(callback){
            	//Unwanted refresh in message window #416 , there is no need to scroll if no new message.
	            Ossn.message_scrollMove($guid);
            }
        }
    });
};
Ossn.getRecent = function($user) {
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/getrecent/" + $user,
        action: false,
        callback: function(callback) {
            $('#get-recent').html(callback);
            $('#get-recent').addClass('inner');
            $('.messages-from').find('.inner').remove();
            $('#get-recent').appendTo('.messages-from');
            $('#get-recent').show();
        }
    });
};
Ossn.playSound = function() {
    document.getElementById('ossn-chat-sound').play();
};
Ossn.message_scrollMove = function(fid) {
    var message = document.getElementById('message-append-' + fid);
    if (message) {
        message.scrollTop = message.scrollHeight;
        return message.scrollTop;
    }
};

Ossn.deleteMessage = function($guid, $id) {
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/deletemessage/" + $id,
        action: false,
        callback: function(callback) {
            if(callback){
				$('#message-append-' + $guid).find('#ossn-message-item-'+$id).closest('div.row').hide(300,
					function(){
						this.remove();
					});
				$('#ossn-chat-messages-data-' + $guid).find('#ossn-message-item-'+$id).hide(300,
					function(){
						this.remove();
					});
            }
        }
    });
	return true;
};

Ossn.refreshList = function($from) {
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/getlist/" + $from,
        action: false,
        callback: function(list) {
			if (list){
				var list=$.parseJSON(list);
			}
			$(list).each(function(i,vals){
				var key=Object.keys(vals)[0];
				if (( key=="hidden") && (vals.hidden) ){
					Ossn.hiddenList(vals.hidden,$from);
				}
				if (( key=="archive") && (vals.archive) ){
					Ossn.archiveList(vals.archive,$from);
				}
				if (( key=="spam") && (vals.spam) ){
					Ossn.spamList(vals.spam,$from);
				}
				if (( key=="block") && (vals.block) ){
					Ossn.blockList(vals.block,$from);
				}
			});
        }
    });
	return true;
};

Ossn.hiddenList = function(items,$from) {
	if (items.length>0){
		var id=0;
		var status=0;
		var hide=0;
		$(items).each(function(index, item){
			item=$.parseJSON(item);
			id=item.id;
			status=item.status;
			hide=((status==1) || (status>2));
			if (hide){
				$('#message-append-' + $from).find('#ossn-message-item-'+id).closest('div.row').hide(300,
					function(){
						this.remove();
					});
				$('#ossn-chat-messages-data-' + $from).find('#ossn-message-item-'+id).hide(300,
					function(){
						this.remove();
					});
			}
		});
	}
}
Ossn.archiveList = function(list,$from) {
	//implement codes here
}
Ossn.spamList = function(list,$from) {
	//spam list are also hidden
	Ossn.hiddenList(list,$from);
	//implement other codes here
}
Ossn.blockList = function(list,$from) {
	//block list are also hidden
	Ossn.hiddenList(list,$from);
	//implement other codes here
}

