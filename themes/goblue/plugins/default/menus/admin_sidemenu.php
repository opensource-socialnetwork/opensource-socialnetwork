<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
foreach ($params['menu'] as $key => $value) {
        echo "<li class='nav-item dropdown'><a href='javascript:void(0);' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>" . ossn_print($key) . "</a>";
        echo '<ul class="dropdown-menu multi-level">';
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
