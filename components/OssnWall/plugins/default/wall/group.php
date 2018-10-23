<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if($params['ismember'] === 1) {
		echo '<div class="ossn-wall-container">';
		echo ossn_view_form('group/container', array(
				'action' => ossn_site_url() . 'action/wall/post/g',
				'component' => 'OssnWall',
				'id' => 'ossn-wall-form',
				'params' => array(
						'group' => $params['group']
				)
		), false);
		echo '</div>';
}
echo '<div class="user-activity">';
$posts = new OssnWall;
if($params['ismember'] === 1 || $params['membership'] == OSSN_PUBLIC) {
		$count = $posts->GetPostByOwner($params['group']['group']->guid, 'group', true);
		$posts = $posts->GetPostByOwner($params['group']['group']->guid, 'group');
}
if($posts) {
		foreach($posts as $post) {
				$vars = ossn_wallpost_to_item($post);
				//selecting a CLOSED group like MYSITE/group/123/ gives warning #663
				if(!empty($vars) && is_array($vars)){ 
					$vars['ismember'] = $params['ismember'];
					echo ossn_wall_view_template($vars);
				}
		}
}
echo ossn_view_pagination($count);

echo '</div>';
