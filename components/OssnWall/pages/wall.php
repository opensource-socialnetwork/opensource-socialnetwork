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
if (!isset($params['user'])) {
    $params['user'] = '';
}
echo '<div class="ossn-wall-container">';
echo ossn_view_form('home/container', array(
    'action' => ossn_site_url() . 'action/wall/post/a',
    'component' => 'OssnWall',
    'enctype' => 'multipart/form-data',
    'params' => array('user' => $params['user']),
), false);

echo '</div>';
echo '<div class="user-activity">';
echo ossn_view('components/OssnWall/wall/siteactivity');
echo '</div>';
