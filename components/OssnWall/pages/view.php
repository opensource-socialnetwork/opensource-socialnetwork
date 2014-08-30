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
echo '<div class="user-activity">';
   $data = json_decode(html_entity_decode($params['post']->description));
    $text = $data->post;
	 $location = '';
     if(isset($data->location)){
      $location = '- '.$data->location;
     }
	 $user = ossn_user_by_guid($params['post']->poster_guid); 
	 echo ossn_view('components/OssnWall/templates/activity-item', array(
																	'post' => $params['post'],
																	'text' =>  $text,
																	'location' => $location,
																	'user' => $user,
																		 
																		 )); 

echo '</div>';