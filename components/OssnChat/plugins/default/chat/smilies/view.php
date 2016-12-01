<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
foreach (OssnChat::loadIcons() as $val => $Icon) {
    echo '<div class="ossn-chat-inline-table ossn-chat-item-smiles" title="' . $val . '" onClick=\'Ossn.ChatInsertSmile("' . $val . '",' . $params['tab'] . ');\'>' . $Icon . '</div>';
}