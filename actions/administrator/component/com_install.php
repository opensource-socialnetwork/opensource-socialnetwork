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

$OssnCom = new OssnComponents;
if ($OssnCom->upload()) {
    ossn_trigger_message(ossn_print('com:installed'), 'success');
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('com:install:error'), 'error');
    redirect(REF);
}