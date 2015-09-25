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
if (!empty($params['menu'])) {
    echo '<div class="drop-down-arrow ossn-comment-dropdown"></div>';
    echo '<div class="menu-links">';
    foreach ($params['menu'] as $menu) {
        foreach ($menu as $link) {
            $link = ossn_plugin_view('output/url', $link);
            echo "<li>{$link}</li>";
        }
    }
    echo '</div>';
}