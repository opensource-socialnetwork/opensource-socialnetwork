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

$image = ossn_get_entity($params['post']->item_guid);
$image = ossn_profile_coverphoto_wall_url($image);
?>
<div class="ossn-wall-item" id="activity-item-<?php echo $params['post']->guid; ?>">
	<div class="row">
		<div class="meta">
			<img class="user-img" src="<?php echo $params['user']->iconURL()->small; ?>" />
			<div class="post-menu">
				<div class="dropdown">
                 <?php
           			if (ossn_is_hook('wall', 'post:menu') && ossn_isLoggedIn()) {
                		$menu['post'] = $params['post'];
               			echo ossn_call_hook('wall', 'post:menu', $menu);
            			}
            		?>   
				</div>
			</div>
			<div class="user">
           <?php if ($params['user']->guid == $params['post']->owner_guid) { ?>
                <a class="owner-link" href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
                <div class="ossn-wall-item-type"><?php echo ossn_print('ossn:profile:cover:picture:updated');?></div>
            <?Php
            } else {

                $owner = ossn_user_by_guid($params['post']->owner_guid);
                ?>
                <a href="<?php echo $params['user']->profileURL(); ?>">
                    <?php echo $params['user']->fullname; ?>
                </a>
                <i class="fa fa-angle-right fa-lg"></i>
                <a href="<?php echo $owner->profileURL(); ?>"> <?php echo $owner->fullname; ?></a>
            <?php } ?>
			</div>
			<div class="post-meta">
				<span class="time-created"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
			</div>
		</div>

       <div class="post-contents">
                <img src="<?php echo $image; ?>"/>
    	</div>
	<?php
		$vars['entity'] = ossn_get_entity($params['post']->item_guid);
		echo ossn_plugin_view('entity/comment/like/share/view', $vars);
	?>    
	</div>
</div>
