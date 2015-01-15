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
$OssnComs = new OssnComponents;
foreach ($OssnComs->getComponents() as $Com) {
    $Component = $OssnComs->getCom($Com);
    echo "<div class='ossn-components-item'>";
    echo "<div class='component-controls'>";
    if (!$OssnComs->isActive($Com)) {
        $enable = ossn_site_url("action/component/enable?com={$Com}", true);
        echo "<a href='{$enable}' class='components-button components-button-green'>" . ossn_print('admin:button:enable') ."</a>";
    } elseif (!in_array($Com, $OssnComs->requiredComponents())) {
        $disable = ossn_site_url("action/component/disable?com={$Com}", true);
        echo "<a href='{$disable}' class='components-button components-button-orange'>" . ossn_print('admin:button:disable') ."</a>";
    }
    if (in_array($Com, ossn_registered_com_panel())) {
        $configure = ossn_site_url("administrator/component/{$Com}", true);
        echo "<a href='{$configure}' class='components-button components-button-blue'>" . ossn_print('admin:button:configure') ."</a>";
    }
    if (!in_array($Com, $OssnComs->requiredComponents())) {
        $delete = ossn_site_url("action/component/delete?component={$Com}", true);
        echo "<a href='{$delete}' class='components-button components-button-red'>" . ossn_print('admin:button:delete') ."</a>";
    }
    echo "</div>";

    echo "<div class='component-name'>{$Component->com_name} {$Component->com_version}</div>";
    echo "<div class='compontnet-meta'>
	        " . ossn_print('admin:component:author') .": {$Component->com_author}<br />
			" . ossn_print('admin:component:website') .": {$Component->com_author_url}
	 </div>";
    echo "<div class='component-description'>{$Component->com_description}</div>";
    echo '</div>';
}
