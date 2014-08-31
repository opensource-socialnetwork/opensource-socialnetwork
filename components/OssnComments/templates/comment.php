<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
$OssnLikes = new OssnLikes;
$comment = arrayObject($params['comment'], 'OssnWall');
$user = ossn_user_by_guid($comment->owner_guid);
$likes_total = $OssnLikes->CountLikes($comment->id);
?>
     <div class="comments-item" id="comments-item-<?php echo $comment->id;?>">    
             <div class="poster-image">
               <img src="<?php echo ossn_site_url();?>avatar/<?php echo $user->username;?>/smaller" />
            </div>  
             <div class="comment-text">
                  <p><a class="owner-link" href="#"><?php echo $user->fullname;?></a> 
                  <?php echo $comment->value;?></p>
                  <div class="comment-metadata"> <?php echo ossn_user_friendly_time($comment->time_created);?> 
                    <?php if(!$OssnLikes->isLiked($comment->id, ossn_loggedin_user()->guid)){ ?>
                     <a  href="<?php echo ossn_site_url();?>action/annotation/like?annotation=<?php echo $comment->id;?>">
					 <?php echo ossn_print('like');?></a> 
                    <?php } else { ?>
                     <a  href="<?php echo ossn_site_url();?>action/annotation/unlike?annotation=<?php echo $comment->id;?>">
                     <?php echo ossn_print('unlike');?></a>    
                     <?php } ?>
                   <a href="#"><?php echo $likes_total;?></a>                        
                  </div>
             </div>
          </div> 