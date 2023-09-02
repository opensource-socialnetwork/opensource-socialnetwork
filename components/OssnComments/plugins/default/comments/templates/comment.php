<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
ossn_trigger_callback('comment', 'load', $params['comment']);
$comment = arrayObject($params['comment'], 'OssnComments');
$user = ossn_user_by_guid($comment->owner_guid);
if ($comment->type == 'comments:post' || $comment->type == 'comments:entity' || $comment->type == 'comments:object') {
    $type = 'annotation';
}
$datalikes = '';
if(class_exists('OssnLikes')) {
	$OssnLikes = new OssnLikes;
	$likes_total = $OssnLikes->CountLikes($comment->id, $type);
	$datalikes = $likes_total;
} else {
	$likes_total = 0;
}
$last_three = array();
if($datalikes  > 0){ 
	foreach($OssnLikes->__likes_get_all as $item){
			$last_three_icons[$item->subtype] = $item->subtype;
	}
	$last_three = array_slice($last_three_icons, -3);
}
$allow_comment_like = true;
if(isset($comment->allow_comment_like) && $comment->allow_comment_like == false){
	$allow_comment_like = false;
}
?>
<div class="comments-item" id="comments-item-<?php echo $comment->id; ?>">
	<div class="row">
		<div class="col-md-1">
			<img class="comment-user-img user-icon-smaller" src="<?php echo $user->iconURL()->smaller; ?>" />
		</div>
		<div class="col-md-11">
			<div class="comment-contents">
				<p>
					<?php
						echo ossn_plugin_view('output/user/url', array(
							'user' => $user,	
							'class' => 'owner-link',
							'section' => 'comments',
						));						
						echo "<span class='comment-text'>";
						        if ($comment->type == 'comments:entity') {
						            echo nl2br($comment->getParam('comments:entity'));
						        } elseif ($comment->type == 'comments:object') {
						            echo nl2br($comment->getParam('comments:object'));
						        } elseif ($comment->type == 'comments:post') {
						            echo nl2br($comment->getParam('comments:post'));
						        }
						echo "</span>";
						        $image = $comment->photoURL();
						        if (!empty($image)) {
						            echo "<img src='{$image}' />";
						        }
						        ?>
				</p>
				<div class="comment-metadata">
					<div class="time-created"><?php echo ossn_user_friendly_time($comment->time_created); ?></div>
					<?php
						if (class_exists('OssnLikes') && $allow_comment_like) {
							if (ossn_isLoggedIn()) {
						             	 if (!$OssnLikes->isLiked($comment->id, ossn_loggedin_user()->guid, $type)) {
												echo ossn_plugin_view('output/url', array(
													'href' => ossn_site_url("action/annotation/like?annotation={$comment->id}"), 
													'text' => ossn_print('like'), 
													'class' => 'ossn-like-comment',
													'id' => 'ossn-like-comment-'.$comment->id,
													'data-type' => 'Like',
													'data-id' => $comment->id,
													'action' => true
												));
						             		 } else { 
									 			echo ossn_plugin_view('output/url', array(
													'href' => ossn_site_url("action/annotation/unlike?annotation={$comment->id}"), 
													'text' => ossn_print('unlike'), 
													'class' => 'ossn-like-comment',
													'id' => 'ossn-like-comment-'.$comment->id,									
													'data-type' => 'Unlike',
													'data-id' => $comment->id,
													'action' => true
												));
						             		 }
						
						         	} // Likes only for loggedin users end 
						} ?>
					<div class="ossn-comment-menu">
						<div class="dropdown">
							<?php
								echo ossn_view_menu('comments', 'comments/menu/comments');
								?>
						</div>
					</div>
					<?php if (class_exists('OssnLikes')) { ?>
					<span class="ossn-likes-annotation-total">
					<?php
						// Show total likes
						echo ossn_plugin_view('output/url', array(
										'href' => 'javascript:void(0);', 
										'text' => $likes_total, 
										'onclick' => "Ossn.ViewLikes({$params['comment']['id']}, 'annotation')",
										'class' => "ossn-total-likes ossn-total-likes-{$params['comment']['id']}",
										'data-likes' => $datalikes,
						));
						?>
					</span>                    
					<div class="ossn-reaction-list">
						<?php if(isset($last_three['like'])){ ?>
						<li>
							<div class="emoji  emoji--like">
								<div class="emoji__hand">
									<div class="emoji__thumb"></div>
								</div>
							</div>
						</li>
						<?php } ?>        
						<?php if(isset($last_three['love'])){ ?>
						<li>
							<div class="emoji emoji--love">
								<div class="emoji__heart"></div>
							</div>
						</li>
						<?php } ?>
						<?php if(isset($last_three['haha'])){ ?>
						<li>
							<div class="emoji  emoji--haha">
								<div class="emoji__face">
									<div class="emoji__eyes"></div>
									<div class="emoji__mouth">
										<div class="emoji__tongue"></div>
									</div>
								</div>
							</div>
						</li>
						<?php } ?> 
						<?php if(isset($last_three['yay'])){ ?>        
						<li>
							<div class="emoji  emoji--yay">
								<div class="emoji__face">
									<div class="emoji__eyebrows"></div>
									<div class="emoji__mouth"></div>
								</div>
							</div>
						</li>
						<?php } ?>
						<?php if(isset($last_three['wow'])){ ?>
						<li>
							<div class="emoji  emoji--wow">
								<div class="emoji__face">
									<div class="emoji__eyebrows"></div>
									<div class="emoji__eyes"></div>
									<div class="emoji__mouth"></div>
								</div>
							</div>
						</li>
						<?php } ?>
						<?php if(isset($last_three['sad'])){ ?>
						<li>
							<div class="emoji  emoji--sad">
								<div class="emoji__face">
									<div class="emoji__eyebrows"></div>
									<div class="emoji__eyes"></div>
									<div class="emoji__mouth"></div>
								</div>
							</div>
						</li>
						<?php } ?>
						<?php if(isset($last_three['angry'])){ ?>
						<li>
							<div class="emoji  emoji--angry">
								<div class="emoji__face">
									<div class="emoji__eyebrows"></div>
									<div class="emoji__eyes"></div>
									<div class="emoji__mouth"></div>
								</div>
							</div>
						</li>
						<?php } ?>
					</div>  <!-- reaction list panel -->
					<?php } // OssnLikes class check end ?>              
				</div> <!-- comment metadata -->
			</div>
		</div>
	</div>
</div>
