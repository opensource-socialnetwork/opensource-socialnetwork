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
set_time_limit(0);
$id     = input('id'); //user guid
$friend = ossn_user_by_guid($id);

if(!$friend) {
		echo 0;
		exit();
}
$userguid = ossn_loggedin_user()->guid;
$from     = $userguid;
$to       = $friend->guid;


//"((message_from='{$from}' AND message_to='{$to}' AND emd0.value='') OR (message_from='{$to}' AND message_to='{$from}' AND emd1.value=''))",
$wheres = array(
    // Outer Group: This has the 'OR' connector, linking the two inner groups.
    array(
        'connector' => 'OR', 
        'group'     => array(
            
            // 1. First Direction (Internal Connector: AND)
            // Logic: (message_from = $from AND message_to = $to AND emd0.value = '')
            array(
                'connector' => 'AND',
                'group'     => array(
                    array('name' => 'message_from', 'comparator' => '=', 'value' => $from),
                    array('name' => 'message_to',   'comparator' => '=', 'value' => $to),
                    array('name' => 'emd0.value',   'comparator' => '=', 'value' => ""),
                ),
            ),
            
            // 2. Second Direction (Internal Connector: AND)
            // Logic: OR (message_from = $to AND message_to = $from AND emd1.value = '')
            array(
                'connector' => 'AND',
                'group'     => array(
                    array('name' => 'message_from', 'comparator' => '=', 'value' => $to),    // Swapped
                    array('name' => 'message_to',   'comparator' => '=', 'value' => $from),  // Swapped
                    array('name' => 'emd1.value',   'comparator' => '=', 'value' => ""),
                ),
            ),
        ),
    ),
);
$messages = new OssnMessages();
$list     = $messages->searchMessages(array(
		'wheres'         => $wheres,
		'order_by'       => 'm.id DESC',
		'offset'         => false,
		'page_limit'     => false,
		'entities_pairs' => array(
				array(
						'name'   => 'is_deleted_from',
						'value'  => false,
						'wheres' => '(emd0.value IS NOT NULL)',
				),
				array(
						'name'   => 'is_deleted_to',
						'value'  => false,
						'wheres' => '(emd1.value IS NOT NULL)',
				),
		),
));
if($list) {
		foreach($list as $message) {
				if($message->message_from == $userguid) {
						$message->data->is_deleted_from = true;
						$message->save();
				}
				if($message->message_to == $userguid) {
						$message->data->is_deleted_to = true;
						$message->save();
				}
		}
}
echo 1;
exit();