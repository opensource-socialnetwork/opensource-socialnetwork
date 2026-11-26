<?php
header('Content-Type: application/json');
$guid = input('guid');
$todos = new OssnTodos();

if ($todos->deleteTodo($guid, ossn_loggedin_user()->guid)) {
    echo json_encode(array('status' => 'success'));
} else {
    echo json_encode(array('status' => 'error'));
}
exit;