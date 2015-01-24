/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
Ossn.RegisterStartupFunction(function(){
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
         $('.ossn-wall-post-delete').click(function(e){
              $url = $(this);
              e.preventDefault(); 
              Ossn.PostRequest({
			        url: $url.attr('href'),			 
			        beforeSend: function(request){
				          $('#activity-item-'+$url.attr('data-guid')).attr('style', 'opacity:0.5;');
			        },
			        callback: function(callback){
				    	 if(callback == 1){
                            $('#activity-item-'+$url.attr('data-guid')).fadeOut();
                            $('#activity-item-'+$url.attr('data-guid')).remove();
                         } else {
                          $('#activity-item-'+$url.attr('data-guid')).attr('style', 'opacity:1;');
                         }
			        }
			  });

         });  
	});
});
Ossn.RegisterStartupFunction(function(){
    $(document).ready(function(){
	            $("#ossn-wall-friend-input").tokenInput(Ossn.site_url+"friendpicker", {
                placeholder: 'Enter friend name',
                hintText: false,
                propertyToSearch: "first_name",
                resultsFormatter: function(item){ return "<li>" + "<img src='" + item.imageurl + "' title='" + item.first_name + " " + item.last_name + "' height='25px' width='25px' />" + "<div style='display: inline-block; padding-left: 10px;'><div class='full_name' style='font-weight:bold;color:#2B5470;'>" + item.first_name + " " + item.last_name + "</div></div></li>" },
                tokenFormatter: function(item) { return "<li><p>" + item.first_name + " " + item.last_name + "</p></li>" },      
                });			
                   			   
	  });
});
Ossn.PostMenu = function($id){
 $element = $($id).find('.menu-links');
  if($element.is(":not(:visible)") ){
     $element.show();
    } else {
     $element.hide();
   }     	
};
<?php
/*
Ossn.WallRefreshActivity = function(){
   Ossn.PostRequest({
                    url: Ossn.site_url+'post/refresh_home',
			        callback: function(activity){
				    	//$('.user-activity').html(activity);
			        }
			  });
};
Ossn.RegisterStartupFunction(function(){
$(document).ready(function(){
         setInterval(function(){Ossn.WallRefreshActivity()}, 5000);     
}); 
}); 
*/ ?>
Ossn.RegisterStartupFunction(function(){
$(document).ready(function(){
      $('.ossn-wall-privacy').on('click', function(e){
            Ossn.MessageBox('post/privacy');
            var OSSN_PUBLIC = 2;
            var OSSN_FRIENDS = 3;
            var wallprivacy = $('#ossn-wall-privacy').val();
            if (wallprivacy == OSSN_PUBLIC) {
                $('#radio-public-privacy').attr('checked', true);
            } else if (wallprivacy == OSSN_FRIENDS) {
                $('#radio-private-privacy').attr('checked', true);
            }
      });   
      $('#ossn-wall-privacy').on('click', function(e){
             var wallprivacy = $('#ossn-wall-privacy-container').find('input[name="privacy"]:checked').val();
             $('#ossn-wall-privacy').val(wallprivacy);
             Ossn.MessageBoxClose();
      });       
      
}); 
}); 
