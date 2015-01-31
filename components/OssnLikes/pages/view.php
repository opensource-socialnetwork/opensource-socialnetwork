<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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
        if ($us->guid !== ossn_loggedin_user()->guid) {
            $users[] = ossn_user_by_guid($us->guid);
        }
    }
}
$users['users'] = $users;
$users['icon_size'] = 'small';
echo ossn_view("system/templates/output/users_list", $users);
echo '</div>';