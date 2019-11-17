<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo '<div class="ossn-likes-view">';
$likes = new OssnLikes;
$guid = input('guid');
$type = input('type');
if (empty($type)) {
    $type = 'post';
}
$likes = $likes->GetLikes($guid, $type);
if ($likes) {
    foreach ($likes as $us) {
        //empty liker list #686
		//if ($us->guid !== ossn_loggedin_user()->guid) {
			$user = ossn_user_by_guid($us->guid);
			$user->__like_subtype = $us->subtype;
            $users[] = $user;
        //}
    }
}
$users['users'] = $users;
$users['icon_size'] = 'small';
echo ossn_plugin_view("likes/users_list", $users);
echo '</div>';
