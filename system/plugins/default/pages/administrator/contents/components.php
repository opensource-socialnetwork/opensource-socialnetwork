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
?>
<div class="panel-group ossn-admin-components-list" id="accordion">
   	<?php
	$OssnComs = new OssnComponents;
	$list = $OssnComs->getComponents();
	if($list){
		foreach($list as $component) {
			$vars = array();
			$vars['OssnCom'] = $OssnComs;
			$vars['component'] = $OssnComs->getCom($component);
			$vars['name'] = $component;
			//[E] Add ids in components and themes lists item so can be utilized later #2313
			echo "<div class='ossn-admin-component-list-item' data-com-id='{$component}' data-com-version='{$vars['component']->version}'>";
			echo ossn_plugin_view("admin/components/list/item", $vars);
			echo "</div>";
		}
	}
	?>
</div> 
