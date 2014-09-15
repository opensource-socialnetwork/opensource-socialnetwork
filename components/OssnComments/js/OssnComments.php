/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
Ossn.PostComment = function($container){
     	 Ossn.ajaxRequest({
			      url: Ossn.site_url+'action/post/comment',
				  form: '#comment-container-'+$container,
			      beforeSend: function(request){
   	                 $('#comment-box-'+$container).attr('readonly', 'readonly');
			      },
			      callback: function(callback){
				    if(callback == 1){  
                      $('#comment-box-'+$container).removeAttr('readonly');
                      $('#comment-box-'+$container).val('');
                      $('.ossn-comments-list-'+$container).append(callback);
                    }
                    if(callback == 0){
                        $('#comment-box-'+$container).removeAttr('readonly');
                        Ossn.MessageBox('syserror/unknown'); 
                    }
				  }
		 });       
};
Ossn.EntityComment = function($container){
     	 Ossn.ajaxRequest({
			      url: Ossn.site_url+'action/post/entity/comment',
				  form: '#comment-container-'+$container,
			      beforeSend: function(request){
   	                 $('#comment-box-'+$container).attr('readonly', 'readonly');
			      },
			      callback: function(callback){
				    $('#comment-box-'+$container).removeAttr('readonly');
                    $('#comment-box-'+$container).val('');
                    $('.ossn-comments-list-'+$container).append(callback);
				  }
		 });       
};
Ossn.CommentMenu = function($id){
 $element = $($id).find('.menu-links');
  if($element.is(":not(:visible)") ){
     $element.show();
     $($id).find('.drop-down-arrow').attr('style', 'display:block;'); 
    } else {
     $element.hide();
     $($id).find('.drop-down-arrow').attr('style', '');    
   }     	
};
Ossn.RegisterStartupFunction(function(){
    $(document).ready(function () {
           	 $(document).delegate('.ossn-delete-comment', 'click', function(e){ 
             e.preventDefault();
             $comment = $(this);
             $url = $comment.attr('href');
             $comment_id = Ossn.UrlParams('comment', $url);
             
             Ossn.PostRequest({
			      url: $url,
			      beforeSend: function(){
   	                $('#comments-item-'+$comment_id).attr('style', 'opacity:0.6;');
			      },
			      callback: function(callback){
				      if(callback == 1){
                        $('#comments-item-'+$comment_id).fadeOut().remove();
                      } 
                      if(callback == 0){
                       $('#comments-item-'+$comment_id).attr('style', 'opacity:0.6;'); 
                      }
				  }
		       });       
          });
    });
});