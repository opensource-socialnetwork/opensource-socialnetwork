<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
echo '<div class="user-activity">';
$data = json_decode(html_entity_decode($params['post']->description));
$text = $data->post;
$location = '';
if (isset($data->location)) {
    $location = '- ' . $data->location;
}
//fix missing image in comment-item #161 $githubertus
if (isset($params['post']->{'file:wallphoto'})) {
    $image = str_replace('ossnwall/images/', '', $params['post']->{'file:wallphoto'});
} else {
    unset($image);
}
$params['post']->full_view = true;
$user = ossn_user_by_guid($params['post']->poster_guid);
if ($params['post']->type == 'user') {
	$vars =  array(
        'post' => $params['post'],
        'text' => $text,
        'friends' => explode(',', $data->friend),
        'location' => $location,
        'user' => $user,
        'image' => $image,
    );
    echo ossn_wall_view_template($vars);
}
if ($params['post']->type == 'group') {
	$vars = array(
        'post' => $params['post'],
        'text' => $text,
        'location' => $location,
        'user' => $user,
        'image' => $image,
        'show_group' => true,
    );
    echo ossn_wall_view_template($vars);
}

echo '</div>';
