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
class OssnPagination {
		/**
		 * Construct a pagination class;
		 *
		 * @return void
		 */
		public function __construct($ppage = 10, array $options = array()) {
				if(is_integer($ppage)) {
						$this->ppage = (int) $ppage;
				}
				$this->options = $options;
		}
		
		/**
		 * Get current url with arguments;
		 *
		 * @return string
		 */
		public static function constructUrlArgs($kill = array()) {
				//kill someof variables
				$default = array(
						'h',
						'p',
						'offset'
				);
				$unset   = array_merge($default, $kill);
				if(count($_GET)) {
						$args_url = '';
						foreach($_GET as $key => $value) {
								if(!ctype_alnum($value) || in_array($key, $unset)) {
										continue;
								}
								//validate input again
								$value = input($key);
								if($key != 'page') {
										$value = input($key);
										$args_url .= '&' . $key . '=' . $value;
								}
						}
						return $args_url;
				}
		}
		
		/**
		 * Set arrays or objects to pagination;
		 *
		 * @params array|object $item Item
		 *
		 * @return void
		 */
		public function setItem($item) {
				if(is_object($item)) {
						$this->item_class = get_class($item);
						$item             = get_object_vars($item);
				}
				if(is_array($item) && !empty($item)) {
						$this->setItem = $item;
				}
		}
		
		/**
		 * Get spilted array or object;
		 *
		 * object may changed to arrays
		 *
		 * @return boolean
		 */
		public function getItem() {
				$item = $this->getItems();
				if(empty($item)) {
						$item = array();
				}
				$offset = (int) input('offset');
				if(empty($offset)) {
						$offset = 1;
				}
				if(array_key_exists($offset, $item)) {
						if(!empty($this->item_class)) {
								return arrayObject($item[$offset], $this->item_class);
						}
						return $item[$offset];
				}
				return false;
		}
		
		/**
		 * Spilt a arrays or objects into pagination
		 *
		 * @return boolean
		 */
		private function getItems() {
				if(!isset($this->setItem)) {
						return false;
				}
				$item = $this->setItem;
				if(is_array($item)) {
						$newitem = array_chunk($item, $this->ppage);
						return arraySerialize($newitem);
				}
		}
		
		/**
		 * Output pagination bar
		 *
		 * @return false|string
		 */
		public function pagination($vars = array()) {
				if(!isset($this->setItem) && !isset($vars)) {
						return false;
				}
				if(!empty($vars)) {
						$vars['offset'] = (int) input('offset');
						$vars['total']  = abs($vars['limit'] / $vars['page_limit']);
						$vars['total']  = (int) ceil($vars['total']);
						return $this->view($vars);
				}
				$item = $this->setItem;
				if(is_array($item)) {
						$newitem       = array_chunk($item, $this->ppage);
						$newitem_total = count($newitem);
						$pages         = arraySerialize($newitem);
						
						$offset = (int) input('offset');
						if(!array_key_exists($offset, $pages)) {
								$view = 1;
						} elseif(array_key_exists($offset, $pages)) {
								$view = $offset;
						}
						$params['offset'] = $view;
						$params['total']  = $newitem_total;
						return $this->view($params);
				}
				
		}
		
		/**
		 * Call a structure of pagination;
		 *
		 * @param array $params array(count, active)
		 *
		 * @return string
		 */
		private function view($params) {
				$theme = ossn_site_settings('theme');
				return ossn_view("themes/{$theme}/pagination/view", $params);
		}
		
} //CLASS
