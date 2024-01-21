<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$users = $params['users'];
if ($users) {
    foreach ($users as $user) {
      ?>
		<div class="row ossn-users-list-item">
            	<div class="col-lg-2 col-sm-2 d-none d-sm-block">
    	        		<img src="<?php echo $user->iconURL()->large; ?>" width="100" height="100"/>
				</div>
                <div class="col-lg-10 col-sm-10 col-12">
	    	        <div class="uinfo">
                        <?php
							echo ossn_plugin_view('output/user/url', array(
									'user' => $user,			
									'class' => 'userlink',
									'section' => 'output/users',
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
													'class' => 'btn btn-danger btn-sm',
												));
										} else {
												echo ossn_plugin_view('output/url', array(
													'text' => ossn_print('add:friend'),
													'href' =>  ossn_site_url("action/friend/add?user={$user->guid}", true),
													'class' => 'btn btn-primary btn-sm',
												));		
										}
								} else {
									echo ossn_plugin_view('output/url', array(
													'text' => ossn_print('remove:friend'),
													'href' =>  ossn_site_url("action/friend/remove?user={$user->guid}", true),
													'class' => 'btn btn-danger btn-sm',
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
