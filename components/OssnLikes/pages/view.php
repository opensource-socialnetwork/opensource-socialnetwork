<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
echo '<div class="ossn-likes-view">';
 $likes = new OssnLikes;
  foreach($likes->GetLikes(input('post')) as $us){ 
    if($us->guid !== ossn_loggedin_user()->guid){ 
 	$users[] = ossn_user_by_guid($us->guid);
	}
  }
  $users['users'] = $users;
  $users['icon_size'] = 'small';
  echo ossn_view("system/templates/users_list", $users);
echo '</div>';