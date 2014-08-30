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