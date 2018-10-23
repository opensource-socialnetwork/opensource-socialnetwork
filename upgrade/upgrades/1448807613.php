<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

//regenerate .htaccess file
ossn_generate_server_config('apache');

//Update processed updates in database so user cannot upgrade again and again.

$release = str_replace('.php', '', $upgrade);
if(ossn_update_upgraded_files($upgrade) && ossn_update_db_version('3.9')) {
		ossn_trigger_message(ossn_print('upgrade:success', array(
				$release
		)), 'success');
} else {
		ossn_trigger_message(ossn_print('upgrade:failed', array(
				$release
		)), 'error');
}
