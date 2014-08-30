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
	     $('#ossn-add-album').click(function(){
                      Ossn.MessageBox('album/add');
         }); 
          $('#album-add').click(function(){
                      Ossn.MessageBox('album/add');
           }); 
         $('#ossn-add-photos').click(function(){
                      $dataurl = $(this).attr('data-url');
                      Ossn.MessageBox('photos/add'+$dataurl);
         }); 
	});
});