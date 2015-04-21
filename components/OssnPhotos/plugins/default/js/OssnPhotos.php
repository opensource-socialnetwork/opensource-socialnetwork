/**
 * 	Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
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