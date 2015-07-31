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
?>
<div class="panel-group" id="accordion">
   	<?php
	$OssnComs = new OssnComponents;
	$list = $OssnComs->getComponents();
	if($list){
		foreach($list as $component) {
			$vars = array();
			$vars['OssnCom'] = $OssnComs;
			$vars['component'] = $OssnComs->getCom($component);
			$vars['name'] = $component;
			echo ossn_plugin_view("admin/components/list/item", $vars);
		}
	}
	?>
</div> 