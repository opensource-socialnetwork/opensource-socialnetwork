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
echo '<ul>';
$i = 0;
foreach($params['menu'] as $menu) {
		if($i <= 10) {
				foreach($menu as $name => $link) {
						$class = "menu-user-timeline-" . $link['name'];
						if(isset($link['class'])) {
								$link['class'] = $class . ' ' . $link['class'];
						} else {
								$link['class'] = $class;
						}
						unset($link['name']);
						$link['text'] = ossn_print($link['text']);
						$link         = ossn_plugin_view('output/url', $link);
						echo "<li>{$link}</li>";
				}
		} else {
				echo "<li class='dropdown'><a href='javascript:void(0);' data-toggle='dropdown' class='dropdown-toggle'>" . ossn_print('more') . "<i class='fa fa-caret-down'></i></a>
		  <ul class='dropdown-menu'>";
				foreach($menu as $name => $link) {
						$class = "menu-user-timeline-" . $link['name'];
						if(isset($link['class'])) {
								$link['class'] = $class . ' ' . $link['class'];
						} else {
								$link['class'] = $class;
						}
						unset($link['name']);
						$link['text'] = ossn_print($link['text']);
						$link         = ossn_plugin_view('output/url', $link);
						echo "<li>{$link}</li>";
				}
				echo "</ul>
		 </li>";
		}
		$i++;
}
echo '</ul>';