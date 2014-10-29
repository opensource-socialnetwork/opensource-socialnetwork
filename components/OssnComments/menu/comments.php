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
if (!empty($params['menu'])) {
    echo '<div class="drop-down-arrow ossn-comment-dropdown"></div>';
    echo '<div class="menu-links">';
    foreach ($params['menu'] as $menu) {
        foreach ($menu as $text => $link) {
            $link = ossn_args($link);
            echo "<li> <a {$link}>{$text}</a></li>";
        }
    }
    echo '</div>';
}