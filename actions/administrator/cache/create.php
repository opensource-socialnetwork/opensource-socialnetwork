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
$type = input('cache');
if ($type == 1) {
    if (ossn_create_cache()) {
        ossn_trigger_message(ossn_print('cache:enabled'), 'success');
        redirect(REF);
    }
} elseif ($type == 0) {
    if (ossn_disable_cache()) {
        ossn_trigger_message(ossn_print('cache:disabled'), 'success');
        redirect(REF);
    }
}