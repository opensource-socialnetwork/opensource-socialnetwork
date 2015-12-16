//<script>
$(document).ready(function(){
	$(document).on('click', '#sidebar-toggle', function(){
			var $toggle = $(this).attr('data-toggle');
			if($toggle == 0){
				$(this).attr('data-toggle', 1);
				$('.sidebar').addClass('sidebar-open');		
				$('.ossn-page-container').addClass('sidebar-open-page-container');
				$('.topbar .right-side').addClass('right-side-space');
				$('.topbar .right-side').addClass('sidebar-hide-contents-xs');
				$('.ossn-inner-page').addClass('sidebar-hide-contents-xs');
			}			
			if($toggle == 1){
				$(this).attr('data-toggle', 0);
				$('.sidebar').removeClass('sidebar-open');		
				$('.ossn-page-container').removeClass('sidebar-open-page-container');
				$('.topbar .right-side').removeClass('right-side-space');
				$('.topbar .right-side').removeClass('sidebar-hide-contents-xs');
				$('.ossn-inner-page').removeClass('sidebar-hide-contents-xs');
				
				$('.topbar .right-side').addClass('right-side-nospace');
				$('.sidebar').addClass('sidebar-close');		
				$('.ossn-page-container').addClass('sidebar-close-page-container');
				
			} 
		  	var document_height = $(document).height();
  		 	 $(".sidebar").height(document_height);
	}); 
	$(document).scroll(function() {
    	if($(document).scrollTop() >= 50){
			$('.ossn-chat-windows-long .inner').addClass('ossnchat-scroll-top');
		} else if($(document).scrollTop() == 0){
			$('.ossn-chat-windows-long .inner').removeClass('ossnchat-scroll-top');
		}
	})	
});