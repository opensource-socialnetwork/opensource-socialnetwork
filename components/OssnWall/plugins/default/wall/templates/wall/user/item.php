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

$image = $params['image'];
?>
<!-- wall item -->
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
                <a class="owner-link"
                   href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
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
                <span class="time-created"><?php echo $params['location']; ?></span>
                <?php
					echo ossn_plugin_view('privacy/icon/view', array(
							'privacy' => $params['post']->access,
							'text' => '-',
							'class' => 'time-created',
					));
				?>
			</div>
		</div>
		<div class="post-contents">
			<p><?php echo stripslashes($params['text']); ?></p>
			 <?php
						if(!empty($params['friends'])){
	                        foreach ($params['friends'] as $friend) {
								if(!empty($friend)){
	    	                        $user = ossn_user_by_guid($friend);
    	    	                    $url = $user->profileURL();
        	    	                $friends[] = "<a href='{$url}'>{$user->fullname}</a>";
								}
                	        }
							if(!empty($friends)){
								echo '<div class="friends">';
								echo implode(', ', $friends);
								echo '</div>';
							}
						}
              ?>
            <?php
            if (!empty($image)) {
                ?>
                <img src="<?php echo ossn_site_url("post/photo/{$params['post']->guid}/{$image}"); ?>"/>

            <?php } ?>          
		</div>
		<div class="comments-likes">
			<div class="menu-likes-comments-share">
				<?php echo ossn_view_menu('postextra', 'wall/menus/postextra');?>
			</div>
         	<?php
      		  if (ossn_is_hook('post', 'likes')) {
          			  echo ossn_call_hook('post', 'likes', $params['post']);
        		}
      		  ?>           
			<div class="comments-list">
              <?php
          			  if (ossn_is_hook('post', 'comments')) {
                			echo ossn_call_hook('post', 'comments', $params['post']);
           			   }
            		?>            				
			</div>
		</div>
	</div>
</div>
<!-- ./ wall item -->
