<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$OssnLikes = new OssnLikes;
$anotation = input('annotation');
if ($OssnLikes->UnLike($anotation, ossn_loggedin_user()->guid, 'annotation')) {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
		$likes_container = ossn_plugin_view('likes/annotation/likes', array(
					'annotation_id' => $anotation,																	
		));				
        header('Content-Type: application/json');
        echo json_encode(array(
                'done' => 1,
                'button' => ossn_print('like'),
				'container' => $likes_container,				
            ));
    }
} else {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
		$likes_container = ossn_plugin_view('likes/annotation/likes', array(
					'annotation_id' => $anotation,																	
		));			
        header('Content-Type: application/json');
        echo json_encode(array(
                'done' => 0,
                'button' => ossn_print('unlike'),
				'container' => $likes_container,								
            ));
    }
}

exit;