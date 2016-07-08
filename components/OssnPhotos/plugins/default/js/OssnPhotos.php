/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
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