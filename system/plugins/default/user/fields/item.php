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
if(isset($params['items'])) {
		foreach($params['items'] as $fields) {
				if(isset($fields['text'])) {
						foreach($fields['text'] as $item) {
								if(!isset($item['params'])){
									$item['params'] = array();
								}
								$args                = array();
								$args['name']        = $item['name'];
								$args['value']		 = $item['value'];
								$args['placeholder'] = ossn_print("{$item['name']}");
								$vars                = array_merge($args, $item['params']);
								echo "<div class='text'>";
								if($params['label'] === true){
									echo "<label>".ossn_print("{$item['name']}")."</label>";
								}
								echo ossn_plugin_view('input/text', $vars);
								echo "</div>";
						}
				}
				if(isset($fields['dropdown'])) {
						foreach($fields['dropdown'] as $item) {
								$vars         = array();
								$vars['name'] = $item['name'];
								$args         = array_merge($vars, $item);
								echo "<div class='dropdown-block'>";
								if($params['label'] === true){
									echo "<label>".ossn_print("{$item['name']}")."</label>";
								}								
								echo ossn_plugin_view('input/dropdown', $args);
								echo "</div>";
						}
				}						
				if(isset($fields['radio'])) {
						foreach($fields['radio'] as $item) {
								$vars         = array();
								$vars['name'] = $item['name'];
								$args         = array_merge($vars, $item);
								echo "<div class='radio-block'>";
								if($params['label'] === true){
									echo "<label>".ossn_print("{$item['name']}")."</label>";
								}								
								echo ossn_plugin_view('input/radio', $args);
								echo "</div>";
						}
				}		
		}
}