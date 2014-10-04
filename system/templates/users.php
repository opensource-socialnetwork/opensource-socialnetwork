<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$users = $params['users'];
foreach($users as $user){ ?>

<div class="ossn-view-users">
  <img src="<?php echo ossn_site_url("avatar/{$user->username}/large");?>" width='100' height="100"/>
 <div class="uinfo">
    <a class="userlink" href="<?php echo ossn_site_url();?>u/<?php echo $user->username;?>"><?php echo $user->fullname;?></a>
 </div>
<?php if(ossn_isLoggedIn()){ ?> 
    <?php if(ossn_loggedin_user()->guid !== $user->guid){ 
			         if(!ossn_user_is_friend(ossn_loggedin_user()->guid ,$user->guid)){   
                   if(ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)){ ?>
                   <a href="<?php echo ossn_site_url();?>action/friend/remove?cancel=true&user=<?php echo $user->guid;?>" class='button-grey friendlink'>
                       <?php echo ossn_print('cancel:request');?>
                    </a>   
                        <?php } else { ?>
                   <a href="<?php echo ossn_site_url();?>action/friend/add?user=<?php echo $user->guid;?>" class='button-grey friendlink'>
                   <?php echo ossn_print('add:friend');?>
                   </a> 
                      <?php
						}
					   } else { ?>
                  <a href="<?php echo ossn_site_url();?>action/friend/remove?user=<?php echo $user->guid;?>" class='button-grey friendlink'>
                       <?php echo ossn_print('remove:friend');?>
                    </a>   
                       <?php }
					   
	}
}?>
</div>


<?php } ?>