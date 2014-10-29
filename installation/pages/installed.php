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

echo '<div><div class="layout-installation">';

echo '<div class="ossn-installation-message ossn-installation-success">' . ossn_installation_print('ossn:installed:message') . '</div><br />';
echo '<a href="' . ossn_installation_paths()->url . '?action=finish" class="button-blue primary">Finish</a>';
echo '</div>';
