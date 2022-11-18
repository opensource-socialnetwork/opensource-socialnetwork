<?php

//Wall upgrade for old versions.
$wall = new OssnWall();
$posts = $wall->GetPosts(array(
		'page_limit' => false,
));
if($posts){
		foreach($posts as $post){
					$data	 = json_decode($post->description, true);
					$data['post']	 = strip_tags(html_entity_decode($data['post']));
                         
					$post->description = json_encode($data, JSON_UNESCAPED_UNICODE);	
					$post->save();
		}
}
