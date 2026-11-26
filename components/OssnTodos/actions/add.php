<?php
header('Content-Type: application/json');
$title       = input('title');
$description = input('description');
$due_date    = input('due_date');
$priority    = input('priority');

$todos = new OssnTodos();
$guid  = $todos->addTodo(ossn_loggedin_user()->guid, $title, $description, $due_date, $priority);

if($guid) {
		$item = ossn_get_object($guid);
		echo json_encode(array(
				'status'      => 'success',
				'guid'        => $guid,
				'title'       => $item->title,
				'description' => $item->description,
				'due_date'    => $item->due_date,
				'priority'    => $item->priority,
		));
} else {
		echo json_encode(array(
				'status'  => 'error',
				'message' => ossn_print('ossntodos:add:error'),
		));
}
exit();