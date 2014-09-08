/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
Ossn.ViewLikes = function($post, $type){
                      if(!$type){
                        $type = 'post';
                      }
                      Ossn.MessageBox('likes/view?guid='+$post+'&type='+$type);
};

Ossn.PostUnlike = function(post){
     	Ossn.PostRequest({
					 url: Ossn.site_url+'action/post/unlike',
					 beforeSend: function(){
						$('#ossn-like-'+post).find('a').html('<img src="'+Ossn.site_url+'components/OssnComments/images/loading.gif" />');
					 },
                     params: '&post='+post,
					 callback:function(callback){
                       if(callback['done'] !== 0){ 
					  	 $('#ossn-like-'+post).find('a').html(callback['button']);
                         $('#ossn-like-'+post).find('a').attr('onclick', 'Ossn.PostLike('+post+');');
                       }
                        else {
                      	$('#ossn-like-'+post).find('a').html('Unlike'); 
                       }
					 },
					 });  
                       
};
Ossn.PostLike = function(post){
     	Ossn.PostRequest({
					 url: Ossn.site_url+'action/post/like',
					 beforeSend: function(){
					    $('#ossn-like-'+post).find('a').html('<img src="'+Ossn.site_url+'components/OssnComments/images/loading.gif" />');
					 },
                     params: '&post='+post,
					 callback:function(callback){
                       if(callback['done'] !== 0){
		                $('#ossn-like-'+post).find('a').html(callback['button']);
                        $('#ossn-like-'+post).find('a').attr('onClick', 'Ossn.PostUnlike('+post+');');
                       }
                       else {
                      	$('#ossn-like-'+post).find('a').html('Like'); 
                       }
					 },
					 }); 

};

Ossn.EntityUnlike = function(entity){
     	Ossn.PostRequest({
					 url: Ossn.site_url+'action/post/unlike',
					 beforeSend: function(){
						$('#ossn-like-'+entity).find('a').html('<img src="'+Ossn.site_url+'components/OssnComments/images/loading.gif" />');
					 },
                     params: '&entity='+entity,
					 callback:function(callback){
                       if(callback['done'] !== 0){ 
					  	 $('#ossn-like-'+entity).find('a').html(callback['button']);
                         $('#ossn-like-'+entity).find('a').attr('onclick', 'Ossn.EntityLike('+entity+');');
                       }
                        else {
                      	$('#ossn-like-'+entity).find('a').html('Unlike'); 
                       }
					 },
					 });  
                       
};
Ossn.EntityLike = function(entity){
     	Ossn.PostRequest({
					 url: Ossn.site_url+'action/post/like',
					 beforeSend: function(){
					    $('#ossn-like-'+entity).find('a').html('<img src="'+Ossn.site_url+'components/OssnComments/images/loading.gif" />');
					 },
                     params: '&entity='+entity,
					 callback:function(callback){
                       if(callback['done'] !== 0){
		                $('#ossn-like-'+entity).find('a').html(callback['button']);
                        $('#ossn-like-'+entity).find('a').attr('onClick', 'Ossn.EntityUnlike('+entity+');');
                       }
                       else {
                      	$('#ossn-like-'+post).find('a').html('Like'); 
                       }
					 },
					 }); 

};