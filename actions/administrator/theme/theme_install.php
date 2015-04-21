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
$OssnTheme = new OssnThemes;
if ($OssnTheme->upload()) {
    ossn_trigger_message(ossn_print('theme:installed'));
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('theme:install:error'), 'error');
    redirect(REF);
}
