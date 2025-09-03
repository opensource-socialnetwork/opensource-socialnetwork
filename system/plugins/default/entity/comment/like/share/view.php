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
 ossn_trigger_callback('entity', 'load:comment:share:like', $params);
 $entity['params'] = $params;
 $entity['entity_guid'] = $params['entity']->guid;
 ?>
<div class="comments-likes ossn-photos-comments">
	<div class="menu-likes-comments-share">
            	<?php echo ossn_view_menu('entityextra');?>
	</div>     
    <?php
    if(ossn_is_hook('post', 'likes:entity')) {
 	if(isset($params['allow_like'])){
                $entity['allow_like'] = $params['allow_like'];	
 	}		
        echo ossn_call_hook('post', 'likes:entity', $entity);
    }
    ?>
    <div class="comments-list">
    <?php
    if (ossn_is_hook('post', 'comments:entity')) {
 	if(isset($params['allow_comment'])){
                 $entity['allow_comment'] = $params['allow_comment'];	
 	}				
        echo ossn_call_hook('post', 'comments:entity', $entity);
    }
    ?>
    </div>
</div>
