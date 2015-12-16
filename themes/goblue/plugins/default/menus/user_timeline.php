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