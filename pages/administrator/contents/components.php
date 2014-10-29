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
        $enable = ossn_site_url("action/component/enable?com={$Com}");
        echo "<a href='{$enable}' class='components-button components-button-green'>Enable</a>";
    } elseif (!in_array($Com, $OssnComs->requiredComponents())) {
        $disable = ossn_site_url("action/component/disable?com={$Com}");
        echo "<a href='{$disable}' class='components-button components-button-orange'>Disable</a>";
    }
    if (in_array($Com, ossn_registered_com_panel())) {
        $configure = ossn_site_url("administrator/component/{$Com}");
        echo "<a href='{$configure}' class='components-button components-button-blue'>Configure</a>";
    }
    if (!in_array($Com, $OssnComs->requiredComponents())) {
        $delete = ossn_site_url("action/component/delete?component={$Com}");
        echo "<a href='{$delete}' class='components-button components-button-red'>Delete</a>";
    }
    echo "</div>";

    echo "<div class='component-name'>{$Component->com_name} {$Component->com_version}</div>";
    echo "<div class='compontnet-meta'>
	        Author: {$Component->com_author}<br />
			Website: {$Component->com_author_url}
	 </div>";
    echo "<div class='component-description'>{$Component->com_description}</div>";
    echo '</div>';
}