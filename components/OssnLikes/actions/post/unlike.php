<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$OssnLikes = new OssnLikes;
$anotation = input('post');
$entity = input('entity');
if (!empty($anotation)) {
    $subject = $anotation;
    $type = 'post';
}
if (!empty($entity)) {
    $subject = $entity;
    $type = 'entity';

}

if ($OssnLikes->UnLike($subject, ossn_loggedin_user()->guid, $type)) {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array(
                'done' => 1,
                'button' => ossn_print('ossn:like'),
            ));
    }
} else {
    if (!ossn_is_xhr()) {
        redirect(REF);
    } else {
        header('Content-Type: application/json');
        echo json_encode(array(
                'done' => 0,
                'button' => ossn_print('ossn:unlike'),
            ));
    }
}

exit;
