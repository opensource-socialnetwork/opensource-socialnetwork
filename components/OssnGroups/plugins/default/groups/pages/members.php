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
$members = $params['group']->getMembers();
$count = $params['group']->getMembers(true);
$loggedin_moderator = false;
if(ossn_isLoggedin()){
	if($params['group']->isModerator(ossn_loggedin_user()->guid)){
		$loggedin_moderator = true;
	}
}
if ($members) {
    foreach ($members as $user) {
      ?>
	     <div class="ossn-group-members">
			<div class="row">
            		<div class="col-lg-2 col-sm-2 col-3">
    	        		<img src="<?php echo $user->iconURL()->large; ?>" class="user-icon-larger img-responsive"/>
					</div>
                   <div class="col-lg-10 col-sm-10 col-8">
    	    	        <div class="uinfo">
                          <?php
	    						echo ossn_plugin_view('output/url', array(
	    								'text' => $user->fullname,
	    								'href' =>  $user->profileURL(),
	    								'class' => 'userlink',
	    						));						
	    					?>
             	   		</div>
                    	 <div class="right request-controls">
				<?php
					if(ossn_isLoggedin()){
						if ((ossn_isAdminLoggedin() || $loggedin_moderator || ossn_loggedin_user()->guid == $params['group']->owner_guid) && $user->guid !== $params['group']->owner_guid && $params['group']->isMember($params['group']->guid, $user->guid)) {
	    								echo ossn_plugin_view('output/url', array(
	    									'text' => ossn_print('group:memb:remove'),
	    									'href' =>  ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),
		    								'class' => 'btn btn-warning btn-sm btn-responsive ossn-make-sure'
		    							));
										//don't let moderators to make themselve owner
										if(ossn_loggedin_user()->guid == $params['group']->owner_guid || ossn_isAdminLoggedin()){
							        		echo ossn_plugin_view('output/url', array(
						    					'data-new-owner' => $user->fullname,
						    					'data-is-admin' => ossn_isAdminLoggedin(),
							    				'text' => ossn_print('group:memb:make:owner'),
							    				'href' =>  ossn_site_url("action/group/change_owner?group={$params['group']->guid}&user={$user->guid}", true),
							    				'class' => 'btn btn-danger btn-sm btn-responsive ossn-group-change-owner'
							    			));
										}
		    						}
					}
				?>		
                    	</div>
            		</div>           
       			</div>
          </div>
    <?php
    }
	echo ossn_view_pagination($count);
}
