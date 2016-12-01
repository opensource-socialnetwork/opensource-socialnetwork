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
$entityextra = $params['menu'];
if($entityextra && ossn_isLoggedin()) {
		if(!empty($entityextra)) {
				foreach($entityextra as $menu) {
						foreach($menu as $link) {
								$class = "entity-menu-extra-" . $link['name'];
								if(isset($link['class'])) {
										$link['class'] = $class . ' ' . $link['class'];
								} else {
										$link['class'] = $class;
								}
								unset($link['name']);
								$link = ossn_plugin_view('output/url', $link);
								echo "<li>$link</li>";
						}
				}
		}
}
