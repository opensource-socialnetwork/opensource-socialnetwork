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
$requests = $params['group']->getMembersRequests();
if(empty($requests)){
  echo '<div class="ossn-group-no-requests">'.ossn_print('no:requests').'</div>';	
}
foreach($requests as $user){ ?>

<div class="ossn-group-members">
  <img src="<?php echo ossn_site_url("avatar/{$user->username}/large");?>" width='100' height="100"/>
 <div class="uinfo">
    <a class="userlink" href="<?php echo ossn_site_url();?>u/<?php echo $user->username;?>"><?php echo $user->fullname;?></a>
 </div>
    <a href="<?php echo ossn_site_url();?>action/group/member/approve?group=<?php echo $params['group']->guid;?>&user=<?php echo $user->guid;?>" class='friendlink button-grey-light'><?php echo ossn_print('approve');?></a>
    <a href="<?php echo ossn_site_url();?>action/group/member/decline?group=<?php echo $params['group']->guid;?>&user=<?php echo $user->guid;?>" class='friendlink button-grey-light'><?php echo ossn_print('approve');?></a>
                 
</div>

<?php } 
