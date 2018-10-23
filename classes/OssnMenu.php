<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnMenu {
		/**
		 * Initialize the OssnMenu
		 *
		 * @return void
		 */
		public function __construct($type = '', $options = '') {
				$this->menutype = $type;
				$this->options  = $options;
		}
		/**
		 * Register menu item
		 *
		 * @return void
		 */
		public function register() {
				global $Ossn;
				$menutype = $this->menutype;
				$options  = $this->options;
				if(!empty($options['name'])) {
						$name = $options['name'];
						if(isset($options['parent']) && !empty($options['parent'])) {
								$name = $options['parent'];
						}
						
						$maxpriority = $this->maxPriority($menutype);
						$priorities  = $this->priorities($menutype);
						
						$priority = 100;
						while(in_array($priority, $priorities)) {
								$priority++;
						}
						if(!isset($options['priority'])) {
								$options['priority'] = $priority;
						}
						$Ossn->menu[$menutype][$name][] = $options;
				}
		}
		/**
		 * Get the menu item priorities
		 *
		 * @param string $menutype A key of menu
		 * 
		 * @return array
		 */
		public function priorities($menutype) {
				global $Ossn;
				if(isset($Ossn->menu[$menutype])) {
						$list = array();
						foreach($Ossn->menu[$menutype] as $items) {
								foreach($items as $item) {
										$list[] = $item['priority'];
								}
						}
						return array_unique($list);
				}
				return array();
		}
		/**
		 * Get the menu max priority
		 *
		 * @param string $menutype A key of menu
		 * 
		 * @return array
		 */
		public function maxPriority($menutype) {
				global $Ossn;
				if(isset($Ossn->menu[$menutype])) {
						$list = array();
						foreach($Ossn->menu[$menutype] as $items) {
								foreach($items as $item) {
										if(isset($item['priority'])) {
												$list[] = $item['priority'];
										}
								}
						}
						if(!empty($list)){
							return max($list);
						}
				}
				return false;
		}
		/**
		 * Sort menu with priority
		 *
		 * @param string $menutype A key of menu
		 * 
		 * @return void
		 */
		public function sortMenu($menutype) {
				global $Ossn;
				if(empty($menutype)) {
						return false;
				}
				foreach($Ossn->menu[$menutype] as $name => $items) {
						foreach($items as $item) {
								$custom[$menutype][$item['priority']][$name] = $item;
						}
				}
				//still warnings from OssnMenue when displaying newsthread #683
				if(empty($custom[$menutype]) || !is_array($custom[$menutype])){
					return false;
				}
				ksort($custom[$menutype]);
				unset($Ossn->menu[$menutype]);
				foreach($custom[$menutype] as $nitems) {
						foreach($nitems as $nname => $nitem) {
								if(isset($nitem['priority'])){
									unset($nitem['priority']);
								}
								$Ossn->menu[$menutype][$nname][] = $nitem;
						}
				}
		}
} //class
