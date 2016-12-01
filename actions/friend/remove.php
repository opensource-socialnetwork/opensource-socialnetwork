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
if (ossn_is_xhr()) {
    header('Content-Type: application/json');
}
if (ossn_remove_friend(ossn_loggedin_user()->guid, input('user'))) {
    if (!ossn_is_xhr()) {
        ossn_trigger_message(ossn_print('ossn:notification:delete:friend'), 'error');
        redirect(REF);
    }
    if (ossn_is_xhr()) {
        echo json_encode(array(
                'type' => 1,
                'text' => ossn_print('ossn:notification:delete:friend'),
            ));
    }
} else {
    if (!ossn_is_xhr()) {
        redirect(REF);
    }
    if (ossn_is_xhr()) {
        echo json_encode(array('type' => 0,));
    }
}