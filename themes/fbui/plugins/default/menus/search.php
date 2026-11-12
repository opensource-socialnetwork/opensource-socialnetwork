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
$type = input('type');
if(empty($type)) {
	$type = 'users';	
}
$menus = $params['menu'];
echo "<div class='ossn-menu-search'>";
echo '<div class="title">' . ossn_print('result:type') . '</div>';
foreach ($menus as $menu => $val) {
    foreach ($val as $link) {
        $text = ossn_print($link['text']);
		$link = $link['href'];
		$class = OssnTranslit::urlize($menu);
		$active = '';
		if($class == $type){
			$active = ' ossn-search-active-item';	
		}
        echo "<li class='ossn-menu-search-{$class} {$active}'>
				<a href='{$link}'>
					<div class='text'>{$text}</div>
				</a>
			</li>";
    }
}
echo '</div>';
