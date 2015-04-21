<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
$friend = input('fid');
if (!empty($friend)) {
    ossn_chat()->markViewed($friend, ossn_loggedin_user()->guid);
}