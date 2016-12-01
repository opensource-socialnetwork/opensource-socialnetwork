<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 ?>
<div class="panel-group" id="accordion">
   	<?php
	$themes = new OssnThemes;
	$list = $themes->getThemes();
	if($list){
		foreach ($list as $id) {
			$vars = array();
			$vars['OssnThemes'] = $themes;
			$vars['id'] = $id;
			$vars['theme'] = $themes->getTheme($id);;
			echo ossn_plugin_view("admin/themes/list/item", $vars);
		}
	}
	?>
</div> 