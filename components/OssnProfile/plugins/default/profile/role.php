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
 
 echo "<div class='user-fullname ossn-profile-role'>";
 if($params['user']->isAdmin()){
	echo "<i class='fa fa-star'></i>".ossn_print('admin'); 
 }
 echo "</div>";