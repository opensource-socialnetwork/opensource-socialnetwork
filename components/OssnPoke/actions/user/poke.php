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
$poke = new OssnPoke;
$user = input('user');
if ($poke->addPoke(ossn_loggedin_user()->guid, $user)) {
    $user = ossn_user_by_guid($user);
    ossn_trigger_message(ossn_print('user:poked', array($user->fullname)), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('user:poke:error'), 'error');
    redirect(REF);
}