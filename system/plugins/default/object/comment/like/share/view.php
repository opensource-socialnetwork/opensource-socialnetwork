<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 ossn_trigger_callback('object', 'load:comment:share:like', $params);
 $object['params'] = $params;
 $object['object_guid'] = $params['object']->guid;
 ?>
<div class="comments-likes ossn-photos-comments">
	<div class="menu-likes-comments-share">
            	<?php echo ossn_view_menu('object_extra');?>
	</div>     
	<?php
		if(ossn_is_hook('post', 'likes:object')) {
 			if(isset($params['allow_like'])){
					$object['allow_like'] = $params['allow_like'];	
			}
			echo ossn_call_hook('post', 'likes:object', $object);
		}
	?>
    <div class="comments-list">
    <?php
	if(ossn_is_hook('post', 'comments:object')) {
		if(isset($params['allow_comment'])){
				$object['allow_comment'] = $params['allow_comment'];	
		}				
		echo ossn_call_hook('post', 'comments:object', $object);
	}
	?>
    </div>
</div>
