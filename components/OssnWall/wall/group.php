<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
if($params['ismember'] === 1){
	echo '<div class="ossn-wall-container">';
	echo ossn_view_form('group/container', array(
    	'action' => ossn_site_url() . 'action/wall/post/g',
    	'component' => 'OssnWall',
    	'params' => array('group' => $params['group']),
	), false);
	echo '</div>';
}	
echo '<div class="user-activity">';
$posts = new OssnWall;
$posts = $posts->GetPostByOwner($params['group']['group']->guid, 'group');

$Pagination = new OssnPagination;
$Pagination->setItem($posts);

$posts = false;
if($params['ismember'] === 1 || $params['membership'] == OSSN_PUBLIC){
	$posts = $Pagination->getItem();
}
if ($posts) {
    foreach ($posts as $post) {
        $data = json_decode(html_entity_decode($post->description));
        $text = $data->post;
        $location = '';
        if (isset($data->location)) {
            $location = '- ' . $data->location;
        }
        if (!isset($data->friend)) {
            $data->friend = '';
        }
        if (isset($post->{'file:wallphoto'})) {
            $image = str_replace('ossnwall/images/', '', $post->{'file:wallphoto'});
        } else {
            $image = '';
        }
        $user = ossn_user_by_guid($post->poster_guid);
        echo ossn_wall_view_template(array(
            'post' => $post,
            'friends' => explode(',', $data->friend),
            'text' => $text,
            'location' => $location,
            'user' => $user,
            'image' => $image,
			'ismember' => $params['ismember'],
        ));
    }
}
echo $Pagination->pagination();

echo '</div>';
