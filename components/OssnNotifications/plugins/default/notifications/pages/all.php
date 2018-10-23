<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$get = new  OssnNotifications;
$notifications = $get->searchNotifications(array(
					'owner_guid' => ossn_loggedin_user()->guid,	
					'offset' => input('offset', '', 1),
					'order_by' => 'n.guid DESC',
));
$count = $get->searchNotifications(array(
					'owner_guid' => ossn_loggedin_user()->guid,
					'count' => true,
));
if($notifications){
	$list = '<div class="ossn-notifications-all ossn-notification-page">';
	foreach($notifications as $item){
			$list .= $item->toTemplate();	
	}
	$list .= "</div>";
}
$pagination = ossn_view_pagination($count);
echo ossn_plugin_view('widget/view', array(
				'title' => ossn_print('notifications'),
				'contents' => $list . $pagination,
));
