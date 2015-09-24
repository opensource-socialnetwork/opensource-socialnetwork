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
            <?Php
            } else {

                $owner = ossn_user_by_guid($params['post']->owner_guid);
                ?>
                <a class="owner-link" href="<?php echo $params['user']->profileURL(); ?>">
                    <?php echo $params['user']->fullname; ?>
                </a>
                <div class="ossn-wall-on ossn-posted-on"></div>
                <a class="owner-link" href="<?php echo $owner->profileURL(); ?>"> <?php echo $owner->fullname; ?></a>
            <?php } ?>
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
            <div class="post-text"><?php echo stripslashes($params['text']); ?>
                <?php
                if (is_array($params['friends']) && !empty($params['friends'][0])) {
                    ?>
                    <div class="friends">
                        &#x2014; with
                        <?php
                        foreach ($params['friends'] as $friend) {
                            $user = ossn_user_by_guid($friend);
                            $url = $user->profileURL();
                            $friends[] = "<a href='{$url}'>{$user->fullname}</a>";
                        }
                        echo implode(', ', $friends);
                        ?>
                    </div>
                <?php } ?>


            </div>

            <?php
            if (!empty($image)) {
                ?>
                <img src="<?php echo ossn_site_url("post/photo/{$params['post']->guid}/{$image}"); ?>"/>

            <?php } ?>


        </div>
    </div>
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
</div>
