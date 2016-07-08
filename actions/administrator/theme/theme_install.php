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
$OssnTheme = new OssnThemes;
if ($OssnTheme->upload()) {
    ossn_trigger_message(ossn_print('theme:installed'));
    redirect(REF);
} else {
    ossn_trigger_message(ossn_print('theme:install:error'), 'error');
    redirect(REF);
}
