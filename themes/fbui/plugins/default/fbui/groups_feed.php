<?php
$groups = new OssnGroup();
$list   = $groups->getMyGroups(ossn_loggedin_user(), array(
			'page_limit' => false,
			'offset' => false,
));
$args = array(
			'type' => 'group',							   
);

if($list){
		$results = array();
		foreach ($list as $group){
						$results[] = $group->guid;
		}
		$usergroups = array_unique($results);
		$ugroups    = implode(',', $usergroups);
		if(!empty($ugroups)){
				$groups_query = "o.owner_guid IN($ugroups)";
		}
		$user = ossn_loggedin_user();
		$args['entities_pairs'][] =  array(
						'name'   => 'poster_guid',
						'value'  => true,
						'wheres' => "({$groups_query}) AND (emd0.value NOT IN (SELECT DISTINCT relation_to FROM `ossn_relationships` WHERE relation_from={$user->guid} AND type='userblock') AND emd0.value NOT IN (SELECT DISTINCT relation_from FROM `ossn_relationships` WHERE relation_to={$user->guid} AND type='userblock'))",
		);
		$wall = new OssnWall();
		$posts = $wall->GetPosts($args);
		
if($posts) {
		foreach ($posts as $index => $post) {
				$item = ossn_wallpost_to_item($post);
				if(ossn_get_context() == 'groups_feed'){
					$item['show_group'] = true;
				}
				echo ossn_wall_view_template($item);
		}
}		
}