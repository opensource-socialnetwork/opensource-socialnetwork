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
foreach ($params['menu'] as $value) {
    foreach ($value as $key => $value) {
        echo "<li><a href='javascript::void(0);' class='dropdown-toggle' data-toggle='dropdown'>" . strtoupper($key) . "<i class='fa fa-sort-desc'></i></a>";
        echo '<ul class="dropdown-menu multi-level">';
        foreach ($value as $name => $link) {
            $name_link = ossn_print($name);
            $icon = str_replace(':', '-', $name);
            echo "<li><a href='{$link}'>{$name_link}</a></li>";
        }
        echo '</ul></li>';
    }
}
