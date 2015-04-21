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
$menus = $params['menu'];
echo "<div class='ossn-menu-newsfeed'>";
foreach ($menus as $key => $menu) {
    $section = ossn_print($key);
    echo "<div class='ossn-menu-section-name'>{$section}</div>";
    foreach ($menu as $text => $data) {
        $menu = str_replace(':', '-', $text);
        $icon = $data[1];
        if (!is_array($data[2])) {
            $data[2] = array();
        }
        $args = ossn_args($data[2]);
        echo "<li><a {$args} href='{$data[0]}'>
		<img src='{$icon}' /> 
		<div class='text'>{$text}</div>
		</a>
		</li>";
    }
}
echo '</div>';