<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
echo '<div>';
$users['users'] = $params['user']->getFriends(false, array(
		'page_limit' => 10
));
$count          = $params['user']->getFriends(false, array(
		'count' => true
));
echo ossn_plugin_view("output/users", $users);
echo ossn_view_pagination($count);
echo '</div>';
