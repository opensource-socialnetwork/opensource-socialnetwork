<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
if(!isset($params['user'])) {
		$params['user'] = '';
}
echo '<div class="ossn-wall-container">';
echo ossn_view_form('home/container', array(
		'action' => ossn_site_url() . 'action/wall/post/a',
		'component' => 'OssnWall',
		'id' => 'ossn-wall-form',
		'enctype' => 'multipart/form-data',
		'params' => array(
				'user' => $params['user']
		)
), false);

echo '</div>';
echo '<div class="user-activity">';
echo ossn_plugin_view('wall/siteactivity');
echo '</div>';
