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
$members = $params['group']->getMembers();
if ($members) {
    foreach ($members as $user) {
      ?>
		<div class="row">
	        <div class="ossn-group-members">
            	<div class="col-md-2 col-sm-2 hidden-xs">
    	        		<img src="<?php echo $user->iconURL()->large; ?>" width="100" height="100"/>
				</div>
                <div class="col-md-10 col-sm-10 col-xs-12">
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
							if ($user->guid !== $params['group']->owner_guid && $params['group']->isMember($params['group']->guid, $user->guid)) {
									echo ossn_plugin_view('output/url', array(
										'text' => ossn_print('group:memb:remove'),
										'href' =>  ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),
										'class' => 'btn btn-danger',
								));
							}
						?>		
                   </div> 
               </div>
            </div>           
        </div>
    <?php
    }

}?>
