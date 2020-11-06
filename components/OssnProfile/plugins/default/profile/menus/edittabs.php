<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$selected = input('section', '', 'basic');
foreach($params['menu'] as $item){
		foreach($item as $key => $args){
				$active = '';
				if($selected == $args['name']){
						$active = ' profile-edit-tab-item-active';	
				}
				//issue with account setting profile tabs #1812
				$class = "profile-edit-tab-item profile-edit-tab-item-{$args['name']}";
				if(isset($params['class'])){
					$class = $class .' '. $params['class'];
				}
				$defaults = array(
						'class' => $class . $active,
			    );
				$args = array_merge($defaults, $args);
				echo ossn_plugin_view('output/url', $args);
		}
}
