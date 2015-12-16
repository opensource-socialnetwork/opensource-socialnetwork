<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
ossn_trigger_callback('comment', 'load', $params['comment']);
$comment = arrayObject($params['comment'], 'OssnWall');
$user = ossn_user_by_guid($comment->owner_guid);
if ($comment->type == 'comments:post' || $comment->type == 'comments:entity') {
    $type = 'annotation';
}

if(class_exists('OssnLikes')){
	$OssnLikes = new OssnLikes;
	$likes_total = $OssnLikes->CountLikes($comment->id, $type);
	$datalikes = '';
	if ($likes_total > 0) {
    	$datalikes = $likes_total;
    	$likes_total = '<span class="dot-likes">.</span><div class="ossn-like-icon"></div>' . $likes_total;
	}
}
?>
<div class="comments-item" id="comments-item-<?php echo $comment->id; ?>">
    <div class="ossn-comment-menu" onclick="Ossn.CommentMenu(this);">
        <?php
        echo ossn_view_menu('comments', 'comments/menu/comments');
        ?>
    </div>
    <div class="poster-image">
        <img class="poster-image-icon" src="<?php echo $user->iconURL()->smaller; ?>"/>
    </div>
    <div class="comment-text">
        <p>
            <?php
			 echo ossn_plugin_view('output/url', array(
									'href' => $user->profileURL(), 
									'text' => $user->fullname, 
									'class' => 'owner-link',
			  ));			
            if ($comment->type == 'comments:entity') {
                echo ' '.$comment->getParam('comments:entity');
            } elseif ($comment->type == 'comments:post') {
                echo ' '.$comment->getParam('comments:post');
            }
            $image = $comment->getParam('file:comment:photo');
            if (!empty($image)) {
                $image = str_replace('comment/photo/', '', $image);
                $image = ossn_site_url("comment/image/{$comment->id}/{$image}");
                echo "<img src='{$image}' />";
            }
            ?>
        </p>

        <div class="comment-metadata"> <?php echo ossn_user_friendly_time($comment->time_created); ?>
            <?php if (ossn_isLoggedIn() && class_exists('OssnLikes')) {
                	 if (!$OssnLikes->isLiked($comment->id, ossn_loggedin_user()->guid, $type)) {
							echo ossn_plugin_view('output/url', array(
									'href' => ossn_site_url("action/annotation/like?annotation={$comment->id}"), 
									'text' => ossn_print('like'), 
									'class' => 'ossn-like-comment',
									'data-type' => 'Like',
									'action' => true
									));
                		 } else { 
						 	echo ossn_plugin_view('output/url', array(
									'href' => ossn_site_url("action/annotation/unlike?annotation={$comment->id}"), 
									'text' => ossn_print('unlike'), 
									'class' => 'ossn-like-comment',
									'data-type' => 'Unlike',
									'action' => true
									));
                		 }

            	} // Likes only for loggedin users end 
				// Show total likes
				if($likes_total){
					echo ossn_plugin_view('output/url', array(
						'href' => 'javascript:void(0);', 
						'text' => $likes_total, 
						'class' => "ossn-total-likes-{$comment->id}",
						'data-likes' => $datalikes,
						));
				}
				?>
        </div>
    </div>
</div>
