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
$album = input('album');
echo ossn_view_form('photos/add', array(
    'action' => ossn_site_url() . 'action/ossn/photos/add?album=' . $album,
    'method' => 'POST',
    'component' => 'OssnPhotos',
), false);
