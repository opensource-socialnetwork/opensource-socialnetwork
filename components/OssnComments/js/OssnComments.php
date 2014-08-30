/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
Ossn.PostComment = function($container){
     	 Ossn.ajaxRequest({
			      url: Ossn.site_url+'action/post/comment',
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