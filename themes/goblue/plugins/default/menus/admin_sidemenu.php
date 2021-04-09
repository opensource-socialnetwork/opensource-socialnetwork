<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
foreach ($params['menu'] as $key => $value) {
        echo "<li class='nav-item dropdown'><a href='javascript:void(0);' class='nav-link dropdown-toggle' data-bs-toggle='dropdown'>" . $key . "</a>";
        echo '<ul class="dropdown-menu multi-level">';
        foreach ($value as $link) {
			unset($link['parent']);
			unset($link['name']);
            $link['text'] = ossn_print($link['text']);
			$link['class'] = 'dropdown-item '.$link['class'];
			$link = ossn_plugin_view('output/url', $link);
            echo "<li>{$link}</li>";
        }
        echo '</ul></li>';
}
