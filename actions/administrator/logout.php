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

$loggedout = input('l');
if (empty($loggedout)) {
    session_destroy();
    redirect(ossn_build_token_url('action/admin/logout?l=1'));
}
if ($loggedout == 1) {
    ossn_trigger_message(ossn_print('logged:out'), 'success');
    redirect('administrator');
}