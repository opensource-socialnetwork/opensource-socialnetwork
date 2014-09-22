<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
ossn_trigger_callback('comment', 'load', $params['comment']);  
$OssnLikes = new OssnLikes;
$comment = arrayObject($params['comment'], 'OssnWall');
$user = ossn_user_by_guid($comment->owner_guid);
if($comment->type == 'comments:post' || $comment->type == 'comments:entity'){
   $type = 'annotation';
}
$likes_total = $OssnLikes->CountLikes($comment->id, $type);
if($likes_total > 0){
	$datalikes = $likes_total;
    $likes_total = '<span class="dot-likes">.</span><div class="ossn-like-icon"></div>'.$likes_total;
}
?>
     <div class="comments-item" id="comments-item-<?php echo $comment->id;?>">    
              <div class="ossn-comment-menu" onclick="Ossn.CommentMenu(this);">
                      <?php 
						echo  ossn_view_menu('comments', 'components/OssnComments/menu/comments');
					  ?>
              </div>   
             <div class="poster-image">
               <img src="<?php echo $user->iconURL()->smaller;?>" />
            </div>  
             <div class="comment-text">
                  <p>
                  <a class="owner-link" href="<?php echo $user->profileURL();?>"><?php echo $user->fullname;?></a> 
                 <?php
				   if($comment->type == 'comments:entity'){
				      echo $comment->getParam('comments:entity');
                   } elseif($comment->type == 'comments:post'){
 					  echo $comment->getParam('comments:post');  
				   }
				   $image = $comment->getParam('file:comment:photo');
				   if(!empty($image)){
					    $image = str_replace('comment/photo/', '', $image);
					    $image = ossn_site_url("comment/image/{$comment->id}/{$image}");
					    echo "<img src='{$image }' />";
				   }
				  ?>
                  </p>
                  <div class="comment-metadata"> <?php echo ossn_user_friendly_time($comment->time_created);?> 
                    <?php if(!$OssnLikes->isLiked($comment->id, ossn_loggedin_user()->guid, $type)){ ?>
                     <a class="ossn-like-comment" href="<?php echo ossn_site_url();?>action/annotation/like?annotation=<?php echo $comment->id;?>">
					 <?php echo ossn_print('like');?></a> 
                    <?php } else { ?>
                     <a class="ossn-like-comment" href="<?php echo ossn_site_url();?>action/annotation/unlike?annotation=<?php echo $comment->id;?>">
                     <?php echo ossn_print('unlike');?></a>    
                     <?php } ?>
                   <a href="javascript::;" class="ossn-total-likes-<?php echo $comment->id;?>" data-likes='<?php echo $datalikes;?>'><?php echo $likes_total;?></a>                        
                  </div>
             </div>
          </div> 