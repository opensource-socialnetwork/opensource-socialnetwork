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
header('Content-Type: application/json');
$pos = new OssnProfile;
if ($pos->repositionCOVER(ossn_loggedin_user()->guid, input('top'), input('left'))) {
    $params = $pos->coverParameters(ossn_loggedin_user()->guid);
    echo json_encode(array(
            'top' => $params[0],
            'left' => $params[1]
        ));
}
