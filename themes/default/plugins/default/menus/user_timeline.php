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
foreach ($params['menu'] as $menu) {
    if ($i <= 3) {
        foreach ($menu as $name => $link) {
            echo "<li><a href='{$link}'><span>" . ossn_print($name) . "</span></a></li>";
        }
    } else {
        echo "<li><a href='{$links}'>" . ossn_print('more') . "</a>
		  <ul>";
        foreach ($menu as $name => $link) {
            echo "<li><a href='{$link}'><span>" . ossn_print($name) . "</span></a></li>";
        }
        echo "</ul>
		 </li>";
    }
    $i++;
}
echo '</ul>';