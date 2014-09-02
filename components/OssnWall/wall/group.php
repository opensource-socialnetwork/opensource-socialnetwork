<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
echo '<div class="ossn-wall-container">';
echo ossn_view_form('group/container', array(
							   'action' => ossn_site_url().'action/wall/post/g',
							   'component' => 'OssnWall',
							   'params' => array('group' => $params['group']),
							    ), false);
echo '</div>';
echo '<div class="user-activity">';

$posts = new OssnWall;
$posts->type = 'group';
$posts = $posts->GetPostByOwner($params['group']->guid);

$Pagination = new OssnPagination;
$Pagination->setItem($posts);
$posts = $Pagination->getItem();
foreach($posts as $post){ 
   $data = json_decode(html_entity_decode($post->description));
   $text = $data->post;
   $location = '';
   if(isset($data->location)){
   $location = '- '.$data->location;
   }
   if(isset($post->{'file:wallphoto'})){
     $image = str_replace('ossnwall/images/', '', $post->{'file:wallphoto'});
   } else {
	 unset($image);    
   }  
   $user = ossn_user_by_guid($post->poster_guid); 
   echo ossn_view('components/OssnWall/templates/group-activity-item', array(
																	'post' => $post,
																	'friends' =>  explode(',' ,$data->friend),
																	'text' => $text,
																	'location' => $location,
																	'user' => $user,
																	'image' => $image,
															 ));  

   } 
echo $Pagination->pagination();

echo '</div>';
