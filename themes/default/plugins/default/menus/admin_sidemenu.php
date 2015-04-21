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
echo '<div class="ossn-admin-sidemenu">';
foreach ($params['menu'] as $value) {
    foreach ($value as $key => $value) {
        echo "<div class='title'>" . strtoupper($key) . "</div>";
        echo "<div class='links'>";
        foreach ($value as $name => $link) {
            $name_link = ossn_print($name);
            $icon = str_replace(':', '-', $name);
            $active_theme = ossn_site_settings('theme');
            $icon = ossn_site_url("themes/{$active_theme}/images/administrator/icons/{$icon}.png");
            $icon = "<div class='icon' style='background:url(\"{$icon}\") no-repeat;'></div>";
            echo "<a href='{$link}'><li><div class='inner-li'>{$icon}<div class='text'>{$name_link}</div></div></li></a>";
        }
        echo '</div>';
    }
}
echo '</div>';