//<script>
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.ViewLikes = function($post, $type) {
    if (!$type) {
        $type = 'post';
    }
    Ossn.MessageBox('likes/view?guid=' + $post + '&type=' + $type);
};

Ossn.PostUnlike = function(post) {
    Ossn.PostRequest({
        url: Ossn.site_url + 'action/post/unlike',
        beforeSend: function() {
            $('#ossn-like-' + post).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
        },
        params: '&post=' + post,
        callback: function(callback) {
            if (callback['done'] !== 0) {
                $('#ossn-like-' + post).html(callback['button']);
                $('#ossn-like-' + post).attr('data-reaction', 'Ossn.PostLike(' + post + ', "<<reaction_type>>");');
				$('#ossn-like-' + post).removeAttr('onclick'); 
				//reactions
				$parent = $('#ossn-like-' + post).parent().parent().parent();				
				if(callback['container']){
						$parent.find('.like-share').remove();
						$parent.find('.menu-likes-comments-share').after(callback['container']);
				}
				if(!callback['container']){
						$parent.find('.like-share').remove();	
				}				
            } else {
                $('#ossn-like-' + post).html(Ossn.Print('unlike'));
            }
        },
    });

};
Ossn.PostLike = function(post, $reaction_type = '') {
    Ossn.PostRequest({
        url: Ossn.site_url + 'action/post/like',
        beforeSend: function() {
            $('#ossn-like-' + post).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
        },
        params: '&post=' + post + '&reaction_type='+$reaction_type,
        callback: function(callback) {
            if (callback['done'] !== 0) {
                $('#ossn-like-' + post).html(callback['button']);
                $('#ossn-like-' + post).attr('onClick', 'Ossn.PostUnlike(' + post + ');');
				$('#ossn-like-' + post).removeAttr('data-reaction'); 
				//reactions				
				if(callback['container']){
						$parent = $('#ossn-like-' + post).parent().parent().parent();
						$parent.find('.like-share').remove();
						$parent.find('.menu-likes-comments-share').after(callback['container']);
				}
            } else {
                $('#ossn-like-' + post).html(Ossn.Print('like'));
            }
        },
    });

};

Ossn.EntityUnlike = function(entity) {
    Ossn.PostRequest({
        url: Ossn.site_url + 'action/post/unlike',
        beforeSend: function() {
            $('#ossn-elike-' + entity).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
        },
        params: '&entity=' + entity,
        callback: function(callback) {
            if (callback['done'] !== 0) {
                $('#ossn-elike-' + entity).html(callback['button']);
                $('#ossn-elike-' + entity).attr('data-reaction', 'Ossn.EntityLike(' + entity + ', "<<reaction_type>>");');
				$('#ossn-elike-' + entity).removeAttr('onclick'); 
				//reactions				
				$parent = $('#ossn-elike-' + entity).parent().parent().parent();				
				if(callback['container']){
						$parent.find('.like-share').remove();
						$parent.find('.menu-likes-comments-share').after(callback['container']);
				}
				if(!callback['container']){
						$parent.find('.like-share').remove();	
				}
            } else {
                $('#ossn-elike-' + entity).html(Ossn.Print('unlike'));
            }
        },
    });

};
Ossn.EntityLike = function(entity, $reaction_type = '') {
    Ossn.PostRequest({
        url: Ossn.site_url + 'action/post/like',
        beforeSend: function() {
            $('#ossn-elike-' + entity).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
        },
        params: '&entity=' + entity + '&reaction_type='+$reaction_type,
        callback: function(callback) {
            if (callback['done'] !== 0) {
                $('#ossn-elike-' + entity).html(callback['button']);
                $('#ossn-elike-' + entity).attr('onClick', 'Ossn.EntityUnlike(' + entity + ');');
				$('#ossn-elike-' + entity).removeAttr('data-reaction'); 
				//reactions				
				if(callback['container']){
						$parent = $('#ossn-elike-' + entity).parent().parent().parent();
						$parent.find('.like-share').remove();
						$parent.find('.menu-likes-comments-share').after(callback['container']);
				}				
            } else {
                $('#ossn-elike-' + post).html(Ossn.Print('like'));
            }
        },
    });

};
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $(document).delegate('.ossn-like-comment', 'click', function(e) {
            e.preventDefault();
            var $item = $(this);
            var $type = $.trim($item.attr('data-type'));
            var $url = $item.attr('href');
            Ossn.PostRequest({
                url: $url,
                action: false,
                beforeSend: function() {
                    $item.html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
                },
                callback: function(callback) {
                    if (callback['done'] == 1) {
                        $total_guid = Ossn.UrlParams('annotation', $url);
                        $total = $('.ossn-total-likes-' + $total_guid).attr('data-likes');
                        if ($type == 'Like') {
                            $item.html(Ossn.Print('unlike'));
                            $item.attr('data-type', 'Unlike');                            
                            var unlike = $url.replace("like", "unlike");
                            $item.attr('href', unlike);
                            $total_likes = $total;
                            $total_likes++;
                            $('.ossn-total-likes-' + $total_guid).attr('data-likes', $total_likes);
                            $('.ossn-total-likes-' + $total_guid).html('<i class="fa fa-thumbs-up"></i>' + $total_likes);
                        }
                        if ($type == 'Unlike') {
                            $item.html(Ossn.Print('like'));
                            $item.attr('data-type', 'Like');                            
                            var like = $url.replace("unlike", "like");
                            $item.attr('href', like);
                            if ($total > 1) {
                                $like_remove = $total;
                                0
                                $like_remove--;
                                $('.ossn-total-likes-' + $total_guid).attr('data-likes', $like_remove);
                                $('.ossn-total-likes-' + $total_guid).html('<i class="fa fa-thumbs-up"></i>' + $like_remove);
                            }
                            if ($total == 1) {
                                $('.ossn-total-likes-' + $total_guid).attr('data-likes', 0);
                                $('.ossn-total-likes-' + $total_guid).html('');

                            }
                        }
                    }
                    if (callback['done'] == 0) {
                        if ($type == 'Like') {
                            $item.html(Ossn.Print('like'));
                            $item.attr('data-type', 'Like');
                            Ossn.MessageBox('syserror/unknown');
                        }
                        if ($type == 'Unlike') {
                            $item.html(Ossn.Print('unlike'));
                            $item.attr('data-type', 'Unlike');
                            Ossn.MessageBox('syserror/unknown');

                        }
                    }
                },
            });
        });
    });
});
$(document).ready(function(){			  
	$html = '<div class="ossn-like-reactions-panel"> <li class="ossn-like-reaction-like"> <div class="emoji  emoji--like"> <div class="emoji__hand"> <div class="emoji__thumb"></div> </div> </div> </li> <li class="ossn-like-reaction-love"> <div class="emoji  emoji--love"> <div class="emoji__heart"></div> </div> </li> <li class="ossn-like-reaction-haha"> <div class="emoji  emoji--haha"> <div class="emoji__face"> <div class="emoji__eyes"></div> <div class="emoji__mouth"> <div class="emoji__tongue"></div> </div> </div> </div> </li> <li class="ossn-like-reaction-yay"> <div class="emoji  emoji--yay"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-wow"> <div class="emoji  emoji--wow"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-sad"> <div class="emoji  emoji--sad"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-angry"> <div class="emoji  emoji--angry"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> </div>';					   
	$('body').on('click',function(){
			$('.ossn-like-reactions-panel').remove();									 
	});
	$MenuReactions = function ($elem) {
			 $parent = $($elem).parent();
			 $parent.remove('.ossn-like-reactions-panel');
			 $onclick = $($elem).attr('data-reaction');
			 if(!$onclick){
					return true; 
			 }
			 $parent.append($html);			 
			 $like	  = $onclick.replace("<<reaction_type>>", 'like');
			 $love	  = $onclick.replace("<<reaction_type>>", 'love');
			 $haha	  = $onclick.replace("<<reaction_type>>", 'haha');
			 $yay	  = $onclick.replace("<<reaction_type>>", 'yay');
			 $wow	  = $onclick.replace("<<reaction_type>>", 'wow');
			 $sad	  = $onclick.replace("<<reaction_type>>", 'sad');
			 $angry	  = $onclick.replace("<<reaction_type>>", 'angry');
			 
			 $parent.find('.ossn-like-reaction-like').attr('onclick', $like);
			 $parent.find('.ossn-like-reaction-love').attr('onclick', $love);
			 $parent.find('.ossn-like-reaction-haha').attr('onclick', $haha);
			 $parent.find('.ossn-like-reaction-yay').attr('onclick', $yay);
			 $parent.find('.ossn-like-reaction-wow').attr('onclick', $wow);
			 $parent.find('.ossn-like-reaction-sad').attr('onclick', $sad);
			 $parent.find('.ossn-like-reaction-angry').attr('onclick', $angry);
   	};
	$("body").on('touchstart', '.post-control-like', function(){
			 $MenuReactions(this);
	});	
	$(".post-control-like, .entity-menu-extra-like").on({
   		 mouseenter: function(){
			 $MenuReactions(this);
   		 }
	});
});