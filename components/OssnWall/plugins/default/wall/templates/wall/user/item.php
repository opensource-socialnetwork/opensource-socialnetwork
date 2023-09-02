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

$image = $params['image'];
//if user didn't exists not wall item #1110
if(!$params['user']){
	error_log("Post creator doesn't exist for wallpost with guid : {$params['post']->guid}");
	return;
}
$owner = false;
if ($params['user']->guid !== $params['post']->owner_guid) {
	$owner = ossn_user_by_guid($params['post']->owner_guid);
	if (!$owner) {
		error_log("Post receiver doesn't exist for wallpost with guid : {$params['post']->guid}");
		return;
	}
}
?>
<!-- wall item -->
<div class="ossn-wall-item ossn-wall-item-<?php echo $params['post']->guid; ?>" id="activity-item-<?php echo $params['post']->guid; ?>">
	<div class="row">
		<div class="meta">
			<img class="user-icon-small user-img" src="<?php echo $params['user']->iconURL()->small; ?>" />
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
                <?php
				echo ossn_plugin_view('output/user/url', array(
						'user' => $params['user'],		
						'section' => 'wall',
				));
				?>
				<?php
 		                if ($owner) { ?>
					<i class="fa fa-angle-right fa-lg"></i>
					<?php
						echo ossn_plugin_view('output/user/url', array(
							'user' => $owner,			
						));
				} ?>
			</div>
			<div class="post-meta">
				<span class="time-created ossn-wall-post-time" title="<?php echo date('d/m/Y', $params['post']->time_created);?>" onclick="Ossn.redirect('<?php echo("post/view/{$params['post']->guid}");?>');"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
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
			<p><?php echo $params['text']; ?></p>
			 <?php
				if(!empty($params['friends'])){
					foreach ($params['friends'] as $friend) {
						if(!empty($friend)){
							$user = ossn_user_by_guid($friend);
							//[B] Wall site crash when mentioning members under certain conditions. #1865
							if($user){
								//here no need to use output/user/url
								$url = $user->profileURL();
								$friends[] = "<a href='{$url}'>{$user->fullname}</a>";
							}
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
                <div class="ossn-wall-image-container"><img src="<?php echo $image; ?>"/></div>

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
          			  if (ossn_is_hook('post', 'comments')){
                			$vars = array();
                			$vars['post'] =  $params['post'];						  
                			echo ossn_call_hook('post', 'comments', $vars);
           			   }
            		?>            				
			</div>
		</div>
	</div>
</div>
<!-- ./ wall item -->
