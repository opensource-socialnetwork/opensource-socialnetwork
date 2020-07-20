<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
//Post on edit not returning JSON type callback #1506
header('Content-Type: application/json'); 
$data = str_replace('\n', '<br/>', input('content'));
$data = str_replace("\\\\", "\\", $data);
$comment_guid = input('guid');
$return = ossn_call_hook('comment:view', 'template:params', NULL, array('comment' => array('comments:post' => $data)));
$embed  = $return['comment']['comments:post'];
echo json_encode(array(
            "data" => $embed,
            "process" => 1,
            "item_guid" => 'id="comments-item-' . $comment_guid . '"'
));
exit;
