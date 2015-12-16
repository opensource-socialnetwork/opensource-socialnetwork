<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$users = $params['users'];
if ($users) {
    foreach ($users as $user) {
      ?>
		<div class="row ossn-users-list-item">
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
                    <div class="right users-list-controls">
	                    <?php
						if (ossn_isLoggedIn()) {
							if (ossn_loggedin_user()->guid !== $user->guid) {
                    			if (!ossn_user_is_friend(ossn_loggedin_user()->guid, $user->guid)) {
                        				if (ossn_user()->requestExists(ossn_loggedin_user()->guid, $user->guid)) {
												echo ossn_plugin_view('output/url', array(
													'text' => ossn_print('cancel:request'),
													'href' =>  ossn_site_url("action/friend/remove?cancel=true&user={$user->guid}", true),
													'class' => 'btn btn-danger',
												));
										} else {
												echo ossn_plugin_view('output/url', array(
													'text' => ossn_print('add:friend'),
													'href' =>  ossn_site_url("action/friend/add?user={$user->guid}", true),
													'class' => 'btn btn-primary',
												));		
										}
								} else {
									echo ossn_plugin_view('output/url', array(
													'text' => ossn_print('remove:friend'),
													'href' =>  ossn_site_url("action/friend/remove?user={$user->guid}", true),
													'class' => 'btn btn-danger',
									));	
				
								}
							}
						}
						?>		
                   </div>
               </div>         
        </div>
    <?php
    }

}?>
