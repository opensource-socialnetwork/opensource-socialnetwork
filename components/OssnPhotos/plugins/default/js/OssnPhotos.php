/**
 * 	Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
 */
//<script>
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $('#ossn-add-album').on('click', function() {
            Ossn.MessageBox('album/add');
        });
        $('#album-add').on('click', function() {
            Ossn.MessageBox('album/add');
        });
        $('body').on('click', '#ossn-photos-edit-album', function(){
			$guid = $(this).attr('data-guid');
            Ossn.MessageBox("album/edit/"+$guid);
        });		
        $('#ossn-add-photos').on('click', function() {
            $dataurl = $(this).attr('data-url');
            Ossn.MessageBox('photos/add' + $dataurl);
        });
        $('body').on('click', '#ossn-photos-add-button-inner', function(e){
        	e.preventDefault();
		$('.ossn-photos-add-button').find('input').click();
        });
	$('body').on('change', '.ossn-photos-add-button input', function(e){
		$length = $(this)[0].files.length;
		$('.ossn-photos-add-button').find('.images').show();
		$('.ossn-photos-add-button').find('.images .count').html($length);
		$('#ossn-photos-add-button-inner').blur();
	});
    });
});
