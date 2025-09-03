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
$add = new OssnAlbums;
if ($add->CreateAlbum(ossn_loggedin_user()->guid, input('title'), input('privacy'))) {
    redirect(REF);
} else {
    redirect(REF);
}