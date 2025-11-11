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
class OssnSitePages extends OssnObject {
        /**
		 * Save site page
		 * 
		 * @param string $prefix page prefix
		 * @param string $desc Page contents
		 * @param string $language Lang code
		 *
		 * @return boolean
		 */
		public function savePage($prefix, $desc, $language) {
				//desc can be empty
				if(empty($prefix) || empty($language)) {
						return false;
				}
				//check if already exists
				if($page = $this->getPrefix($prefix, $language)) {
						//update
						$page->description = $desc;
						return $page->save();
				}
				$this->title             = '';
				$this->description       = $desc;
				$this->owner_guid        = 1;
				$this->type              = 'site';
				$this->subtype           = 'sitepage';
				$this->data->page_prefix = $prefix;
				$this->data->language    = $language;
				return $this->addObject();
		}
        /**
		 * get site page by prefix
		 * 
		 * @param string $prefix page prefix
		 * @param string $language Lang code
		 *
		 * @return boolean|object
		 */		
		public function getPrefix($prefix, $language) {
				if(empty($prefix) || empty($language)) {
						return false;
				}
				$page = $this->searchObject(array(
						'type'           => 'site',
						'subtype'        => 'sitepage',
						'entities_pairs' => array(
								array(
										'name'  => 'page_prefix',
										'value' => $prefix,
								),
								array(
										'name'  => 'language',
										'value' => $language,
								),
						),
				));
				if(isset($page)) {
						return $page[0];
				}
				return false;
		}
        /**
		 * Get all site pages
		 * 
		 * @param array $params Array option values
		 *
		 * @return boolean|object
		 */			
		public function getAll(array $params = array()) {
				$default = array(
						'type'    => 'site',
						'subtype' => 'sitepage',
				);
				$args = array_merge($default, $params);
				$list = $this->searchObject($args);

				return $list;
		}
} //class