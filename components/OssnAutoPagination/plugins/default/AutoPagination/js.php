//<script>
Ossn.register_callback('ossn', 'init', 'ossn_auto_pagination');
Ossn.isInViewPort = function($params){
	var params = $params['params'];
	var callback = $params['callback'];
	if(!params){
		params = {};
	}
	if(!callback){
		callback = function(){};
	}
	$($params['element']).scrolling(params);
	$($params['element']).on('scrollin', callback);
};
Ossn.AutoPaginationURLparam = function(name, url){
	if(!name || !url){
		return false;
	}
	//console.log(' url: ' + url);
	// var results = new RegExp('[\?&]' + name + '=([^]*)').exec(url);
	var results = new RegExp('[\?&]' + name + '=([0-9]*)').exec(url);
	if(results == null){
		return null;
	} else {
		//console.log('RESULTS' + JSON.stringify(results));
		return results[1] || false;
	}
};
function ossn_auto_pagination(){
	$(document).ready(function(){
		$calledOnce = [];
		$('.user-activity .ossn-pagination li').css({
			"visibility": "hidden"
		});

		//[B] AutoPagination didnt set any URL query to next request #1682
		$currenturlparams = Ossn.ParseUrl(window.location.href);
		$currentUrlQuery = '';
		if($currenturlparams['query'] && $currenturlparams['query'] != ''){
			//because in $url we using ?offset that means it will sent request on current page, 
			//what if there are other args set in url ? 
			//we need to send those paramters to next request too.
			$removeOffset = $currenturlparams['query'].split('&');
			if($removeOffset){
				$.each($removeOffset, function(k, v){
					if(v.includes('offset')){
						$removeOffset.splice(k, 1);
						return false;

					}
				});
			}
			$currentUrlQuery = $removeOffset.join('&');
			if($currentUrlQuery != ''){
				$currentUrlQuery = '&' + $currentUrlQuery;
			}
		}
		Ossn.isInViewPort({
			element: '.user-activity .ossn-pagination',
			callback: function(event, $all_elements){
				$next = $(this).find('.active').next();
				$last = $(this).find('li:last');
				var selfElement = $(this);
				if($next){
					$actual_next_url = $next.find('a').attr('href');
					$url = $actual_next_url;
					$offset = Ossn.AutoPaginationURLparam('offset', $url);
					$url = '?offset=' + $offset + $currentUrlQuery;
					//compute offset of 'Last' tab the same way for later comparison
					$last_url = $last.find('a').attr('href');
					$last_offset = Ossn.AutoPaginationURLparam('offset', $last_url);
					if($.inArray($url, $calledOnce) == -1 && $offset > 0){
						$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset
						Ossn.PostRequest({
							action: false,
							url: $actual_next_url,
							beforeSend: function(){
								$('.user-activity .ossn-pagination').append('<div class="ossn-loading"></div>');
							},
							callback: function(callback){
								$element = $(callback).find('.user-activity'); //make callback to jquery object
								if($element.length){
									$clone = $element.find('.ossn-pagination').html();
									$element.find('.ossn-pagination').remove(); //remove pagination from contents as we'll replace contents of already existing pagination.
									$('.user-activity').append($element.html()); //append the new data
									selfElement.html($clone); //set pagination content with new pagination contents
									selfElement.appendTo('.user-activity .container-table-pagination .center-row'); //append the pagnation back to at end
									$('.user-activity .ossn-pagination li').css({
										"visibility": "hidden"
									});

									if($offset != $last_offset){
										// we're still somewhere in the middle of the newsfeed
										// so remove any paginator from former pages, but keep last one, because OssnWall insert needs a unique! anchor
										$('.user-activity .container-table-pagination').not(':last').remove();
									} else {
										// newsfeed end has reached, we don't need a paginator anymore
										$('.user-activity .container-table-pagination').remove();
									}
								}
								return;
							},
						});
					} else {
						//if not in array
						//$('.user-activity .container-table-pagination').remove();
					}
				}
			},
		});
	});
}
