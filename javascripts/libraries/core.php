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
	
	 if(!error){
	    error = function(){};
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
	 if(!callback){
	    return false;	
	 }
	 if(!befsend){
		befsend = function(){} 
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
              autocomplete = new google.maps.places.Autocomplete(
                  /** @type {HTMLInputElement} */(document.getElementById('ossn-wall-location-input')),
                  { types: ['geocode'] });
              google.maps.event.addListener(autocomplete, 'place_changed', function() {
              });
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
						$('.ossn-halt').addClass('ossn-light').show(); 
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