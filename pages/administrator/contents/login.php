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

echo '<div class="ossn-admin-login">';
echo '<h3>'.ossn_print('administration').'</h3>';
echo  ossn_view_form('admin/login', array(
				'action' => ossn_site_url('action/admin/login'),
				'class' => 'ossn-admin-form ossn-login-form',
 ));
echo '</div>';
