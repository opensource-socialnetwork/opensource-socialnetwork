/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
 */
//<script>
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $('#ossn-add-album').click(function() {
            Ossn.MessageBox('album/add');
        });
        $('#album-add').click(function() {
            Ossn.MessageBox('album/add');
        });
        $('body').on('click', '#ossn-photos-edit-album', function(){
			$guid = $(this).attr('data-guid');
            Ossn.MessageBox("album/edit/"+$guid);
        });		
        $('#ossn-add-photos').click(function() {
            $dataurl = $(this).attr('data-url');
            Ossn.MessageBox('photos/add' + $dataurl);
        });
        $("#ossn-photos-show-gallery").click(function(e) {
            	e.preventDefault();
            	$(".ossn-gallery").eq(0).trigger("click");
        })
        if($('.ossn-gallery').length){
	        $(".ossn-gallery").fancybox();
        }
        $('body').delegate('#ossn-photos-add-button-inner', 'click', function(e){
        	e.preventDefault();
		$('.ossn-photos-add-button').find('input').click();
        });
	$('body').delegate('.ossn-photos-add-button input', 'change', function(e){
		$length = $(this)[0].files.length;
		$('.ossn-photos-add-button').find('.images').show();
		$('.ossn-photos-add-button').find('.images .count').html($length);
		$('#ossn-photos-add-button-inner').blur();
	});
    });
});
