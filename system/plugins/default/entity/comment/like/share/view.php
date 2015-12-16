<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
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
