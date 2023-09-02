/**
 * 	Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//<script> 
jQuery.fn.visibleInScroll = function (goDeep) {
    var parent = $(this[0]).scrollParent()[0],
        elRect = this[0].getBoundingClientRect(),
        rects = [ parent.getBoundingClientRect() ];
    elRect = {
        left: elRect.left, 
        top: elRect.top, 
        right: elRect.right, 
        bottom: elRect.bottom,
        width: elRect.width,
        height: elRect.height,
        visibleWidth: elRect.width,
        visibleHeight: elRect.height,
        isVisible: true,
        isContained: true
    };
    var elWidth = elRect.width,
        elHeight = elRect.height;
    if (parent === this[0].ownerDocument) {
        return elRect;
    }
    
    while (parent !== this[0].ownerDocument && parent !== null) {
        if (parent.scrollWidth > parent.clientWidth || parent.scrollHeight > parent.clientHeight) {
            rects.push(parent.getBoundingClientRect());
        }
        if (rects.length && goDeep) { break; }
        parent = $(parent).scrollParent()[0];
    }
    if (!goDeep) {
        rects.length = 1;
    }
    for (var i = 0; i < rects.length; i += 1) {
        var rect = rects[i];
        elRect.left = Math.max(elRect.left, rect.left);
        elRect.top = Math.max(elRect.top, rect.top);
        elRect.right = Math.min(elRect.right, rect.right);
        elRect.bottom = Math.min(elRect.bottom, rect.bottom);
    }
    elRect.visibleWidth = Math.max(0, elRect.right - elRect.left);
    elRect.visibleHeight = elRect.visibleWidth && Math.max(0, elRect.bottom - elRect.top);
    if (!elRect.visibleHeight) { elRect.visibleWidth = 0; }
    elRect.isVisible = elRect.visibleWidth > 0 && elRect.visibleHeight > 0;
    elRect.isContained = elRect.visibleWidth === elRect.width && elRect.visibleHeight === elRect.height;
    return elRect;
}; 
Ossn.MessagesURLparam = function(name, url){
	if(!name || !url){
		return false;	
	}
	//console.log(' url: ' + url);
    // var results = new RegExp('[\?&]' + name + '=([^]*)').exec(url);
	var results = new RegExp('[\?&]' + name + '=([0-9]*)').exec(url);
    if (results == null){
       return null;
    } else{
		//console.log('RESULTS' + JSON.stringify(results));
       return results[1] || false;
    }
};
Ossn.SendMessage = function($user) {
    Ossn.ajaxRequest({
        url: Ossn.site_url + "action/message/send",
        form: '#message-send-' + $user,
        action:true,
		containMedia:true,
        beforeSend: function(request) {
            $('#message-send-' + $user).find('input[type=submit]').hide();
            $('#message-send-' + $user).find('.ossn-loading').removeClass('ossn-hidden');
        },
        callback: function(callback) {
	    	if(callback !== '0'){
	        	  $('#message-append-' + $user).append(callback);
	 	   }	
		    $('#message-send-' + $user).find('.ossn-omessage-attachment').val('');
			$('#message-send-' + $user).find('.ossn-message-attachment-details').html("").hide();
    	    
			$('#message-send-' + $user).find('textarea').val('');
       	    $('#message-send-' + $user).find('input[type=submit]').show();
            $('#message-send-' + $user).find('.ossn-loading').addClass('ossn-hidden');
            Ossn.message_scrollMove($user);
        }
    });

};
Ossn.getMessages = function($user, $guid) {
	//recent messages statuses for users
	//get the users id for the users who are in sidebar only.
	$recent_containers = $('.messages-recent .ossn-recent-message-item');
	$guids = new Array();
	if($recent_containers.length > 0){
			$recent_containers.each(function(){
					$userid = $(this).attr('data-guid');
					$guids.push($userid);							 
			});	
	}
    Ossn.PostRequest({
        url: Ossn.site_url + "messages/getnew/" + $user,
        action: false,
		params: '&recent_guids='+$guids.join(','),
        callback: function(callback) {
				
				//we don't need to check with guids like in chat because one window can be opened in one tab
				//to check status, as there will be only one  .ossn-inmessage-status-circle
				inchatstatus = $('#message-with-user-widget');
				if (callback['is_online'] == false) {
					if (inchatstatus.hasClass('ossn-inmessage-status-online')) {
						inchatstatus.removeClass('ossn-inmessage-status-online');
						inchatstatus.addClass('ossn-inmessage-status-offline');
					}
				} else {
					inchatstatus.removeClass('ossn-inmessage-status-offline');
					inchatstatus.addClass('ossn-inmessage-status-online');
				}	
			//check status for recent messages sidebar 
			if(callback['recent_status']){
					$.each(callback['recent_status'], function(guid, is_online){
								$elem = $('.ossn-recent-message-item[data-guid="'+guid+'"]');
								if($elem.length > 0){
										if(is_online && $elem.hasClass('ossn-recent-message-status-offline')){
												$elem.removeClass('ossn-recent-message-status-offline');		
												$elem.addClass('ossn-recent-message-status-online');	
										}
										if(!is_online && $elem.hasClass('ossn-recent-message-status-online')){
												$elem.removeClass('ossn-recent-message-status-online');		
												$elem.addClass('ossn-recent-message-status-offline');	
										}										
								}
					});	
			}
            if(callback['html'] && callback['html'] != ''){
 	           $('#message-append-' + $guid).append(callback['html']);
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
/**<script>*/
$(document).ready(function() {
	$calledOnce = [];
	$('.ossn-messages .messages-recent .messages-from').on('scroll', function() {
		if ($('.ossn-pagination').visibleInScroll().isVisible) {
			$element = $('.ossn-messages .messages-recent .messages-from .inner .container-table-pagination');
			$next = $element.find('.ossn-pagination .active').next();
			$last = $element.find('.ossn-pagination').find('li:last');
			$last_url = $last.find('a').attr('href');
			$last_offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $last_url);
			var selfElement = $element;
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $url);
				$url = '?offset_message_xhr_recent=' + $offset;

				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				//console.log('OFFSET: ' + $offset);
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('BEFORE' + JSON.stringify($calledOnce));
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset

					Ossn.PostRequest({
						url: Ossn.site_url + 'messages/xhr/recent' + $url,
						beforeSend: function() {
							$('.ossn-messages .messages-recent .messages-from .inner').append('<div class="ossn-messages-pagination-loading"><div class="ossn-loading"></div></div>');
						},
						callback: function(callback) {
							//return false;
							$element = $(callback).find('.inner'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.container-table-pagination').html();
								$element.find('.container-table-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.ossn-messages .messages-recent .messages-from .inner').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.appendTo('.ossn-messages .messages-recent .messages-from .inner'); //append the pagnation back to at end
								$('.ossn-messages .messages-recent .messages-from .inner .ossn-messages-pagination-loading').remove();
								if($offset == $last_offset) {
									$('.ossn-messages .messages-recent .messages-from .inner .container-table-pagination').fadeOut();
								}
							}
							return;
						},
					});
				} //if not in array
			}
		}
	});
});
Ossn.MessageNotifcationPagination = function(event, $calledOnce){
		if ($('.ossn-notification-messages .ossn-pagination').visibleInScroll().isVisible) {
			$element = $('.ossn-notification-messages .container-table-pagination');
			$next = $element.find('.ossn-pagination .active').next();
			$last = $element.find('.ossn-pagination').find('li:last');
			$last_url = $last.find('a').attr('href');
			$last_offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $last_url);
			var selfElement = $element;
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.MessagesURLparam('offset_message_xhr_recent', $url);
				$url = '?offset_message_xhr_recent=' + $offset;

				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				//console.log('OFFSET: ' + $offset);	
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('BEFORE' + JSON.stringify($calledOnce));
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset

					Ossn.PostRequest({
						url: Ossn.site_url + 'messages/xhr/notification' + $url,
						beforeSend: function() {
							$('.ossn-notification-messages').append('<div class="ossn-messages-notification-pagination-loading"><div class="ossn-loading"></div></div>');
						},
						callback: function(callback) {
							$element = $(callback).find('.ossn-notification-messages'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.container-table-pagination').html();
								$element.find('.container-table-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.ossn-notification-messages').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.appendTo('.ossn-notification-messages'); //append the pagnation back to at end
								$('.ossn-notification-messages .ossn-messages-notification-pagination-loading').remove();
								if($offset == $last_offset) {
									$('.ossn-notification-messages .container-table-pagination').fadeOut();
								}
							}
							return;
						},
					});
				} //if not in array				
			}
		}
};
$(document).ready(function(e) {
	e.preventDefault;
	// initially, set vars like there's no pagination available on message page loading
	var offset      = 1;
	var old_offset  = offset;
	var last_offset = 0;
	var msg_window  = $('.ossn-messages .ossn-widget .message-with .message-inner');
	var pagination  = $('.ossn-messages .ossn-widget .message-with .message-inner .container-table-pagination');
	if(pagination.length) {
		// if a pagination is found, the next page we're going to load must be page 2
		offset = 2;
		// go find the last page offset, too
		$last = pagination.find('.ossn-pagination').find('li:last');
		$last_url = $last.find('a').attr('href');
		last_offset = Ossn.MessagesURLparam('offset_message_xhr_with', $last_url);
	} else {
		return;
	}
	//  number of pixels to move the scrollbar back after a new page has been loaded
	const SCROLLBAR_ADJUSTMENT = 290;
	//  client_height is the height of visible messages window div definded by css (in this case 400)
	var client_height;
	//  scroll_height is the complete height of messages window div (visible part plus scrolled away part)
	var scroll_height;
	//  scroll_top is the number of pixels the content of a <div> element is scrolled vertically
	var scroll_top;
	//  scroll_pos is the computed absolute position of the scrollbar (0 = bottom end)
	var scroll_pos = 0;
	var old_scroll_pos = 0;
	
	//  some vars for handling xhr inserted new messages
	const MAX_MESSAGES_PER_LOAD = 10;
	var messages_loaded;
	var messages_displayed;
	var messages_xhr_inserted;
	
	msg_window.scroll(function(event) {
		event.stopImmediatePropagation();
		client_height  = parseInt(msg_window[0].clientHeight);
		scroll_height  = parseInt(msg_window[0].scrollHeight);
		scroll_top     = parseInt(msg_window[0].scrollTop);
		scroll_pos     = scroll_height - client_height - scroll_top;
		old_scroll_pos = scroll_height - client_height; // max old scroll position (topmost bar position)
		
		if (scroll_pos >= old_scroll_pos && offset > old_offset && offset <= last_offset) {
			// start loading next page only if scrollbar is reaching the top position and next page available
			// console.log('scrollTopMax: ', scroll_height - client_height, ' scroll_top: ', scroll_top, ' scroll_height: ', scroll_height, ' page: ' , offset, ' scroll_pos: ', scroll_pos, ' client_height: ',client_height);
			old_scroll_pos = scroll_pos;
			old_offset     = offset;
			
			// verify whether new messages have been inserted meanwhile
			// based on the fact that each complete message page we're currently looking at
			// comes with 10 records already loaded, any difference must give us the number of newly inserted messages
			// so get the number of theoretical possible records (10 * page number) first
			messages_loaded = (offset - 1) * MAX_MESSAGES_PER_LOAD;
			// and then get the real number of displayed messages
			messages_displayed  = msg_window.find("[id^=message-item-]").length;
			// this way messages_xhr_inserted comes true if there is a difference
			messages_xhr_inserted = messages_displayed - messages_loaded;
			// the tricky part:
			// since 1 newly xhr inserted message will result in an out-of-sync pagination view by 1 position
			// one record of the waiting to be added bunch must be a duplicate that needs to be removed
			// thus in the end not 10 records will be added, but only 9.
			// so when returning here, we're back to a clean multiple of 10 without rest
			// the difference is 0 and messages_xhr_inserted will become false again
			// the logic is working correctly even across page boundaries
			// i.e. with 43 new messages we would get 4 page loads without adding anything (4 * 10 messages removed)
			// plus the fifths page adding 7 messages, bringing us in sync finally 
			// console.log('MSG_LOADED: ', messages_loaded, ' MSG_DISPALYED: ', messages_displayed, ' UNPROCESSED: ', messages_xhr_inserted);
			
			$url = '?offset_message_xhr_with=' + offset;
			$user_guid = msg_window.attr('data-guid');
			Ossn.PostRequest({
				url: Ossn.site_url + 'messages/xhr/with' + $url + '&guid=' + $user_guid,
				beforeSend: function() {
					msg_window.prepend('<div class="ossn-messages-with-pagination-loading"><div class="ossn-loading"></div></div>').fadeIn();
				},
				callback: function(callback) {
					$element = $(callback).find('.message-inner'); //make callback to jquery object
					if ($element.length) {
						offset++;

						// we need to check last_offset here again
						// because it will increase if the chat partner has sent more than 10 new messages in the meantime
						$last = $element.find('.ossn-pagination').find('li:last');
						$last_url = $last.find('a').attr('href');
						// so update last_offset
						last_offset = Ossn.MessagesURLparam('offset_message_xhr_with', $last_url);
						// console.log('LAST_OFFSET: ', last_offset);

						// Actually, ANY newly inserted message will change the database pagination 'view'
						// resulting in already displayed records to be fetched again
						// so we need to find and remove duplicate message records in $element
						// before appending the block to the message window (see #1393 for example)
						if(messages_xhr_inserted) {
							var messages = $element.find("[id^=message-item-]");
							// loop through ready to be appended records and search for duplicates
							for (var i = 0; i < messages.length; i++) {
								var msg_id = $(messages[i]).attr('id');
								if(msg_window.find('#' + msg_id).length) {
									// this message is already shown in message window - don't display in twice
									// so remove it from the block to be appended
									$element.find('#' + msg_id).remove();
									// console.log('REMOVED: ', msg_id);
								}
							}
						}

						$clone = $element.find('.container-table-pagination').html();
						$element.find('.container-table-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.
						msg_window.prepend($element.html()); //append the new data
						pagination.html($clone); //set pagination content with new pagination contents
						pagination.prependTo(msg_window); //append the pagnation back to at end
					}
					msg_window.find('.ossn-messages-with-pagination-loading').remove();
					if(offset > last_offset) {
							// last page reached, remove blank pagination part above oldest message on top
							pagination.remove();
					} else {
							// next page available
							// move the scrollbar a little backward to get some headrooom to scroll up again and trigger loading
							msg_window.animate({scrollTop: SCROLLBAR_ADJUSTMENT}, 0);
					}
				},
			});
		}
	});
});
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
		$('body').on('click', '.ossn-message-icon-attachment', function(){
					$guid = $(this).attr('data-guid');
					$id   = '#message-send-'+$guid;
					$($id).find('.ossn-omessage-attachment').trigger('click');
		});
		$('body').on('click', '.ossn-recent-messages-toggle', function(){
					$('.messages-recent .widget-contents').fadeToggle();	
					icon = $('.ossn-recent-messages-toggle i');
					if(icon.hasClass('fa-angle-up')){
							icon.removeClass('fa-angle-up');
							icon.addClass('fa-angle-down');
					} else if(icon.hasClass('fa-angle-down')){
							icon.removeClass('fa-angle-down');
							icon.addClass('fa-angle-up');
					}					
		});
		$('body').on('change', '.ossn-omessage-attachment', function(e){
					$guid = $(this).attr('data-guid');
					$id   = '#message-send-'+$guid;
					fileName = e.target.files[0].name;
					template = "<span class='ossn-omessage-attachment-name'>"+fileName+"</span>"+"<span class='ossn-omessage-attachment-remove'><i class='fa fa-times'</i></span>",
					$($id).find('.ossn-message-attachment-details').html(template);
					$($id).find('.ossn-message-attachment-details').show();
		});		
		$('body').on('click', '.ossn-omessage-attachment-remove', function(){
							$guid = $(this).parent().attr('data-guid');			
							$id   = '#message-send-'+$guid;
							$($id).find('.ossn-omessage-attachment').val('');
							$($id).find('.ossn-message-attachment-details').html("").hide();
		});		
		$('body').on('click', '.ossn-message-delete', function(e){
				var id = $(this).attr('data-id');
				Ossn.MessageBox('messages/delete?id=' + id);
		});		
		$('body').on('click', '.ossn-message-delete-conversation', function(e){
				var id = $(this).attr('data-guid');
				Ossn.MessageBox('messages/delete_conversation?id=' + id);
		});
		Ossn.ajaxRequest({
                    form: '#ossn-message-delete-conv-form',
					url: Ossn.site_url+'action/message/delete_conversation',
					beforeSend: function(){
							$('#ossn-message-delete-conv-form').html('<div class="ossn-loading"></div>');	
					},
                    callback: function(callback) {
							//reload page in any case
							Ossn.redirect('messages/all');		
					}
        });				
		Ossn.ajaxRequest({
                    form: '#ossn-message-delete-form',
					url: Ossn.site_url+'action/message/delete',
					beforeSend: function(){
							$('#ossn-message-delete-form').html('<div class="ossn-loading"></div>');	
					},
                    callback: function(callback) {
                        if (callback['status'] == true){
							var $parent = $('#message-item-'+callback['id']);
                            
							if(callback['type'] == 'all'){
								$parent = $parent.find('.message-box-sent');
								$text = "<i class='fa fa-times-circle'></i>" + Ossn.Print('ossnmessages:deleted');
                                $parent.find('span').html($text);
								$parent.find('.time-created').hide();
                                $parent.addClass('ossn-message-deleted');
                                Ossn.MessageBoxClose();
                            }
							if(callback['type'] == 'me'){
								Ossn.MessageBoxClose();
								$parent.css({'opacity': 0.5});
								setTimeout(function(){
									$parent.fadeOut('slow').remove();					
								}, 1000);
							}
                        } else {
							Ossn.MessageBoxClose();	
						}
				}
        });		
        $('body').on('click', '.ossn-message-deletes', function(e) {
            e.preventDefault();
            $text = "<i class='fa fa-times-circle'></i>" + Ossn.Print('ossnmessages:deleted');
            $self   = $(this);
			$parent = $(this).parent();
            $action = $(this).attr('href');
            if ($action) {
                Ossn.PostRequest({
                    url: $action,
                    action: false,
                    callback: function(callback) {
                        if (callback == 1) {
							console.log($parent.attr('class'));
                            if ($parent.hasClass('message-box-sent')) {
                                $parent.find('span').html($text);
								$parent.find('.time-created').hide();
                                $parent.addClass('ossn-message-deleted');
                                $self.remove();
                            }
                        }
                    }
                });
            }
        });
    });
});
$(document).ready(function() {
	var $MessageNotifcationPagination = [];	
	$('body').on('click', '#ossn-notif-messages', function(){
			$MessageNotifcationPagination = [];	//reset the array on reopening the messages box
	});
	document.addEventListener('scroll',function(event){
        var $elm = $(event.target);
		if($elm.attr('class') == 'messages-inner' && $elm.parent().parent().hasClass('ossn-notifications-box')){
				Ossn.MessageNotifcationPagination(event, $MessageNotifcationPagination);
		}
		
	},true);	
});
