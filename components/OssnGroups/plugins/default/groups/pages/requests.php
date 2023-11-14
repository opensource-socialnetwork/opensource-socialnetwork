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
$requests = $params['group']->getMembersRequests();
if (empty($requests)) {
    echo '<div class="ossn-group-no-requests">' . ossn_print('no:requests') . '</div>';
} else {
    foreach ($requests as $user) {
        ?>
	      <div class="ossn-group-members">
			<div class="row">
            	<div class="col-lg-2 col-sm-2 col-12">
    	        		<img src="<?php echo $user->iconURL()->large; ?>" class="user-icon-large img-responsive"/>
				</div>
                <div class="col-lg-10 col-sm-10 col-12">
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
							echo ossn_plugin_view('output/url', array(
									'text' => ossn_print('approve'),
									'href' =>  ossn_site_url("action/group/member/approve?group={$params['group']->guid}&user={$user->guid}", true),
									'class' => 'btn btn-primary btn-sm',
							));
							echo ossn_plugin_view('output/url', array(
									'text' => ossn_print('decline'),
									'href' =>  ossn_site_url("action/group/member/decline?group={$params['group']->guid}&user={$user->guid}", true),
									'class' => 'btn btn-danger btn-sm',
							));
						?>		
                   </div>
                </div>
            </div>
        </div>

    <?php
    }
}
