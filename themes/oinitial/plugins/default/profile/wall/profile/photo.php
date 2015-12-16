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

$image = ossn_get_entity($params['post']->item_guid);
$image = ossn_profile_photo_wall_url($image);
?>
<div class="activity-item" id="activity-item-<?php echo $params['post']->guid; ?>">

    <div class="activity-item-container">
        <div class="owner">
            <img src="<?php echo $params['user']->iconURL()->small; ?>" width="40" height="40"/>
        </div>
        <div class="post-controls">
            <?php
            if (ossn_is_hook('wall', 'post:menu') && ossn_isLoggedIn()) {
                $menu['post'] = $params['post'];
                echo ossn_call_hook('wall', 'post:menu', $menu);
            }
            ?>
        </div>

        <div class="subject">
            <?php if ($params['user']->guid == $params['post']->owner_guid) { ?>
                <a class="owner-link"
                   href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
                   <div class="ossn-wall-item-type"><?php echo ossn_print('ossn:profile:picture:updated');?></div>
            <?php
            } 
			?>
            <br/>

            <div class="time">
                <?php echo ossn_user_friendly_time($params['post']->time_created); ?>
                <?php echo $params['location']; ?> -
                <div
                    class="ossn-inline-table ossn-icon-access-<?php echo ossn_access_id_str($params['post']->access); ?>"
                    title="<?php echo ossn_print("title:access:{$params['post']->access}"); ?>"></div>
            </div>
        </div>

        <div class="description">
                 <img src="<?php echo $image; ?>"/>
        </div>
    </div>
<?php
	$vars['entity'] = ossn_get_entity($params['post']->item_guid);
	echo ossn_plugin_view('entity/comment/like/share/view', $vars);
?>
</div>
