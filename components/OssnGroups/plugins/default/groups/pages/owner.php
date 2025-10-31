<div class="ossn-page-contents">
	<p><strong><?php echo ossn_print('group:my');?></strong></p>
    <?php
	
	$args = array(
			'offset' => input('my_group_offset', '' , 1),			  
	);
	$groups = ossn_get_user_groups(ossn_loggedin_user(), $args);
	$count =  ossn_get_user_groups(ossn_loggedin_user(), array(
				'count' => true,														 
	));
	echo ossn_plugin_view('groups/search/view', array(
				'groups' => $groups,											  
	));
	echo ossn_view_pagination($count, 10, ['offset_name' => 'my_group_offset']);
	?>
</div>