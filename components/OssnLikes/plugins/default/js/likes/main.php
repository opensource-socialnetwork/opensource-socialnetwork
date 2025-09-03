//<script>
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
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
                $('#ossn-elike-' + entity).html(Ossn.Print('like'));
            }
        },
    });

};


Ossn.ObjectUnlike = function(object_guid) {
    Ossn.PostRequest({
        url: Ossn.site_url + 'action/post/unlike',
        beforeSend: function() {
            $('#ossn-olike-' + object_guid).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
        },
        params: '&object=' + object_guid,
        callback: function(callback) {
            if (callback['done'] !== 0) {
                $('#ossn-olike-' + object_guid).html(callback['button']);
                $('#ossn-olike-' + object_guid).attr('data-reaction', 'Ossn.ObjectLike(' + object_guid + ', "<<reaction_type>>");');
				$('#ossn-olike-' + object_guid).removeAttr('onclick'); 
				//reactions				
				$parent = $('#ossn-olike-' + object_guid).parent().parent().parent();				
				if(callback['container']){
						$parent.find('.like-share').remove();
						$parent.find('.menu-likes-comments-share').after(callback['container']);
				}
				if(!callback['container']){
						$parent.find('.like-share').remove();	
				}
            } else {
                $('#ossn-olike-' + object_guid).html(Ossn.Print('unlike'));
            }
        },
    });

};
Ossn.ObjectLike = function(object_guid, $reaction_type = '') {
    Ossn.PostRequest({
        url: Ossn.site_url + 'action/post/like',
        beforeSend: function() {
            $('#ossn-olike-' + object_guid).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
        },
        params: '&object=' + object_guid + '&reaction_type='+$reaction_type,
        callback: function(callback) {
            if (callback['done'] !== 0) {
                $('#ossn-olike-' + object_guid).html(callback['button']);
                $('#ossn-olike-' + object_guid).attr('onClick', 'Ossn.ObjectUnlike(' + object_guid + ');');
				$('#ossn-olike-' + object_guid).removeAttr('data-reaction'); 
				//reactions				
				if(callback['container']){
						$parent = $('#ossn-olike-' + object_guid).parent().parent().parent();
						$parent.find('.like-share').remove();
						$parent.find('.menu-likes-comments-share').after(callback['container']);
				}				
            } else {
                $('#ossn-olike-' + object_guid).html(Ossn.Print('like'));
            }
        },
    });

};

Ossn.RegisterStartupFunction(function() {								  
    $(document).ready(function(){
	var $htmlreactions = '<div class="ossn-like-reactions-panel"> <li class="ossn-like-reaction-like"> <div class="emoji  emoji--like"> <div class="emoji__hand"> <div class="emoji__thumb"></div> </div> </div> </li> <li class="ossn-like-reaction-dislike"> <div class="emoji  emoji--dislike"> <div class="emoji__hand"> <div class="emoji__thumb"></div> </div> </div> </li> <li class="ossn-like-reaction-love"> <div class="emoji  emoji--love"> <div class="emoji__heart"></div> </div> </li> <li class="ossn-like-reaction-haha"> <div class="emoji  emoji--haha"> <div class="emoji__face"> <div class="emoji__eyes"></div> <div class="emoji__mouth"> <div class="emoji__tongue"></div> </div> </div> </div> </li> <li class="ossn-like-reaction-yay"> <div class="emoji  emoji--yay"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-wow"> <div class="emoji  emoji--wow"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-sad"> <div class="emoji  emoji--sad"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-angry"> <div class="emoji  emoji--angry"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> </div>';					   
	$('body').on('click',function(e){
			$class = $(e.target).attr('class');
			//console.log($class);
			if($class && !$(e.target).hasClass('post-control-like') && !$(e.target).hasClass('entity-menu-extra-like') && !$(e.target).hasClass('ossn-like-comment') && !$(e.target).hasClass('ossn-like-reactions-panel')){					
				$('.ossn-like-reactions-panel').remove();
			}
	});
	$MenuReactions = function($elem){
			 $parent = $($elem).parent();
			 $('.ossn-like-reactions-panel').remove(); //remove from all places , remove panel.
			 $onclick = $($elem).attr('data-reaction');
			 if(!$onclick || $parent.find('.ossn-like-reactions-panel').length > 0){
					return false; 
			 }
			 $parent.append($htmlreactions);			 
			 $like	  = $onclick.replace("<<reaction_type>>", 'like');
			 $dislike	  = $onclick.replace("<<reaction_type>>", 'dislike');
			 $love	  = $onclick.replace("<<reaction_type>>", 'love');
			 $haha	  = $onclick.replace("<<reaction_type>>", 'haha');
			 $yay	  = $onclick.replace("<<reaction_type>>", 'yay');
			 $wow	  = $onclick.replace("<<reaction_type>>", 'wow');
			 $sad	  = $onclick.replace("<<reaction_type>>", 'sad');
			 $angry	  = $onclick.replace("<<reaction_type>>", 'angry');
			 
			 $parent.find('.ossn-like-reaction-like').attr('onclick', $like);
			 $parent.find('.ossn-like-reaction-dislike').attr('onclick', $dislike);
			 $parent.find('.ossn-like-reaction-love').attr('onclick', $love);
			 $parent.find('.ossn-like-reaction-haha').attr('onclick', $haha);
			 $parent.find('.ossn-like-reaction-yay').attr('onclick', $yay);
			 $parent.find('.ossn-like-reaction-wow').attr('onclick', $wow);
			 $parent.find('.ossn-like-reaction-sad').attr('onclick', $sad);
			 $parent.find('.ossn-like-reaction-angry').attr('onclick', $angry);
   	};
	$("body").on('mouseenter touchstart', '.post-control-like, .entity-menu-extra-like',function(){
			 $MenuReactions($(this));
	});		
	$("body").on('mouseenter touchstart', '.post-control-like, .object-menu-extra-like',function(){
			 $MenuReactions($(this));
	});		
	/*** for comments ***/
	$("body ").on('mouseenter touchstart', '.ossn-like-comment', function(){
			 $parent = $(this).parent().parent();
			 $('.ossn-like-reactions-panel').remove(); //remove from all places , remove panel.
			 if($(this).attr('data-type') == 'Unlike' ||  $parent.find('.ossn-like-reactions-panel').length > 0 || !$(this).attr('data-id')){
					return true; 
			 }
			 $parent.append($htmlreactions);
			 $parent.find('.ossn-like-reaction-like')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'like')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
			 $parent.find('.ossn-like-reaction-dislike')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'dislike')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));								
			 $parent.find('.ossn-like-reaction-love')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'love')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
								
			 $parent.find('.ossn-like-reaction-haha')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'haha')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
								
			 $parent.find('.ossn-like-reaction-yay')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'yay')
								.attr('data-id', $(this).attr('data-id')).
								attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
								
			 $parent.find('.ossn-like-reaction-wow')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'wow')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
								
			 $parent.find('.ossn-like-reaction-sad')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'sad')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
								
			 $parent.find('.ossn-like-reaction-angry')
			 					.addClass('ossn-like-comment-react')
								.attr('data-reaction', 'angry')
								.attr('data-id', $(this).attr('data-id'))
								.attr('data-type', 'Like')
								.attr('href', $(this).attr('href'));
	});			
    $('body').on('click', '.ossn-like-comment-react, .ossn-like-comment', function(e) {
            e.preventDefault();
            var $item = $(this);
            var $type = $.trim($item.attr('data-type'));
            var $url = $item.attr('href');
			if($(this).attr('class') == 'ossn-like-comment' && $type == 'Like'){
				return false;	
			}
            Ossn.PostRequest({
                url: $url,
                action: false,
				params: '&reaction_type='+$item.attr('data-reaction'),
                beforeSend: function() {
                    $item.html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
                },
                callback: function(callback) {
                    if (callback['done'] == 1) {
                        $total_guid = Ossn.UrlParams('annotation', $url);
                        $total = $('.ossn-total-likes-' + $total_guid).attr('data-likes');
                        if ($type == 'Like') {
                            $('#ossn-like-comment-'+$total_guid).html(Ossn.Print('unlike'));
                            $('#ossn-like-comment-'+$total_guid).attr('data-type', 'Unlike');                            
                           
						    var unlike = $url.replace("like", "unlike");
                            $('#ossn-like-comment-'+$total_guid).attr('href', unlike);
                            
							$total_likes = $total;
                            
							/**$total_likes++;
                            $('.ossn-total-likes-' + $total_guid).attr('data-likes', $total_likes);
                            $('.ossn-total-likes-' + $total_guid).html('<i class="fa fa-thumbs-up"></i>' + $total_likes); */
							$('.ossn-like-reactions-panel').remove(); //remove from all places , remove panel.
                        }
                        if ($type == 'Unlike') {
                           $('#ossn-like-comment-'+$total_guid).html(Ossn.Print('like'));
                            $('#ossn-like-comment-'+$total_guid).attr('data-type', 'Like');                            
                            var like = $url.replace("unlike", "like");
							
                           $('#ossn-like-comment-'+$total_guid).attr('href', like);
                           
						   /*if ($total > 1) {
                                $like_remove = $total;
                                0
                                $like_remove--;
                                $('.ossn-total-likes-' + $total_guid).attr('data-likes', $like_remove);
                                $('.ossn-total-likes-' + $total_guid).html('<i class="fa fa-thumbs-up"></i>' + $like_remove);
                            }
                            if ($total == 1) {
                                $('.ossn-total-likes-' + $total_guid).attr('data-likes', 0);
                                $('.ossn-total-likes-' + $total_guid).html('');

                            }*/
                        }
						//update total likes
						if(callback['container']){
								$('#comments-item-'+$total_guid).find('.ossn-likes-annotation-total').remove();
								$('#comments-item-'+$total_guid).find('.ossn-reaction-list').remove();
								$('#comments-item-'+$total_guid).find('.comment-metadata').append(callback['container']);
						}						
                    }
                    if (callback['done'] == 0) {
                        if ($type == 'Like') {
                            $('#ossn-like-comment-'+$total_guid).html(Ossn.Print('like'));
                            $('#ossn-like-comment-'+$total_guid).attr('data-type', 'Like');
                            Ossn.MessageBox('syserror/unknown');
                        }
                        if ($type == 'Unlike') {
                            $('#ossn-like-comment-'+$total_guid).html(Ossn.Print('unlike'));
                            $('#ossn-like-comment-'+$total_guid).attr('data-type', 'Unlike');
                            Ossn.MessageBox('syserror/unknown');
                        }
                    }
                },
            });
        });
    });
});
