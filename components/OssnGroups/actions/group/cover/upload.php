<?php
header('Content-Type: application/json');
$group = input('group');
$group = ossn_get_group_by_guid($group);
if (ossn_loggedin_user()->guid !== $group->owner_guid) {
    echo json_encode(array('type' => 0));
    exit;
}
if ($group->UploadCover()) {
    echo json_encode(array(
            'type' => 1,
            'url' => $group->coverURL(),
        ));
} else {
    echo json_encode(array('type' => 0));
}