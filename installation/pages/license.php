<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


echo '<div><div class="layout-installation"><h2>' . ossn_installation_print('ossn:check') . '</h2><div style="margin:0 auto; width:900px;"><div style="background: #f9f9f9; padding: 20px; border-radius: 3px; border: 2px dashed #eee;">';
echo nl2br(file_get_contents(dirname(dirname(dirname(__FILE__))) . '/LICENSE.md'));
echo '</div><br />';
echo '<a href="' . ossn_installation_paths()->url . '?page=settings" class="button-blue primary">'.ossn_installation_print('ossn:install:next').'</a>';
echo '</div><br /><br /></div>';
