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
echo '<div class="user-activity">';
$data = json_decode(html_entity_decode($params['post']->description));
$text = $data->post;
$location = '';
if (isset($data->location)) {
    $location = '- ' . $data->location;
}
if (isset($post->{'file:wallphoto'})) {
    $image = str_replace('ossnwall/images/', '', $post->{'file:wallphoto'});
} else {
    unset($image);
}
$user = ossn_user_by_guid($params['post']->poster_guid);
if ($params['post']->type == 'user') {
    echo ossn_view('components/OssnWall/templates/activity-item', array(
        'post' => $params['post'],
        'text' => $text,
        'friends' => explode(',', $data->friend),
        'location' => $location,
        'user' => $user,
        'image' => $image,

    ));
}
if ($params['post']->type == 'group') {
    echo ossn_view('components/OssnWall/templates/group-activity-item', array(
        'post' => $params['post'],
        'text' => $text,
        'location' => $location,
        'user' => $user,
        'image' => $image,
        'show_group' => true,
    ));

}

echo '</div>';