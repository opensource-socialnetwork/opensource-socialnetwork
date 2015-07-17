<?php
$guid = input('guid');
$album = new OssnAlbums;
if($album->deleteAlbum($guid)){
        ossn_trigger_message(ossn_print('photo:album:deleted'));
        redirect(REF);	
} else {
        ossn_trigger_message(ossn_print('photo:album:delete:error'), 'error');
        redirect(REF);	
}