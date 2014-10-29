<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
foreach (OssnChat::loadIcons() as $val => $Icon) {
    echo '<div class="ossn-chat-inline-table ossn-chat-item-smiles" title="' . $val . '" onClick=\'Ossn.ChatInsertSmile("' . $val . '",' . $params['tab'] . ');\'>' . $Icon . '</div>';
}