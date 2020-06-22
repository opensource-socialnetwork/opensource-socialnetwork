//<script>
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.register_callback('ossn', 'init', 'ossn_wall_init');
Ossn.register_callback('ossn', 'init', 'ossn_wall_postform');
Ossn.register_callback('ossn', 'init', 'ossn_wall_post_edit');
Ossn.register_callback('ossn', 'init', 'ossn_wall_select_friends');
Ossn.register_callback('ossn', 'init', 'ossn_wall_location');
Ossn.register_callback('ossn', 'init', 'ossn_wall_privacy');
function ossn_wall_post_edit(){
	$(document).ready(function(){
		//post edit
		Ossn.ajaxRequest({
			url: Ossn.site_url + "action/wall/post/edit",
			containMedia: true,
			form: '#ossn-post-edit-form',
			beforeSend: function(){
				$('#ossn-post-edit-form').find('textarea').hide();
				$('#ossn-post-edit-form').append('<div class="ossn-loading ossn-box-loading"></div>');
			},
			callback: function(callback){
				if(callback['success']){
					$text = $('#ossn-post-edit-form').find('#post-edit').val();
					$guid = $('#ossn-post-edit-form').find('input[name="guid"]').val();
					$elem = $("#activity-item-" + $guid).find('.post-contents').find('p:first');
					/* LinkPreview support */
					var preview_url = '';
					$preview_block = $("#activity-item-" + $guid).find('.post-contents').find('.link-preview-item');
					$preview_link = $("#activity-item-" + $guid).find('.post-contents').find('.link-preview-item').find('a');
					if($preview_link.length){
						// if available, get old preview link to be passed to and compared with edited text in embed action
						preview_url = $preview_link[0].href;
					}

					if($elem.length){
						$elem.text('');
						Ossn.PostRequest({
							url: Ossn.site_url + "action/wall/post/embed",
							params: 'text=' + encodeURIComponent($text) + '&preview=' + preview_url + '&guid=' + $guid,
							callback: function(return_data){
								$elem.append(return_data['text']);
								// handle existing/changed/removed/new preview according to action result
								if((return_data['preview_state'] == 'removed') || (return_data['preview_state'] == 'changed')){
									$preview_block.remove();
								}
								if((return_data['preview_state'] == 'created') || (return_data['preview_state'] == 'changed')){
									$("#activity-item-" + $guid).find('.post-contents').append(return_data['preview']);
								}
							}
						});
					}
					Ossn.trigger_message(callback['success']);
				}
				if(callback['error']){
					Ossn.trigger_message(callback['error'], 'error');
				}
				Ossn.MessageBoxClose();
			}
		});
		//post-edit />	
	});
}

function ossn_wall_postform(){
	$(document).ready(function(){
		//ajax post
		$url = $('#ossn-wall-form').attr('action');
		Ossn.ajaxRequest({
			url: $url,
			action: true,
			containMedia: true,
			form: '#ossn-wall-form',

			beforeSend: function(request){
				$('#ossn-wall-form').find('input[type=submit]').hide();
				$('#ossn-wall-form').find('.ossn-loading').removeClass('ossn-hidden');
			},
			callback: function(callback){
				if(callback['success']){
					//[E] Hide a success message when post is added #1745
					//Ossn.trigger_message(callback['success']);
					if(callback['data']['post']){
						var new_post = callback['data']['post'];
						$('.user-activity').prepend($(callback['data']['post']).hide().fadeIn('slow'));
						// mark post as 'new' in order to distinguish it on deleting
						// new posts must not trigger inserts on deleting !!
						$('.user-activity div').first().attr('post', 'new');
					}
				}
				if(callback['error']){
					Ossn.trigger_message(callback['error'], 'error');
				}

				//need to clear file path after uploading the file #626
				var $file = $("#ossn-wall-form").find("input[type='file']");
				$file.replaceWith($file.val('').clone(true));
				$('#ossn-wall-photo').hide();

				//Tagged friend(s) and location should be cleared, too - after posting #641
				$("#ossn-wall-location-input").val('');
				$('#ossn-wall-location').hide();

				$('#ossn-wall-friend-input').val('');
				if($('#ossn-wall-friend-input').length){
					$("#ossn-wall-friend-input").tokenInput("clear");
					$('#ossn-wall-friend').hide();
				}

				$('#ossn-wall-form').find('input[type=submit]').show();
				$('#ossn-wall-form').find('.ossn-loading').addClass('ossn-hidden');
				$('#ossn-wall-form').find('textarea').val("");
			}
		});
	});
}

function ossn_wall_init(){
	$(document).ready(function(){
		$('.ossn-wall-container').find('.ossn-wall-friend').click(function(){
			$('#ossn-wall-location').hide();
			$('#ossn-wall-photo').hide();
			$('#ossn-wall-friend').show();
		});
		$('.ossn-wall-container').find('.ossn-wall-location').click(function(){
			$('#ossn-wall-friend').hide();
			$('#ossn-wall-photo').hide();
			$('#ossn-wall-location').show();
		});
		$('.ossn-wall-container').find('.ossn-wall-photo').click(function(){
			$('#ossn-wall-friend').hide();
			$('#ossn-wall-location').hide();
			$('#ossn-wall-photo').show();

		});
		$('body').on('click', '.ossn-wall-container-menu-post', function(e){
			e.preventDefault();
			$('.ossn-wall-container-data-post').hide();
			$('.ossn-wall-container-data-post').show();
		});
		$('body').on('click', '.ossn-wall-post-delete', function(e){
			$url = $(this);
			e.preventDefault();

			// new code to insert the first posting from next page,
			// if a posting of the current page has been deleted

			// make it work with /home, /u/USERNAME, /group/GROUP_ID
			var ossn_site_url_parse = Ossn.ParseUrl(Ossn.site_url);
			var $page_url_path = $(location).attr('pathname').substr(1);
			
			//we need to check if OSSN is installed in subdirectory?
			//[B] Wall post delete issue when installation in subdirectory #1717
			if(Ossn.isset(ossn_site_url_parse['path'])){
				$page_url_path = $(location).attr('pathname');
				$page_url_path = Ossn.str_replace(ossn_site_url_parse['path'], '', $page_url_path);
			}
			var base_page_url = Ossn.site_url + $page_url_path;
			// ignore new posts which have just been added
			// because they don't have an impact on the current pagination
			// so first check, whether the to be deleted posting has a 'new' attribute
			// see line #357 for marker setting
			$to_be_deleted = $('#activity-item-' + $url.attr('data-guid'));
			var post_attribute = $to_be_deleted.attr('post');
			var old_posting_deleted = false;
			var last_page_posting_deleted = false;
			var $element = '';
			if(typeof post_attribute === 'undefined'){
				// no attribute found - so this is an already existing older post
				// check for existance of next page
				$next = $('.user-activity .ossn-pagination').find('.active').next();
				if($next.length){
					// this page HAS a paginator !
					var next_url = $next.find('a').attr('href');
					var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(next_url);
					$next_offset = results[1] || false;
					next_url = '?offset=' + $next_offset;

					// remember the current page's offset we're on ...
					// - to rebuild paginator if necessary when AutoPagination is disabled
					// - to compare with last page offset, because there's nothing to insert on the last page
					var current_url = $(location).attr('href');
					var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(current_url);
					if(results){
						var $current_offset = results[1] || false;
					} else {
						// pages without explicite included offset are assumed to be page 1
						var $current_offset = 1;
					}

					// and get the last page's offset
					$last = $('.user-activity .ossn-pagination').find('li:last');
					var last_url = $last.find('a').attr('href');
					var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
					$last_offset = results[1] || false;
					
					if($current_offset < $last_offset){
						Ossn.PostRequest({
							// IMPORTANT: we must run the next 3 (4) XHR posts with async set to FALSE
							// otherwise we're getting unpredictable results from the callbacks here
							// like sometimes not the first posting is returned but a random other one,
							// or record is still available althought already deleted
							async: false, // !!!
							action: false,
							url: base_page_url + next_url,
							beforeSend: function(){},
							callback: function(callback){
								// try to get the first posting of the next page
								$element = $(callback).find('.ossn-wall-item').first();
								if($element.length){
									//append the posting at the bottom, right before pagination
									$element.insertBefore('.user-activity .container-table-pagination');
									// temporarely hide inserted element, to allow deleting of old posting first in next step to avoid flickering
									$element.hide();
									old_posting_deleted = true;
								}
							},
						});
					} else {
						// we're on the last page
						last_page_posting_deleted = true;
					}
				}
			}

			// remove post from wall
			Ossn.PostRequest({
				url: $url.attr('href'),
				async: false,
				beforeSend: function(request){
					$('#activity-item-' + $url.attr('data-guid')).attr('style', 'opacity:0.5;');
				},
				callback: function(callback){
					if(callback == 1){
						$('#activity-item-' + $url.attr('data-guid')).fadeOut();
						$('#activity-item-' + $url.attr('data-guid')).remove();
					} else {
						$('#activity-item-' + $url.attr('data-guid')).attr('style', 'opacity:1;');
					}
				}
			});

			if($element.length){
				// make inserted element visible
				$element.show();
			}

			// needed for manual pagination only!
			<?php if(!com_is_active('OssnAutoPagination')){ ?>
				if(old_posting_deleted){
					// now that we have deleted one posting,
					// find out whether there are still postings on the last page pointed to by current paginator
					// if not, we have to shrink the paginator
					$last = $('.user-activity .ossn-pagination').find('li:last');
					if($last.length){
						var last_url = $last.find('a').attr('href');
						var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
						$offset = results[1] || false;
						last_url = '?offset=' + $offset;

						Ossn.PostRequest({
							async: false,
							action: false,
							url: base_page_url + last_url,
							beforeSend: function(){},
							callback: function(callback){
								$element = $(callback).find('.ossn-wall-item').first();
								if($element.length){
									// the last page still has entries - do nothing
								} else {
									// pagination needs to be adjusted
									// so remove old pagination
									$('.user-activity .container-table-pagination').remove();
									// and reload page we're currently on to retrieve a new one
									var current_url = '?offset=' + $current_offset;
									Ossn.PostRequest({
										async: false,
										action: false,
										url: base_page_url + current_url,
										beforeSend: function(){},
										callback: function(callback){
											$element = $(callback).find('.container-table-pagination');
											if($element.length){
												// and add adjusted pagination
												$element.appendTo('.user-activity');
											}
											// note: if there's no element found
											// we have run into the special case
											// offset = 1 and either no postings at all or number of postings < pagelimit
										},
									});
								}
							},
						});
					}
				}
				if(last_page_posting_deleted){
					// now that we have deleted one posting on the last page we're currently on,
					// find out whether there are still other postings on this page
					// if not, we are going to display the previous page instead - in case we're not on page 1 already
					$last = $('.user-activity .ossn-pagination').find('li:last');
					if($last.length){
						var last_url = $last.find('a').attr('href');
						var results = new RegExp('[\?&]' + 'offset' + '=([0-9]*)').exec(last_url);
						$offset = results[1] || false;
						last_url = '?offset=' + $offset;

						Ossn.PostRequest({
							async: false,
							action: false,
							url: base_page_url + last_url,
							beforeSend: function(){},
							callback: function(callback){
								$element = $(callback).find('.ossn-wall-item').first();
								if($element.length){
									// the last page still has entries - do nothing
								} else {
									// if the offset of our last page is 1, we don't have to care about a paginator
									// because there's IS no paginator on incomplete page 1
									if($offset > 1){
										$('.user-activity .container-table-pagination').remove();
										// the .user-activity div should be completely empty now
										// we're not on page 1, so load and insert the previous page's wall items and pagination
										$offset--;
										var current_url = '?offset=' + $offset;
										Ossn.PostRequest({
											async: false,
											action: false,
											url: base_page_url + current_url,
											beforeSend: function(){},
											callback: function(callback){
												// get complete feed of previous page
												$element = $(callback).find('.user-activity');
												if($element.length){
													// and add it
													var previous_page_feed = $element.html();
													$(previous_page_feed).appendTo('.user-activity');
												}
											},
										});
									}
								}
							},
						});
					}

				}
				// end of manual pagination part
				<?php } ?>
		});

		$('body').delegate('.ossn-wall-post-edit', 'click', function(){
			var $dataguid = $(this).attr('data-guid');
			Ossn.MessageBox('post/edit/' + $dataguid);
		});
		//Change the privacy button as per the privacy value #1289
		$('body').on('input', '#ossn-wall-privacy', function(){
			switch (parseInt($(this).val())){
				case 3:
					$('.ossn-wall-privacy-lock').removeClass('fa-lock');
					$('.ossn-wall-privacy-lock').removeClass('fa-globe');
					$('.ossn-wall-privacy-lock').removeClass('fa-users');
					$('.ossn-wall-privacy-lock').addClass('fa-users');
					break;
				case 2:
					$('.ossn-wall-privacy-lock').removeClass('fa-lock');
					$('.ossn-wall-privacy-lock').removeClass('fa-globe');
					$('.ossn-wall-privacy-lock').removeClass('fa-users');
					$('.ossn-wall-privacy-lock').addClass('fa-globe');
					break;
			}
		});
		if($('#ossn-wall-privacy').length){
			$('#ossn-wall-privacy').trigger('input');
		}
	});
}

function ossn_wall_select_friends(){
	$(document).ready(function(){
		if($.isFunction($.fn.tokenInput)){
			$("#ossn-wall-friend-input").tokenInput(Ossn.site_url + "friendpicker", {
				placeholder: Ossn.Print('tag:friends'),
				hintText: false,
				propertyToSearch: "first_name",
				resultsFormatter: function(item){
					return "<li>" + "<img src='" + item.imageurl + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name' style='font-weight:bold;color:#2B5470;'>" + item.first_name + " " + item.last_name + "</div></div></li>"
				},
				tokenFormatter: function(item){
					return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>"
				},
			});
		}
	});
}
Ossn.PostMenu = function($id){
	$element = $($id).find('.menu-links');
	if($element.is(":not(:visible)")){
		$element.show();
	} else {
		$element.hide();
	}
};
function ossn_wall_privacy(){
	$(document).ready(function(){
		$('.ossn-wall-privacy').on('click', function(e){
			Ossn.MessageBox('post/privacy');
		});
		$('#ossn-wall-privacy').on('click', function(e){
			var wallprivacy = $('#ossn-wall-privacy-container').find('input[name="privacy"]:checked').val();
			$('#ossn-wall-privacy').val(wallprivacy);
			$('#ossn-wall-privacy').trigger("input");
			Ossn.MessageBoxClose();
		});
	});

}
/**
 * Setup Google Location input
 *
 * Remove google map search API as it requires API #906 
 * 
 * @return void
 */
function ossn_wall_location(){
	$(document).ready(function(){
		if($('#ossn-wall-location-input').length){
			//Location autocomplete not working over https #1043
			//Change to places js
			var placesAutocomplete = places({
				container: document.querySelector('#ossn-wall-location-input')
			});
			$('#ossn-wall-location-input').keypress(function(event){
				if(event.keyCode == 13){
					event.preventDefault();
					return false;
				}
			});
		}
	});
}
