/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.RegisterStartupFunction(function() {
    $(document).ready(function() {
        $('#ossn-add-album').click(function() {
            Ossn.MessageBox('album/add');
        });
        $('#album-add').click(function() {
            Ossn.MessageBox('album/add');
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
    });
});
