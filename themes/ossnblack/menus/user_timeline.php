<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
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