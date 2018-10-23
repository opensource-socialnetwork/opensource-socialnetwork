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
echo '<div class="user-activity">';
$params['post']->full_view = true;
$user = ossn_user_by_guid($params['post']->poster_guid);
if ($params['post']->type == 'user') {
	$vars = ossn_wallpost_to_item($params['post']);
    echo ossn_wall_view_template($vars);
}
if ($params['post']->type == 'group') {
	$vars = ossn_wallpost_to_item($params['post']);
	$vars['show_group'] = true;
    echo ossn_wall_view_template($vars);
}

echo '</div>';
