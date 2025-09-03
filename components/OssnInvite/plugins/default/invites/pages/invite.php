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
?>
<div class="ossn-page-contents">
<?php
	$form = ossn_view_form('invite', array(
        'action' => ossn_site_url() . 'action/invite/friends',
        'component' => 'OssnInvite',
        'class' => 'ossn-edit-form',		
    ), false);
 	echo ossn_plugin_view('widget/view', array(
						'title' => ossn_print('com:ossn:invite:friends'),
						'contents' => $form,
	));
?>
</div>