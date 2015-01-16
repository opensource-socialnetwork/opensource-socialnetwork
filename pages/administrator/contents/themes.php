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
$OssnThemes = new OssnThemes;
foreach ($OssnThemes->getThemes() as $id) {
    $Theme = $OssnThemes->getTheme($id);
    echo "<div class='ossn-components-item'>";
    echo "<div class='component-controls'>";
    if (ossn_site_settings('theme') == $id) {
        echo "<a href='#' class='components-button components-button-blue'>" . ossn_print('admin:button:enabled') . "</a>";
    } else {
        $enable = ossn_site_url("action/theme/enable?theme={$id}", true);
        echo "<a href='{$enable}' class='components-button components-button-green'>" . ossn_print('admin:button:enable') . "</a>";
    }
    if ($OssnThemes->getActive() !== $id) {
        $delete = ossn_site_url("action/theme/delete?theme={$id}", true);
        echo "<a href='{$delete}' class='components-button components-button-red'>" . ossn_print('admin:button:delete') . "</a>";
    }
    echo "</div>";

    echo "<div class='component-name'>{$Theme->theme_name} {$Theme->theme_version}</div>";
    echo "<div class='compontnet-meta'>
	        	" . ossn_print('admin:component:author') . ": {$Theme->theme_author}<br />
				" . ossn_print('admin:component:website') . ": {$Theme->theme_author_url}
	 </div>";
    echo "<div class='component-description'>{$Theme->theme_description}</div>";
    echo '</div>';
}
