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
$postextra = $params['menu'];
if($postextra && ossn_isLoggedin()) {
		if(!empty($postextra)) {
				foreach($postextra as $menu) {
						foreach($menu as $link) {
								$class = "post-control-" . $link['name'];
								if(isset($link['class'])) {
										$link['class'] = $class . ' ' . $link['class'];
								} else {
										$link['class'] = $class;
								}
								unset($link['name']);
								$link = ossn_plugin_view('output/url', $link);
								echo "<li>".$link."</li>";
						}
				}
		}
}
