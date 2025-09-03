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
$album = input('album');
echo ossn_view_form('photos/add', array(
    'action' => ossn_site_url() . 'action/ossn/photos/add?album=' . $album,
    'method' => 'POST',
    'component' => 'OssnPhotos',
), false);
