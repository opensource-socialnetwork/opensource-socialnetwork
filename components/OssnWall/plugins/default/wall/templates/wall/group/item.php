<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$image = $params['image'];
$group = ossn_get_group_by_guid($params['post']->owner_guid);
if(!isset($params['ismember'])){
    if ($group){
    	if ($group->isMember(NULL, ossn_loggedin_user()->guid)){
      		$params['ismember'] = 1;
    	}
    }
}
if(!$group){
		error_log("Group didn't exists for the wallpost with guid : {$params['post']->guid} and Group with Guid: {$params['post']->owner_guid}");
		return;	
}
//if user didn't exists not wall item #1110
if(!$params['user']){
		error_log("User didn't exists for wallpost with guid : {$params['post']->guid}");
		return;
}
?>
<!-- wall item -->
<div class="ossn-wall-item ossn-wall-item-<?php echo $params['post']->guid; ?>" id="activity-item-<?php echo $params['post']->guid; ?>">
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
            <a class="owner-link" href="<?php echo $params['user']->profileURL(); ?>"> <?php echo $params['user']->fullname; ?> </a>
            <?php if ($params['show_group'] == true) {
                $group = ossn_get_group_by_guid($params['post']->owner_guid);
                ?>
               <i class="fa fa-angle-right fa-lg"></i>
                <a class="owner-link"  href="<?php echo ossn_site_url("group/{$group->guid}"); ?>"> <?php echo $group->title; ?></a>
            <?php } ?>        
			</div>
			<div class="post-meta">
				<span class="time-created ossn-wall-post-time" title="<?php echo date('d/m/Y', $params['post']->time_created);?>" onclick="Ossn.redirect('<?php echo("post/view/{$params['post']->guid}");?>');"><?php echo ossn_user_friendly_time($params['post']->time_created); ?></span>
                <span class="time-created"><?php echo $params['location']; ?></span>
                <?php
					//[E] Group wall post should show group privacy as wall privacy icon #1721
					echo ossn_plugin_view('privacy/icon/view', array(
							'privacy' => (int)$group->membership,
							'text' => '-',
							'class' => 'time-created',
					));
				?>                
			</div>
		</div>
		<div class="post-contents">
			<p><?php echo $params['text']; ?></p>
             <?php
            if (!empty($image)) {
                ?>
                <img src="<?php echo ossn_site_url("post/photo/{$params['post']->guid}/{$image}"); ?>"/>

            <?php } ?>
         
		</div>
        <?php if($params['ismember'] === 1){  ?>
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
        <?php } ?>
	</div>
</div>
<!-- ./ wall item -->
