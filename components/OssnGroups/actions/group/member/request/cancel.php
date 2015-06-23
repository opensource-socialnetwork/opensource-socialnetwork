<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$add = new OssnGroup;
$group = input('group');
$user = ossn_loggedin_user()->guid;
if ($add->deleteMember($user, $group)) {
    ossn_trigger_message(ossn_print('membership:cancel:succes'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('membership:cancel:fail'), 'error');
    redirect(REF);
}