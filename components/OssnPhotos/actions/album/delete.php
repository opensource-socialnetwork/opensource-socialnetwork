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
$guid = input('guid');
$album = new OssnAlbums;
if($album->deleteAlbum($guid)){
        ossn_trigger_message(ossn_print('photo:album:deleted'));
        redirect(REF);	
} else {
        ossn_trigger_message(ossn_print('photo:album:delete:error'), 'error');
        redirect(REF);	
}
