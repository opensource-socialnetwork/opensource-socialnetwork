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
if(isset($params['items'])) {
		foreach($params['items'] as $fields) {
				if(isset($fields['text'])) {
						foreach($fields['text'] as $item) {
								if(!isset($item['params'])){
									$item['params'] = array();
								}
								$args                = array();
								$args['name']        = $item['name'];
								$args['value']		 = '';
								if(isset($item['value'])){
									$args['value']		 = $item['value'];
								}
								$args['placeholder'] = ossn_print("{$item['name']}");
								if(isset($item['class'])){
										$args['class']  = 'form-control '.$item['class'];	
								} else {
										$args['class']  = 'form-control ';											
								}	
								$vars                = array_merge($args, $item['params']);
								echo "<div class='text'>";
								//[E]make the label arg assigned to any label of user/field #1646
								if(isset($item['label']) && !is_bool($item['label'])){
									echo "<label>".$item['label']."</label>";
								} elseif((isset($item['label']) && $item['label'] === true) || (isset($params['label']) && $params['label'] === true)){
									echo "<label>".ossn_print("{$item['name']}")."</label>";
								}
								echo ossn_plugin_view('input/text', $vars);
								echo "</div>";
						}
				}
				if(isset($fields['textarea'])) {
						foreach($fields['textarea'] as $item) {
								if(!isset($item['params'])){
									$item['params'] = array();
								}
								$args                = array();
								$args['name']        = $item['name'];
								$args['value']		 = '';
								if(isset($item['value'])){
									$args['value']		 = $item['value'];
								}								
								$args['placeholder'] = ossn_print("{$item['name']}");
								if(isset($item['class'])){
										$args['class']  = 'form-control '.$item['class'];	
								} else {
										$args['class']  = 'form-control ';											
								}	
								$vars                = array_merge($args, $item['params']);
								echo "<div class='text'>";
								//[E]make the label arg assigned to any label of user/field #1646
								if(isset($item['label']) && !is_bool($item['label'])){
									echo "<label>".$item['label']."</label>";
								} elseif((isset($item['label']) && $item['label'] === true) || (isset($params['label']) && $params['label'] === true)){
									echo "<label>".ossn_print("{$item['name']}")."</label>";
								}
								echo ossn_plugin_view('input/textarea', $vars);
								echo "</div>";
						}
				}
				if(isset($fields['dropdown'])) {
						foreach($fields['dropdown'] as $item) {
								$vars         = array();
								$vars['name'] = $item['name'];
								$args         = array_merge($vars, $item);
								echo "<div class='dropdown-block'>";
								//[E]make the label arg assigned to any label of user/field #1646
								if(isset($item['label']) && !is_bool($item['label'])){
									echo "<label>".$item['label']."</label>";
								} elseif((isset($item['label']) && $item['label'] === true) || (isset($params['label']) && $params['label'] === true)){
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
								echo "<div class='radio-block-container'>";
								//[E]make the label arg assigned to any label of user/field #1646
								if(isset($item['label']) && !is_bool($item['label'])){
									echo "<label>".$item['label']."</label>";
								} elseif((isset($item['label']) && $item['label'] === true) || (isset($params['label']) && $params['label'] === true)){
									echo "<label>".ossn_print("{$item['name']}")."</label>";
								}
								echo ossn_plugin_view('input/radio', $args);
								echo "</div>";
						}
				}		
		}
}
