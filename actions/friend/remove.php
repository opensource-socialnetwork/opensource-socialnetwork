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
if (ossn_is_xhr()) {
    header('Content-Type: application/json');
}
if (ossn_remove_friend(ossn_loggedin_user()->guid, input('user'))) {
    if (!ossn_is_xhr()) {
        ossn_trigger_message(ossn_print('ossn:notification:delete:friend'), 'error', 'admin');
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