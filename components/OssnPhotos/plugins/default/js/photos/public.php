//<script>
Ossn.register_callback('ossn', 'init', 'ossn_photos_public_js');
function ossn_photos_public_js(){
	$(document).ready(function(){
        $("#ossn-photos-show-gallery").on('click', function(e) {
            	e.preventDefault();
            	$(".ossn-gallery").eq(0).trigger("click");
        })
        if($('.ossn-gallery').length){
	        $(".ossn-gallery").fancybox();
        }							   
	});
}