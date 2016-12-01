<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 ossn_trigger_callback('entity', 'load:comment:share:like', $params);
 ?>
<div class="comments-likes ossn-photos-comments">
	<div class="menu-likes-comments-share">
            	<?php echo ossn_view_menu('entityextra');?>
	</div>     
 	<?php
    if (ossn_is_hook('post', 'likes:entity')) {
		$entity['params'] = $params;
        $entity['entity_guid'] = $params['entity']->guid;
        echo ossn_call_hook('post', 'likes:entity', $entity);
    }
    ?>
    <div class="comments-list">
    <?php
    if (ossn_is_hook('post', 'comments:entity')) {
		$entity['params'] = $params;
        $entity['entity_guid'] =  $params['entity']->guid;
        echo ossn_call_hook('post', 'comments:entity', $entity);
    }
    ?>
    </div>
</div>
