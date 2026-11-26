<?php
header('Content-Type: application/json');
$guid = input('guid');
$todos = new OssnTodos();
$status = $todos->toggleTodo($guid, ossn_loggedin_user()->guid);

if ($status !== false) {
    echo json_encode(array('status' => 'success', 'is_completed' => $status));
} else {
    echo json_encode(array('status' => 'error'));
}
exit;