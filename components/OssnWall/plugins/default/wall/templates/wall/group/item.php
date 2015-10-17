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
$image = $params['image'];
if (!isset($params['show_group'])) {
    $params['show_group'] = NULL;
}
if(!isset($params['ismember'])){
    $group = ossn_get_group_by_guid($params['post']->owner_guid);
    if ($group->isMember(NULL, ossn_loggedin_user()->guid)) {
      	$params['ismember'] = 1;
    }
}
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
            <?php
            $owner = ossn_user_by_guid($params['post']->owner_guid);
            ?>
            <a class="owner-link"
               href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
            <?php if ($params['show_group'] == true) {
                $group = ossn_get_group_by_guid($params['post']->owner_guid);
                ?>
                <div class="ossn-wall-on ossn-posted-on"></div>
                <a class="owner-link"
                   href="<?php echo ossn_site_url("group/{$group->guid}"); ?>"> <?php echo $group->title; ?></a>
            <?php } ?>
            <br/>

            <div class="time">
                <?php echo ossn_user_friendly_time($params['post']->time_created); ?>
                <?php echo $params['location']; ?> -
                <div
                    class="ossn-inline-table ossn-icon-access-<?php echo ossn_access_id_str($params['post']->access); ?>"
                    title="<?php echo ossn_print('title:access:private:group'); ?>"></div>

            </div>
        </div>

        <div class="description">
            <div class="post-text"><?php echo stripslashes($params['text']); ?>  </div>
            <?php
            if (!empty($image)) {
                ?>
                <img src="<?php echo ossn_site_url("post/photo/{$params['post']->guid}/{$image}"); ?>"/>

            <?php } ?>
        </div>
    </div>
    <?php
	if($params['ismember'] === 1){ 
	?>
    <div class="comments-likes">
         <div class="menu-likes-comments-share">
	    	<div class="like_share comments-like-comment-links">
            	<?php echo ossn_view_menu('postextra', 'wall/menus/postextra');?>
            </div>
        </div>        
        <?php
        if (ossn_is_hook('post', 'likes')) {
            echo ossn_call_hook('post', 'likes', $params['post']);
        }
        ?>
        <div class="comments-item" style="border-bottom:1px solid #ddd;">
            <?php
            if (ossn_is_hook('post', 'comments')) {
                echo ossn_call_hook('post', 'comments', $params['post']);
            }
            ?>
        </div>
    </div>
    <?php } ?>
</div>
