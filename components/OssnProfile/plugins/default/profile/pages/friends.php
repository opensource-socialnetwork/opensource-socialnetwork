<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo '<div style="margin-left:3px;">';
$users['users'] = $params['user']->getFriends(false, array(
		'page_limit' => 10
));
$count          = $params['user']->getFriends(false, array(
		'count' => true
));
echo ossn_plugin_view("output/users", $users);
echo ossn_view_pagination($count);
echo '</div>';
