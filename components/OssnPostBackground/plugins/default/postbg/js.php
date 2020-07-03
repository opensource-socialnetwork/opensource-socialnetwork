//<script>
$(document).ready(function(){
		var $listsbg = <?php echo json_encode(__PostBackground_List__);?>;
		if($('.ossn-wall-container-data').length){
				$('<div id="ossn-wall-postbg" style="display:none;"></div>').insertAfter('.ossn-wall-container-data textarea');
				$.each($listsbg, function(){
					$('#ossn-wall-postbg').append('<span class="" data-postbg-type="'+this['name']+'" style="background:url(\''+this['url']+'\'";background-position: center; background-size: cover;"></div>');
				});
				$('#ossn-wall-form').append('<input class="postbg-input" name="postbackground_type" type="hidden"/>');
		}
		$('body').on('click', '.ossn-wall-container-control-menu-postbg-selector', function(){
				$('.ossn-wall-container-data div').each(function(){
						$id = $(this).attr('id');
						if($id && $id.indexOf('ossn-wall-') >= 0){
								$(this).hide();
						}	
				});
				if($('#ossn-wall-postbg').attr('data-toggle') == 0 || !$('#ossn-wall-postbg').attr('data-toggle')){
					$('#ossn-wall-postbg').attr('data-toggle', 1);
					$('#ossn-wall-postbg').show();
				} else {
					
					$('.ossn-wall-container-data .postbg-container').attr('style', '');
     					$('.ossn-wall-container-data textarea').removeClass('postbg-container');
					if($('.postbg-input').length){
						$('.postbg-input').val('');
					}
					
					$('#ossn-wall-postbg').attr('data-toggle', 0);
					$('#ossn-wall-postbg').hide();
				}
		});
 		$('.ossn-wall-container-data textarea').keyup(function(){
   				var length = $.trim(this.value).length;
				if(length > 125) {
					$('.ossn-wall-container-data .postbg-container').attr('style', '');
     				$('.ossn-wall-container-data textarea').removeClass('postbg-container');
					if($('.postbg-input').length){
						$('.postbg-input').val('');
					}
    			}
		});		
		$('body').on('click', '#ossn-wall-postbg span', function(){
					$type = $(this).attr('data-postbg-type');	
					var i = 0;
					for(i=0;i<=$listsbg.length;i++){
							if($listsbg[i]['name'] == $type){
								$('.ossn-wall-container-data textarea').addClass('postbg-container');
								$('.ossn-wall-container-data .postbg-container').css({
											'background': 'url("'+$listsbg[i]['url']+'")',
											'background-position': 'center',
											'background-size': 'cover',
											'color': $listsbg[i]['color_hex'],
								});
								$('.postbg-input').val($type);
								break;	
							}
					}
		});
		$(document).ajaxComplete(function(event, xhr, settings) {
			var $url = settings.url;
			$pagehandler = $url.replace(Ossn.site_url, '');
			
			if($pagehandler.indexOf('action/wall/post/a') >= 0 || $pagehandler.indexOf('action/wall/post/g') >= 0 || $pagehandler.indexOf('action/wall/post/u') >= 0 || $pagehandler.indexOf('action/wall/post/bpage') >= 0){
					$('.ossn-wall-container-data .postbg-container').attr('style', '');
     				$('.ossn-wall-container-data textarea').removeClass('postbg-container');
					if($('.postbg-input').length){
						$('.postbg-input').val('');
					}
					//hide panel
					$('.ossn-wall-container-data div').each(function(){
						$id = $(this).attr('id');
						if($id && $id.indexOf('ossn-wall-') >= 0){
								$(this).hide();
						}
					});					
			}
			if($pagehandler.indexOf('wall/post/embed') >= 0){
					$data = settings.data;
					$listsdata = $data.split('&');
					if($listsdata.length > 0){
						$.each($listsdata, function($key, $value){
							if($value.indexOf('guid=') >=0){
									$guid = $value.replace('guid=', '');
									$element = $('#activity-item-'+$guid);
									if($element.length && $element.find('.postbg-container')){
											$text = $element.find('.postbg-container').text();
											if($text && $text.length > 125){
												$element.find('.postbg-container').removeClass('postbg-container').attr('style', '');
												$element.find('.postbg-text').removeClass('postbg-text');
											}
									}
							}
						});
					}
			}
		});		
});
