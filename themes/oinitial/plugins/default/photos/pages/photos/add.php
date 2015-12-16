<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$album = input('album');
echo ossn_view_form('photos/add', array(
    'action' => ossn_site_url() . 'action/ossn/photos/add?album=' . $album,
    'method' => 'POST',
    'component' => 'OssnPhotos',
), false);
