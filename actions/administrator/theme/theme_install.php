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
$OssnTheme = new OssnThemes;
if ($OssnTheme->upload()) {
    ossn_trigger_message(ossn_print('theme:installed'));
    redirect(REF);
} else {
    ossn_trigger_message('theme:install:error', 'error');
    redirect(REF);
}
