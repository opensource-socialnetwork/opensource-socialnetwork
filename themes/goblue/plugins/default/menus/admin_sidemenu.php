<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
foreach ($params['menu'] as $key => $value) {
		$urlize_key = str_replace('admin:sidemenu', '', $key);
		$urlize_key = str_replace(':', '-', $urlize_key);
		$menu_class = "admin-topbar-smenu-".OssnTranslit::urlize($urlize_key);
        echo "<li class='nav-item dropdown {$menu_class}'><a href='javascript:void(0);' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>" . ossn_print($key) . "</a>";
        echo '<ul class="dropdown-menu">';
        foreach ($value as $link) {
			unset($link['parent']);
			unset($link['name']);
			if(!isset($link['class'])){
				$link['class'] = '';
			}
			$link['class'] = 'dropdown-item '.$link['class'];
			$link = ossn_plugin_view('output/url', $link);
            echo "<li>{$link}</li>";
        }
        echo '</ul></li>';
}
