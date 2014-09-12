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
?>
<div class="ossn-group-profile">
  <div class="profile-header">
    <div class="header-users">
    <?php 
	$members = $params['group']->getMembers();
	foreach($members as $member){ ?>
     <img src="<?php echo ossn_site_url("avatar/{$member->username}/large");?>"/>
    <?php } ?>
    </div>
  
    <div class="header-bottom">
      <div class="group-name">
        <a href="<?php echo ossn_group_url($params['group']->guid);?>"><?php echo $params['group']->title;?></a>
      </div>
      <div id="group-header-menu" class="group-header-menu">
         <ul>
            <?php echo ossn_view_menu('groupheader');?>
        </ul>
      </div>
      
       <div class="groups-buttons">
         <?php  if($params['group']->owner_guid !== ossn_loggedin_user()->guid){ 
		           if($params['group']->isMember(NULL, ossn_loggedin_user()->guid)){
				      $ismember = 1;
		 ?> 
                    <a href="<?php echo ossn_site_url("action/group/leave?group={$params['group']->guid}");?>" class='button-grey'>
                    <?php echo ossn_print('leave:group');?></a>
                <?php }
				else if(!$params['group']->requestExists(ossn_loggedin_user()->guid, false)){
				?>
                 <a href="<?php echo ossn_site_url("action/group/join?group={$params['group']->guid}");?>" class='button-grey'>
                    <?php echo ossn_print('join:group');?></a>
                <?php	
				  } 
                  
                  if($params['group']->requestExists(ossn_loggedin_user()->guid, false)){ ?>
				  <a href="<?php echo ossn_site_url("action/group/member/cancel?group={$params['group']->guid}");?>" class='button-grey'>
                  <?php echo ossn_print('cancel:membership');?></a>	  
				<?php  }?>
          
          <?php } ?>
        <?php  if($params['group']->owner_guid == ossn_loggedin_user()->guid){ 
				 $ismember = 1;
		?>
          <a href="<?php echo ossn_group_url($params['group']->guid);?>edit" class='button-grey'><?php echo ossn_print('settings');?></a>
         <?php } ?>
       </div>       
       
    </div>
  </div>
<!-- End of Header -->
<div class="group-body">
   <?php if(isset($params['subpage']) && !empty($params['subpage']) && ossn_is_group_subapge($params['subpage'])){
			if(ossn_is_hook('group', 'subpage')){ 
           	   echo ossn_call_hook('group', 'subpage', $params); 
			 }
              }   else {	
?>
   <div class="group-wall">
       <?php
         if($ismember == 1){
		    echo ossn_view('components/OssnWall/wall/group', array('group' => $params));
		 }
		 if($params['group']->membership == OSSN_PRIVATE){
			 ?>

			<div class="group-closed-container">
               <div class="title-h3"><?php echo ossn_print('closed:group');?></div>
                 <p><?php echo ossn_print('close:group:notice');?></p>
                <div class="title-h3"> <?php echo ossn_print('group:members', array(count($members))); ?></div>
                <div class="group-members-small">
                
                   <?php
				  $members = $params['group']->getMembers();
                  $limit  = 30;
				  foreach($members as $member){
					  if($limit <= 30){
					  ?>
                    <img src="<?php echo ossn_site_url("avatar/{$member->username}/small");?>" title="<?php echo $member->fullname;?>"/>
                       <?php 
					  }
				  $limit++;
				  } ?>
                 
                </div>
                 <div class="title-h3"> <?php echo ossn_print('group:admin');?> </div>
                 <div class="group-members-small">
                  <?php
				  $group_admin = ossn_user_by_guid($params['group']->owner_guid); ?>
				 
                    <img src="<?php echo ossn_site_url("avatar/{$group_admin->username}/small");?>" title="<?php echo $group_admin ->fullname;?>"/>

                 </div>
            </div>
		 <?php 
		 }
		 ?>
   </div>

   <div class="group-sidebar">
      <div class="group-about">
        <div class='heading'> <?php echo ossn_print('about:group');?> </div>
        <div class="text"><?php echo $params['group']->description; ?></div>
        <div class="members-count"> <a> <?php echo ossn_print('total:members');?> (<?php echo count($members); ?>) </a></div>
     </div>
   <?php  if($params['group']->owner_guid == ossn_loggedin_user()->guid){ ?>
     <div class="group-about" style="margin-top: 10px;">
        <div class='heading'> <?php echo ossn_print('member:requests', array($params['group']->countRequests()));?></div>
        <div class="members-count"> <a href="<?php echo ossn_group_url($params['group']->guid);?>requests">
		<?php echo ossn_print('view:all');?></a></div>
     </div>
     <?php }
	    if(com_is_active('OssnAds')){	
		    echo ossn_view('components/OssnAds/page/view');
	     }
		?>
   </div>
     <?php } ?>
</div>

</div>