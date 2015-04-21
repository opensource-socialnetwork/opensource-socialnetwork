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

echo '<div><div class="layout-installation">';

echo '<div class="ossn-installation-message ossn-installation-success">' . ossn_installation_print('ossn:installed:message') . '</div><br />';
echo '<a href="' . ossn_installation_paths()->url . '?action=finish" class="button-blue primary">' . ossn_installation_print('ossn:install:finish') . '</a>';
echo '</div>';
