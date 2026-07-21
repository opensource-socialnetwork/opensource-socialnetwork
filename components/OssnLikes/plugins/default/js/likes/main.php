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

var OssnReactionSound = {
	audio: null,
	soundPath: null,

	/**
	 * Pre-loads the audio object into browser memory early
	 */
	init: function () {
		if (!this.audio) {
			this.soundPath = Ossn.site_url + 'components/OssnLikes/reaction.mp3';

			this.audio = new Audio(this.soundPath);
			this.audio.load(); // Forces the browser to download the file silently
		}
	},

	/**
	 * Plays the sound file instantly, resetting the track position for fast-clicks
	 */
	play: function () {
		// Initialize if called before page load binds finish
		if (!this.audio) {
			this.init();
		}

		if (this.audio) {
			try {
				// Rewind track for rapid click pacing sequences
				this.audio.currentTime = 0;

				let playPromise = this.audio.play();
				if (playPromise !== undefined) {
					playPromise.catch(function (error) {
						console.log("Audio playback blocked or interrupted:", error);
					});
				}
			} catch (e) {
				console.log("Audio playback execution exception caught:", e);
			}
		}
	}
};

Ossn.register_callback('ossn', 'init', function () {
	OssnReactionSound.init();
});

const OSSN_REACTION_TYPES = {
	post: {
		prefix: '#ossn-like-',
		pascal: 'Post'
	},
	entity: {
		prefix: '#ossn-elike-',
		pascal: 'Entity'
	},
	object: {
		prefix: '#ossn-olike-',
		pascal: 'Object'
	}
};

Ossn.setReaction = function (type, id, action, reactionType = '') {

	const config = OSSN_REACTION_TYPES[type];
	if (!config) return;

	const selector = config.prefix + id;
	const isLike = action === 'like';
	var queryParams = '&' + type + '=' + id;

	if (isLike) {
		$sound_hook = Ossn.call_hook('like', 'play:sound', null, true);
		if ($sound_hook == true) {
			OssnReactionSound.play();
		}
		queryParams = queryParams + '&reaction_type=' + reactionType;
		$(selector).parent().addClass('ossn-reaction-in-xhr');
	}

	Ossn.PostRequest({
		url: Ossn.site_url + 'action/post/' + action,
		beforeSend: function () {
			$(selector).html('<div class="ossn-loading"></div>');
		},
		params: queryParams,
		callback: function (callback) {
			if (callback['done'] !== 0) {
				$(selector).html(callback['button']);

				if (isLike) {
					// Logic specific to LIKING an item
					$(selector).attr('onClick', `Ossn.${config.pascal}Unlike(${id});`);
					$(selector).removeAttr('data-reaction');

					if (callback['class']) {
						$(selector).addClass(callback['class']);
					}
					$('.ossn-like-reactions-panel').remove();
					$(selector).parent().removeClass('ossn-reaction-in-xhr');
				} else {
					// Logic specific to UNLIKING an item
					$(selector).attr('data-reaction', `Ossn.${config.pascal}Like(${id}, "<<reaction_type>>");`);
					$(selector).removeAttr('onclick');
					$(selector).removeClass(function (index, className) {
						return (className.match(/(^|\s)ossn-reacted-\S+/g) || []).join(' ');
					});
				}

				// Shared reaction container updates
				const $parent = $(selector).parent().parent().parent();
				if (callback['container']) {
					$parent.find('.menu-stats .like-share').remove();
					$parent.find('.menu-stats').prepend(callback['container']);
				} else if (!isLike) {
					// Only unlike drops container explicitly if missing
					$parent.find('.like-share').remove();
				}
			} else {
				$(selector).html(Ossn.Print(action));
			}
		},
	});
};
// Classic function wrappers for backward compatibility
Ossn.PostUnlike = function (post) {
	Ossn.setReaction('post', post, 'unlike');
};

Ossn.PostLike = function (post, reaction_type) {
	if (reaction_type === undefined) {
		reaction_type = '';
	}
	Ossn.setReaction('post', post, 'like', reaction_type);
};

Ossn.EntityUnlike = function (entity) {
	Ossn.setReaction('entity', entity, 'unlike');
};

Ossn.EntityLike = function (entity, reaction_type) {
	if (reaction_type === undefined) {
		reaction_type = '';
	}
	Ossn.setReaction('entity', entity, 'like', reaction_type);
};

Ossn.ObjectUnlike = function (object_guid) {
	Ossn.setReaction('object', object_guid, 'unlike');
};

Ossn.ObjectLike = function (object_guid, reaction_type) {
	if (reaction_type === undefined) {
		reaction_type = '';
	}
	Ossn.setReaction('object', object_guid, 'like', reaction_type);
};

Ossn.RegisterStartupFunction(function () {
	$(document).ready(function () {
		var $htmlreactions = '<div class="ossn-like-reactions-panel"> <li class="ossn-like-reaction-like"> <div class="emoji  emoji--like"> <div class="emoji__hand"> <div class="emoji__thumb"></div> </div> </div> </li> <li class="ossn-like-reaction-dislike"> <div class="emoji  emoji--dislike"> <div class="emoji__hand"> <div class="emoji__thumb"></div> </div> </div> </li> <li class="ossn-like-reaction-love"> <div class="emoji  emoji--love"> <div class="emoji__heart"></div> </div> </li> <li class="ossn-like-reaction-haha"> <div class="emoji  emoji--haha"> <div class="emoji__face"> <div class="emoji__eyes"></div> <div class="emoji__mouth"> <div class="emoji__tongue"></div> </div> </div> </div> </li> <li class="ossn-like-reaction-yay"> <div class="emoji  emoji--yay"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-wow"> <div class="emoji  emoji--wow"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-sad"> <div class="emoji  emoji--sad"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> <li class="ossn-like-reaction-angry"> <div class="emoji  emoji--angry"> <div class="emoji__face"> <div class="emoji__eyebrows"></div> <div class="emoji__eyes"></div> <div class="emoji__mouth"></div> </div> </div> </li> </div>';
		$('body').on('click', function (e) {
			$class = $(e.target).attr('class');
			//console.log($class);
			if ($class && !$(e.target).hasClass('post-control-like') && !$(e.target).hasClass('entity-menu-extra-like') && !$(e.target).hasClass('ossn-like-comment') && !$(e.target).hasClass('ossn-like-reactions-panel')) {
				$('.ossn-like-reactions-panel').remove();
			}
		});
		$MenuReactions = function ($elem) {
			$parent = $($elem).parent();
			$('.ossn-like-reactions-panel').remove(); //remove from all places , remove panel.
			$onclick = $($elem).attr('data-reaction');
			if (!$onclick || $parent.find('.ossn-like-reactions-panel').length > 0) {
				return false;
			}
			$parent.append($htmlreactions);
			$like = $onclick.replace("<<reaction_type>>", 'like');
			$dislike = $onclick.replace("<<reaction_type>>", 'dislike');
			$love = $onclick.replace("<<reaction_type>>", 'love');
			$haha = $onclick.replace("<<reaction_type>>", 'haha');
			$yay = $onclick.replace("<<reaction_type>>", 'yay');
			$wow = $onclick.replace("<<reaction_type>>", 'wow');
			$sad = $onclick.replace("<<reaction_type>>", 'sad');
			$angry = $onclick.replace("<<reaction_type>>", 'angry');

			$parent.find('.ossn-like-reaction-like').attr('onclick', $like);
			$parent.find('.ossn-like-reaction-dislike').attr('onclick', $dislike);
			$parent.find('.ossn-like-reaction-love').attr('onclick', $love);
			$parent.find('.ossn-like-reaction-haha').attr('onclick', $haha);
			$parent.find('.ossn-like-reaction-yay').attr('onclick', $yay);
			$parent.find('.ossn-like-reaction-wow').attr('onclick', $wow);
			$parent.find('.ossn-like-reaction-sad').attr('onclick', $sad);
			$parent.find('.ossn-like-reaction-angry').attr('onclick', $angry);
		};
		$("body").on('mouseenter touchstart', '.post-control-like, .entity-menu-extra-like', function () {
			$MenuReactions($(this));
		});
		$("body").on('mouseenter touchstart', '.post-control-like, .object-menu-extra-like', function () {
			$MenuReactions($(this));
		});
		/*** for comments ***/
		$("body ").on('mouseenter touchstart', '.ossn-like-comment', function () {
			$parent = $(this).parent().parent();
			$('.ossn-like-reactions-panel').remove(); //remove from all places , remove panel.
			if ($(this).attr('data-type') == 'Unlike' || $parent.find('.ossn-like-reactions-panel').length > 0 || !$(this).attr('data-id')) {
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
		$('body').on('click', '.ossn-like-comment-react, .ossn-like-comment', function (e) {
			e.preventDefault();
			var $item = $(this);
			var $type = $.trim($item.attr('data-type'));
			var $guid = $.trim($item.attr('data-id'));

			var $url = $item.attr('href');
			if ($(this).attr('class') == 'ossn-like-comment' && $type == 'Like') {
				return false;
			}

			if ($type == 'Like') {
				$sound_hook = Ossn.call_hook('like', 'play:sound', null, true);
				if ($sound_hook == true) {
					OssnReactionSound.play();
				}
			}

			Ossn.PostRequest({
				url: $url,
				action: false,
				params: '&reaction_type=' + $item.attr('data-reaction'),
				beforeSend: function () {
					$('#ossn-like-comment-' + $guid).html('<img src="' + Ossn.site_url + 'components/OssnComments/images/loading.gif" />');
				},
				callback: function (callback) {
					if (callback['done'] == 1) {
						$total_guid = Ossn.UrlParams('annotation', $url);
						$total = $('.ossn-total-likes-' + $total_guid).attr('data-likes');
						if ($type == 'Like') {
							$('#ossn-like-comment-' + $total_guid).html(Ossn.Print('unlike'));
							$('#ossn-like-comment-' + $total_guid).attr('data-type', 'Unlike');

							var unlike = $url.replace("like", "unlike");
							$('#ossn-like-comment-' + $total_guid).attr('href', unlike);

							$total_likes = $total;

							/**$total_likes++;
                            $('.ossn-total-likes-' + $total_guid).attr('data-likes', $total_likes);
                            $('.ossn-total-likes-' + $total_guid).html('<i class="fa fa-thumbs-up"></i>' + $total_likes); */
							$('.ossn-like-reactions-panel').remove(); //remove from all places , remove panel.
						}
						if ($type == 'Unlike') {
							$('#ossn-like-comment-' + $total_guid).html(Ossn.Print('like'));
							$('#ossn-like-comment-' + $total_guid).attr('data-type', 'Like');
							var like = $url.replace("unlike", "like");

							$('#ossn-like-comment-' + $total_guid).attr('href', like);

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
						if (callback['container']) {
							$('#comments-item-' + $total_guid).find('.ossn-likes-annotation-total').remove();
							$('#comments-item-' + $total_guid).find('.ossn-reaction-list').remove();
							$('#comments-item-' + $total_guid).find('.comment-metadata').append(callback['container']);
						}
					}
					if (callback['done'] == 0) {
						if ($type == 'Like') {
							$('#ossn-like-comment-' + $total_guid).html(Ossn.Print('like'));
							$('#ossn-like-comment-' + $total_guid).attr('data-type', 'Like');
							Ossn.MessageBox('syserror/unknown');
						}
						if ($type == 'Unlike') {
							$('#ossn-like-comment-' + $total_guid).html(Ossn.Print('unlike'));
							$('#ossn-like-comment-' + $total_guid).attr('data-type', 'Unlike');
							Ossn.MessageBox('syserror/unknown');
						}
					}
				},
			});
		});
	});
});