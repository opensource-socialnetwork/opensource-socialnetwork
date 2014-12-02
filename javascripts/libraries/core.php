<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
?>
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */

var Ossn = Ossn ||{}; 
Ossn.Startups = new Array();
/**
 * Register a startup function
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction = function($func){
	Ossn.Startups.push($func);
};
/**
 * Register a ajax request
 *
 * @param $data['form'] = form id
 *        $data['callback'] = call back function
 *        $data['error'] = on error function
 *        $data['beforeSend'] = before send function
 *        $data['url'] = form action url
 *
 * @return bool
 */ 
Ossn.ajaxRequest = function($data){
 $(function(){
	 var $form_name = $data['form'];
	 var url = $data['url'];
	 var callback = $data['callback'];
	 var error = $data['error'];
     var befsend = $data['beforeSend']; 
     var action = $data['action'];
     
     if(url == true){
      url = $($form_name).attr('action');
     }
	 $($form_name).submit(function(event){
	 
	 event.preventDefault();	
	 if(!callback){
	    return false;	
	 }
	 if(!befsend){
		befsend = function(){} 
	 }
     if(!action){
     	action = false;
     }
     if(action == true){
		url = Ossn.AddTokenToUrl(url);
     }
	 if(!error){
	    error = function(xhr, status, error) {
              if(error == 'Internal Server Error' || error !== ''){
                 Ossn.MessageBox('syserror/unknown');
              } 
            };
	 }		  
	             var $form = $(this);
        $.ajax({
			        async: true,
			        type: 'post',
				    beforeSend: befsend,
			        url: url,
			        error: error,
			        data: $(this).serialize(),
			        success: callback,
		          });
			});
});
};
/**
 * Register a post request
 *
 * @param $data['callback'] = call back function
 *        $data['error'] = on error function
 *        $data['beforeSend'] = before send function
 *        $data['url'] = form action url
 *
 * @return bool
 */ 
Ossn.PostRequest = function($data){
    var url = $data['url'];
	 var callback = $data['callback'];
	 var error = $data['error'];
     var befsend = $data['beforeSend']; 
	 var $fdata = $data['params'];
	 var action = $data['action'];

	 if(!callback){
	    return false;	
	 }
	 if(!befsend){
		befsend = function(){} 
	 }
     if(!action){
     	action = true;
     }
     if(action == true){
		url = Ossn.AddTokenToUrl(url);
     }	
	 if(!error){
	    error = function(){};
	 }		  
		         $.ajax({
			        async: true,
			        type: 'post',
					beforeSend: befsend,
			        url: url,
			        error: error,
			        data: $fdata,
			        success: callback,
		     });
};
/**
 * Message done
 *
 * @param $message = message
 *
 * @return mix data
 */ 
Ossn.MessageDone = function($message){
	   return "<div class='ossn-message-done'>"+$message+"</div>";
};
/**
 * Redirect user to other page
 *
 * @param $url = path
 *
 * @return void
 */ 
Ossn.redirect = function($url){
	window.location = Ossn.site_url+$url;
};
/**
 * Setup a profile cover buttons
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction(function(){
  $(document).ready(function(){	    
		$('.profile-cover').hover(function(){
            $('.profile-cover-controls').find('a').show();
            },function(){
            $('.profile-cover-controls').find('a').hide();
         });
	});		
});
/**
 * Setup a profile photo buttons
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction(function(){
   $(document).ready(function(){
	     $('.profile-photo').hover(function(){
            $('.upload-photo').slideDown();
              },function(){
            $('.upload-photo').slideUp();
         });					 
	});
});
/**
 * Setup ajax request for user register
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction(function(){
Ossn.ajaxRequest({
			  url: Ossn.site_url+"action/user/register",
			  form: '#ossn-home-signup',
			 
			  beforeSend: function(request){
					$('#ossn-home-signup').find('#ossn-signup-errors').hide(); 
                    $('#ossn-home-signup input').filter(function() {
					if(this.type == 'radio' && !$(this).is(':checked')){
								 $(this).closest('span').addClass('ossn-required');  
					}
							if(this.value == ""){
							  $(this).addClass('ossn-red-borders');
							  request.abort();
							  return false;
							}
							
					});
			  },
			  callback: function(callback){
				    if(callback['dataerr']){					
					  $('#ossn-home-signup').find('#ossn-signup-errors').html(callback['dataerr']).fadeIn();
				    }
				    if(callback['success'] == 1){
					  $('#ossn-home-signup').html(Ossn.MessageDone(callback['datasuccess']));
				    }
				    $('#ossn-submit-button').attr('type' , 'submit')
				    $('#ossn-submit-button').attr('style' , 'opacity:1;');	 
			  }
			  });
});
/**
 * Setup system messages
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction(function(){
	 $(document).ready(function(){
          $('.ossn-system-messages').find('div').animate({opacity: 0.9}, 6000).slideUp('slow');
     });
});
/**
 * Setup Google Location input
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction(function(){
	 $(document).ready(function(){
            var autocomplete;
            if(typeof google === 'object'){
              autocomplete = new google.maps.places.Autocomplete(
                  /** @type {HTMLInputElement} */(document.getElementById('ossn-wall-location-input')),
                  { types: ['geocode'] });
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
              });
              }
     });
});
/**
 * Topbar dropdown button
 *
 * @return void
 */ 
Ossn.RegisterStartupFunction(function(){
	 $(document).ready(function(){
                     $('.ossn-topbar-dropdown-menu-button').click(function(){
                        if($('.ossn-topbar-dropdown-menu-content').is(":not(:visible)") ){
                           $('.ossn-topbar-dropdown-menu-content').show();
                         }else{
                            $('.ossn-topbar-dropdown-menu-content').hide();
                         }    
                    });
                  
     });
});
/**
 * Close a Ossn message box
 *
 * @return void
 */ 
Ossn.MessageBoxClose = function(){
  $('.ossn-message-box').hide();
  $('.ossn-halt').removeClass('ossn-light').hide(); 
  $('.ossn-halt').attr('style', '');

};
/**
 * Load Message box
 *
 * @return void
 */ 
Ossn.MessageBox = function($url){
	Ossn.PostRequest({
					 url: Ossn.site_url+$url,
					 beforeSend: function(){
						$('.ossn-halt').addClass('ossn-light');
                        $('.ossn-halt').attr('style', 'height:'+$(document).height()+'px;');
                        $('.ossn-halt').show();
						$('.ossn-message-box').html('<div class="ossn-loading ossn-box-loading"></div>');
						$('.ossn-message-box').fadeIn('slow');
					 },
					 callback:function(callback){
					  	 $('.ossn-message-box').html(callback).fadeIn();
					 },
					 });
							  
};
/**
 * Load a media viewer
 *
 * @return void
 */ 
Ossn.Viewer = function($url){
  	Ossn.PostRequest({
					 url: Ossn.site_url+$url,
					
					 beforeSend: function(){
						$('.ossn-halt').removeClass('ossn-light'); 
                        $('.ossn-halt').show();
                        $('.ossn-viewer').html('<table class="ossn-container"><tr><td class="image-block" style="text-align: center;width:100%;"><div class="ossn-viewer-loding">Loading...</div></td></tr></table>');
						$('.ossn-viewer').show();
					 },
					 callback:function(callback){
					  	 $('.ossn-viewer').html(callback).show();
					 },
					 });  
};
/**
 * Close a media viewer
 *
 * @return void
 */ 
Ossn.ViewerClose = function($url){
						$('.ossn-halt').addClass('ossn-light'); 
                        $('.ossn-halt').hide();
						$('.ossn-viewer').html('');
						$('.ossn-viewer').hide();
};
/**
 * Click on element
 *
 * @param $elem = element;
 *
 * @return void
 */ 
Ossn.Clk = function($elem){
	$($elem).click();
};
/**
 * Get url paramter
 *
 * @param name Parameter name;
 *        url complete url
 *
 * @return string
 */ 
Ossn.UrlParams = function(name, url) {
    var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
    if (!results) { 
        return 0; 
    }
    return results[1] || 0;
};
/**
 * Returns an object with key/values of the parsed query string.
 *
 * @param  {String} string The string to parse
 * @return {Object} The parsed object string
 */
Ossn.ParseStr = function(string) {
	var params = {},
		result,
		key,
		value,
		re = /([^&=]+)=?([^&]*)/g,
		re2 = /\[\]$/;

	while (result = re.exec(string)) {
		key = decodeURIComponent(result[1].replace(/\+/g, ' '));
		value = decodeURIComponent(result[2].replace(/\+/g, ' '));

		if (re2.test(key)) {
			key = key.replace(re2, '');
			if (!params[key]) {
				params[key] = [];
			}
			params[key].push(value);
		} else {
			params[key] = value;
		}
	}
	
	return params;
};
/**
 * Parse a URL into its parts. Mimicks http://php.net/parse_url
 *
 * @param {String} url       The URL to parse
 * @param {Int}    component A component to return
 * @param {Bool}   expand    Expand the query into an object? Else it's a string.
 *
 * @return {Object} The parsed URL
 */
Ossn.ParseUrl = function(url, component, expand) {
	// Adapted from http://blog.stevenlevithan.com/archives/parseuri
	// which was release under the MIT
	// It was modified to fix mailto: and javascript: support.
	expand = expand || false;
	component = component || false;
	
	var re_str =
			// scheme (and user@ testing)
			'^(?:(?![^:@]+:[^:@/]*@)([^:/?#.]+):)?(?://)?'
			// possibly a user[:password]@
			+ '((?:(([^:@]*)(?::([^:@]*))?)?@)?'
			// host and port
			+ '([^:/?#]*)(?::(\\d*))?)'
			// path
			+ '(((/(?:[^?#](?![^?#/]*\\.[^?#/.]+(?:[?#]|$)))*/?)?([^?#/]*))'
			// query string
			+ '(?:\\?([^#]*))?'
			// fragment
			+ '(?:#(.*))?)',
		keys = {
			1: "scheme",
			4: "user",
			5: "pass",
			6: "host",
			7: "port",
			9: "path",
			12: "query",
			13: "fragment"
		},
		results = {};

	if (url.indexOf('mailto:') === 0) {
		results['scheme'] = 'mailto';
		results['path'] = url.replace('mailto:', '');
		return results;
	}

	if (url.indexOf('javascript:') === 0) {
		results['scheme'] = 'javascript';
		results['path'] = url.replace('javascript:', '');
		return results;
	}

	var re = new RegExp(re_str);
	var matches = re.exec(url);

	for (var i in keys) {
		if (matches[i]) {
			results[keys[i]] = matches[i];
		}
	}

	if (expand && typeof(results['query']) != 'undefined') {
		results['query'] = ParseStr(results['query']);
	}

	if (component) {
		if (typeof(results[component]) != 'undefined') {
			return results[component];
		} else {
			return false;
		}
	}
	return results;
};
/**
 * Add action token to url
 * 
 * @param string data Full complete url
 */
Ossn.AddTokenToUrl = function(data) {
	// 'http://example.com?data=sofar'
	if (typeof data === 'string') {
		// is this a full URL, relative URL, or just the query string?
		var parts = Ossn.ParseUrl(data),
			args = {},
			base = '';
		
		if (parts['host'] === undefined) {
			if (data.indexOf('?') === 0) {
				// query string
				base = '?';
				args = Ossn.ParseStr(parts['query']);
			}
		} else {
			// full or relative URL
			if (parts['query'] !== undefined) {
				// with query string
				args = Ossn.ParseStr(parts['query']);
			}
			var split = data.split('?');
			base = split[0] + '?';
		}
		args["ossn_ts"] = Ossn.Config.token.ossn_ts;
		args["ossn_token"] = Ossn.Config.token.ossn_token;

		return base + jQuery.param(args);
	}
};
/**
 * Initialize ossn startup functions
 *
 * @return void
 */ 
Ossn.Init = function(){ 
 for(var i = 0; i <= Ossn.Startups.length; i++) {
      if(typeof Ossn.Startups[i] !== "undefined"){
          Ossn.Startups[i]();
       }
 }	
};