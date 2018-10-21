//<script>
Ossn.isInViewPort = function($params) {
	var params = $params['params'];
	var callback = $params['callback'];
	if (!params) {
		params = {};
	}
	if (!callback) {
		callback = function() {};
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
    if (results == null){
       return null;
    } else{
		//console.log('RESULTS' + JSON.stringify(results));
       return results[1] || false;
    }
};
$(document).ready(function() {
	$calledOnce = [];
	$('.ossn-profile-wall .user-activity .ossn-pagination li').css({"visibility":"hidden"});
	Ossn.isInViewPort({
		element: '.ossn-profile-wall .user-activity .ossn-pagination',
		callback: function(event, $all_elements) {
			$next = $(this).find('.active').next();
			var selfElement = $(this);
			if ($next) {
				$actual_next_url = $next.find('a').attr('href');
				$url = $actual_next_url;
				$offset = Ossn.AutoPaginationURLparam('offset', $url);
				$url = '?offset='+$offset;
				//console.log('OFFSET: ' + $offset);
				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('NEXT');
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset
					Ossn.PostRequest({
						action:false,
						url: $actual_next_url,
						beforeSend: function() {
									$('.ossn-profile-wall .user-activity .ossn-pagination').append('<div class="ossn-loading"></div>');
						},
						callback: function(callback) {
							$element = $(callback).find('.user-activity'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.ossn-pagination').html();  
								$element.find('.ossn-pagination').remove();  //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.user-activity').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.appendTo('.user-activity'); //append the pagnation back to at end
								$('.ossn-profile-wall .user-activity .ossn-pagination li').css({"visibility":"hidden"});
							}
                            return;
						},
					});
				} //if not in array
			}
		},
	});
});
$(document).ready(function() {
	$calledOnce = [];
	$('.newsfeed-middle .user-activity .ossn-pagination li').css({"visibility":"hidden"});
	Ossn.isInViewPort({
		element: '.newsfeed-middle .user-activity .ossn-pagination',
		callback: function(event, $all_elements) {
			$next = $(this).find('.active').next();
			$last = $(this).find('li:last');
			var selfElement = $(this);
			if ($next) {
				$url = $next.find('a').attr('href');
				$offset = Ossn.AutoPaginationURLparam('offset', $url);
				$url = '?offset='+$offset;
				
				//compute offset of 'Last' tab the same way for later comparison
				$last_url = $last.find('a').attr('href');
				$last_offset = Ossn.AutoPaginationURLparam('offset', $last_url);
				
				//console.log('NEXT_OFFSET' , $offset);
				//console.log('LAST_OFFSET' , $last_offset);
				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('NEXT');
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset
					Ossn.PostRequest({
						action:false,									 
						url: Ossn.site_url + 'home' + $url,
						beforeSend: function() {
									$('.newsfeed-middle .user-activity .ossn-pagination').append('<div class="ossn-loading"></div>');
									//console.log($calledOnce.toString());  //need to add loading icon here
						},
						callback: function(callback) {
							$element = $(callback).find('.user-activity'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.ossn-pagination').html();  
								$element.find('.ossn-pagination').remove();  //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.user-activity').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents

								// selfElement.appendTo('.user-activity'); //append the pagnation back to at end
								// above code replaced by next line in order to make paginator look the same as with fresh page load
								selfElement.appendTo('.user-activity .container-table-pagination .center-row'); //append the pagnation back to at end

								$('.newsfeed-middle .user-activity .ossn-pagination li').css({"visibility":"hidden"});
								
								if($offset != $last_offset) {
									// we're still somewhere in the middle of the newsfeed
									// so remove any paginator from former pages, but keep last one, because OssnWall insert needs a unique! anchor
									$('.container-table-pagination').not(':last').remove();
								} else {
									// newsfeed end has reached, we don't need a paginator anymore
									$('.container-table-pagination').remove();
									// positive side effects:
									// - Ossn Wall insert will find no anchor anymore to append last page again and again
									// - no more scrolling events will be triggered
								}
							}
                            return;
						},
					});
				} else {
					//if not in array
					$('.container-table-pagination').remove();
				}
			}
		},
	});
});
$(document).ready(function() {
	$calledOnce = [];
	$('.group-wall .user-activity .ossn-pagination li').css({"visibility":"hidden"});
	Ossn.isInViewPort({
		element: '.group-wall .user-activity .ossn-pagination',
		callback: function(event, $all_elements) {
			$next = $(this).find('.active').next();
			var selfElement = $(this);
			if ($next) {
				$actual_next_url = $next.find('a').attr('href');
				$url = $actual_next_url;
				$offset = Ossn.AutoPaginationURLparam('offset', $url);
				$url = '?offset='+$offset;
				//console.log('OFFSET: ' + $offset);
				//console.log('A R R A Y ' + JSON.stringify($calledOnce));
				if ($.inArray($url, $calledOnce) == -1 && $offset > 0) {
					//console.log('NEXT');
					$calledOnce.push($url); //push to array so we don't need to call ajax request again for processed offset
					Ossn.PostRequest({
						action:false,									 
						url: $actual_next_url,
						beforeSend: function() {
									$('.group-wall .user-activity .ossn-pagination').append('<div class="ossn-loading"></div>');
									//console.log($calledOnce.toString());  //need to add loading icon here
						},
						callback: function(callback) {
							$element = $(callback).find('.user-activity'); //make callback to jquery object
							if ($element.length) {
								$clone = $element.find('.ossn-pagination').html();  
								$element.find('.ossn-pagination').remove();  //remove pagination from contents as we'll replace contents of already existing pagination.

								$('.user-activity').append($element.html()); //append the new data
								selfElement.html($clone); //set pagination content with new pagination contents
								selfElement.appendTo('.user-activity'); //append the pagnation back to at end
								$('.group-wall .user-activity .ossn-pagination li').css({"visibility":"hidden"});
							}
                            return;
						},
					});
				} //if not in array
			}
		},
	});
});
