<?php
/**
 * Open Source Social Network
 *
 * @package    Open Source Social Network
 * @author     Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license    Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link       https://www.opensource-socialnetwork.org/
 */

header('Content-Type: application/json');

if (!ossn_isLoggedin()) {
    echo json_encode(array('status' => 'error'));
    exit();
}

// Read comma-separated string (e.g. "2,3,4,5")
$guids_raw = input('guids');

if (empty($guids_raw)) {
    echo json_encode(array('statuses' => array()));
    exit();
}

// Convert comma-separated string into a sanitized integer array
$clean_guids = array_map('intval', array_filter(explode(',', $guids_raw)));

if (empty($clean_guids)) {
    echo json_encode(array('statuses' => array()));
    exit();
}

// Instantiate OSSN Database Class
$db = new OssnDatabase();

// Build sanitized WHERE IN clause using OssnDatabase::wheres()
$wheres = array();
$wheres[] = OssnDatabase::wheres('guid', 'IN', $clean_guids);

// Build Select Query
$users = $db->select(array(
    'from'   => 'ossn_users',
    'wheres' => $wheres
), true);

// Execute query safely

$statuses = array();
$current_time = time();

if ($users) {
    foreach ($users as $u) {
        $last_act = (int) $u->last_activity;
        $diff = $current_time - $last_act;

        if ($diff <= 20) { // Active within 3 minutes = Online Green Dot
            $status_type = 'online';
            $badge_text  = '';
        } elseif ($diff <= 3600) { // Active within 60 minutes = Recent minutes badge
            $status_type = 'recent';
            $badge_text  = max(1, floor($diff / 60)) . 'm';
        } else {
            $status_type = 'offline';
            $badge_text  = '';
        }

        $statuses[$u->guid] = array(
            'status' => $status_type,
            'badge'  => $badge_text
        );
    }
}

echo json_encode(array('statuses' => $statuses));
exit();