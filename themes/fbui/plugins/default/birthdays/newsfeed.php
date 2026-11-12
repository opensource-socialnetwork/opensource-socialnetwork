<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OPENTEKNIK  LLC, COMMERCIAL LICENSE
 * @license   OPENTEKNIK  LLC, COMMERCIAL LICENSE, COMMERCIAL LICENSE https://www.openteknik.com/license/commercial-license-v1
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$user      = ossn_loggedin_user();
$birthdays = ossn_get_upcomming_birthdays($user);
if($birthdays) {
		echo "<ul>";
		foreach($birthdays as $item) {
				$item->birthdate = str_replace('/', '-', $item->birthdate);
				$time = strtotime($item->birthdate);
				$time = date('jS \of F', $time);
				$date = "<span class='time-created right'>{$time}</span>";
				echo "<a href='{$item->profileURL()}'><li><img src='{$item->iconURL()->topbar}' /><i class='fa fa-birthday-cake'></i>{$item->fullname}{$date}</li></a>";
		}
		echo "</ul>";
} else {
		echo "<div class='nobirthday'>".ossn_print('birthdays:nobirthday')."</div>";	
}