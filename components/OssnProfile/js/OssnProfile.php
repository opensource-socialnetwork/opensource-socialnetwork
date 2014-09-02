
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
$(document).ready(function () {
$('#reposition-cover').click(function(){
	$('#profile-menu').hide();
	$('#cover-menu').show();
   $(function() {
        $.globalVars = {
            originalTop: 0,
            originalLeft: 0,
            maxHeight: $("#draggable").height() - $("#container").height(),
            maxWidth: $("#draggable").width() - $("#container").width()
        };
        $("#draggable").draggable({
            start: function(event, ui) {
                if (ui.position != undefined) {
                    $.globalVars.originalTop = ui.position.top;
                    $.globalVars.originalLeft = ui.position.left;
                }
            },
            drag: function(event, ui) {
                var newTop = ui.position.top;
                var newLeft = ui.position.left;
                if (ui.position.top < 0 && ui.position.top * -1 > $.globalVars.maxHeight) {
                    newTop = $.globalVars.maxHeight * -1;
                }
                if (ui.position.top > 0) {
                    newTop = 0;
                }
                if (ui.position.left < 0 && ui.position.left * -1 > $.globalVars.maxWidth) {
                    newLeft = $.globalVars.maxWidth * -1;
                }
                if (ui.position.left > 0) {
                    newLeft = 0;
                }
                ui.position.top = newTop;
                ui.position.left = newLeft;
				
				Ossn.ProfileCover_top = newTop;
                Ossn.ProfileCover_left = newLeft;
            }
        });
    });
});
$("#upload-photo").submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: Ossn.site_url+'action/profile/photo/upload',
            type: 'POST',
            data: formData,
            async: true,
			beforeSend: function(){
				$('.upload-photo').attr('class', 'user-photo-uploading');
			},
            cache: false,
            contentType: false,
            processData: false,
            success: function (callback) {
				$('.user-photo-uploading').attr('class', 'upload-photo').hide();
				$imageurl = $('.profile-photo').find('img').attr('src');
				$('.profile-photo').find('img').attr('src', $imageurl);
            },
            error: function(){
                alert("error in ajax form submission");
            }
        });

        return false;
    });
	
    $("#upload-cover").submit(function (event) {
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $.ajax({
            url: Ossn.site_url+'action/profile/cover/upload',
            type: 'POST',
            data: formData,
            async: true,
			beforeSend: function(){
				$('.profile-cover-img').attr('class', 'user-cover-uploading');
			},
            cache: false,
            contentType: false,
            processData: false,
            success: function (callback) {
				$('.profile-cover').find('img').removeClass('user-cover-uploading');
				$imageurl = $('.profile-cover').find('img').attr('src');
				$('.profile-cover').find('img').attr('src', $imageurl);
                $('.profile-cover').find('img').attr('style', 'position:absolute;');
            },
            error: function(){
                alert("Cannot change cover please try again later");
            }
        });

        return false;
    });	
});

});

Ossn.repositionCOVER = function(){
     $.ajax({
		async: true,
		type: 'post',
		data: '&top='+Ossn.ProfileCover_top+'&left='+Ossn.ProfileCover_left,
		url: Ossn.site_url+"action/profile/cover/reposition",
		success: function(callback){
				$('#profile-menu').show();
            	$('#cover-menu').hide();
				$("#draggable").draggable({
									 drag: function(){
											 return false; 
											}
				}); 
			  },
	});	
};
