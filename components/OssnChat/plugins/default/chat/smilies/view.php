<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
foreach (OssnChat::loadIcons() as $val => $Icon) {
    echo '<div class="ossn-chat-inline-table ossn-chat-item-smiles" title="' . $val . '" onClick=\'Ossn.ChatInsertSmile("' . $val . '",' . $params['tab'] . ');\'>' . $Icon . '</div>';
}