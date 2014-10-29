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
$album = input('album');
echo ossn_view_form('photos/add', array(
    'action' => ossn_site_url() . 'action/ossn/photos/add?album=' . $album,
    'method' => 'POST',
    'component' => 'OssnPhotos',
), false);
