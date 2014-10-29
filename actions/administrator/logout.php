<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */

$loggedout = input('l');
if (empty($loggedout)) {
    session_destroy();
    redirect('action/admin/logout?l=1');
}
if ($loggedout == 1) {
    ossn_trigger_message(ossn_print('logged:out'), 'success', 'admin');
    redirect('administrator');
}