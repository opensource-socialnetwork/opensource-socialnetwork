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
echo '<div class="ossn-admin-menu-topbar">';
echo '<ul>';
foreach ($params['menu'] as $key => $links) {
    if (count($links) > 1) {
        $menu_parent = '<a href="#"><li>' . ossn_print($key) . '</a><ul>';
        unset($links['Configure']);
        foreach ($links as $text => $link) {
            $menu_parent .= '<a href="' . $link . '"><li>' . ossn_print($text) . '</li></a>';
        }
        $menu_parent .= '</ul></li>';
        echo $menu_parent;
    } else {

        foreach ($links as $text => $link) {
            $menu = '<a href="' . $link . '"><li>' . ossn_print($text) . '</li></a>';
        }
        echo $menu;
    }
}

echo '<a href="' . ossn_site_url("action/admin/logout", true) . '"><li class="right">' . ossn_print('admin:logout') . '</li></a>';
echo '</ul>';
echo '</div>';
