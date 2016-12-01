<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
ossn_trigger_callback('comment', 'load', $params['comment']);
$comment = arrayObject($params['comment'], 'OssnWall');
$user = ossn_user_by_guid($comment->owner_guid);
if ($comment->type == 'comments:post' || $comment->type == 'comments:entity') {
    $type = 'annotation';
}
if(class_exists('OssnLikes')) {
	$OssnLikes = new OssnLikes;
	$likes_total = $OssnLikes->CountLikes($comment->id, $type);
} else {
	$likes_total = 0;
}
$datalikes = '';
if ($likes_total > 0) {
    $datalikes = $likes_total;
    $likes_total = "<i class='fa fa-thumbs-up'></i>" . $likes_total;
}
?>

<div class="comments-item" id="comments-item-<?php echo $comment->id; ?>">
    <div class="row">
        <div class="col-md-1">
            <img class="comment-user-img" src="<?php echo $user->iconURL()->smaller; ?>" />
        </div>
        <div class="col-md-11">

            <div class="comment-contents">
        <p>
            <?php
			 echo ossn_plugin_view('output/url', array(
									'href' => $user->profileURL(), 
									'text' => $user->fullname, 
									'class' => 'owner-link',
			  ));			
            if ($comment->type == 'comments:entity') {
                echo ' '.nl2br($comment->getParam('comments:entity'));
            } elseif ($comment->type == 'comments:post') {
                echo ' '.nl2br($comment->getParam('comments:post'));
            }
            $image = $comment->getParam('file:comment:photo');
            if (!empty($image)) {
                $image = str_replace('comment/photo/', '', $image);
                $image = ossn_site_url("comment/image/{$comment->id}/{$image}");
                echo "<img src='{$image}' />";
            }
            ?>
        </p>
<div class="comment-metadata"> 
			<div class="time-created"><?php echo ossn_user_friendly_time($comment->time_created); ?></div>
            <?php
			if (class_exists('OssnLikes')) {
				if (ossn_isLoggedIn()) {
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
				echo ossn_plugin_view('output/url', array(
						'href' => 'javascript:void(0);', 
						'text' => $likes_total, 
						'onclick' => "Ossn.ViewLikes({$comment->id}, 'annotation')",
						'class' => "ossn-total-likes ossn-total-likes-{$comment->id}",
						'data-likes' => $datalikes,
						));
			} // OssnLikes class check end
			?>
                     <div class="ossn-comment-menu">
            	<div class="dropdown">
	        	<?php
    	   			 echo ossn_view_menu('comments', 'comments/menu/comments');
       			 ?>
                 </div>
    		</div>            
        </div>
            </div>
        </div>
    </div>
</div>
