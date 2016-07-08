<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2016 SOFTLAB24 LIMITED
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 
 echo "<div class='user-fullname ossn-profile-role'>";
 if($params['user']->isAdmin()){
	echo "<i class='fa fa-star'></i>".ossn_print('admin'); 
 }
 echo "</div>";