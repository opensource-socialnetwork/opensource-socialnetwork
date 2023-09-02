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

echo '<div><div class="layout-installation">';

echo '<div class="ossn-installation-message ossn-installation-success">' . ossn_installation_print('ossn:installed:message') . '</div><br />';
echo '<a href="' . ossn_installation_paths()->url . '?action=finish" class="button-blue primary">' . ossn_installation_print('ossn:install:finish') . '</a>';
echo '</div>';
