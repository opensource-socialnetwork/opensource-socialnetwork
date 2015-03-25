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
class OssnPagination {
    /**
     * Construct a pagination class;
     *
     * @return void;
     */
    public function __construct($ppage = 10) {
        $this->ppage = (int)$ppage;
    }

    /**
     * Get current url with arguments;
     *
     * @return string;
     */
 public static function constructUrlArgs($kill = array()) {
		
        unset($_GET['h']);
        unset($_GET['p']);
        unset($_GET['offset']);
		
		//kill someof variables
		if(!empty($kill)){
			foreach($kill as $type){
				if(isset($_GET[$type])){
					unset($_GET[$type]);
				}
			}
		}
		
        if (count($_GET)) {
            $args_url = '';
            foreach ($_GET as $key => $value) {
                if ($key != 'page') {
                    $args_url .= '&' . $key . '=' . $value;
                }
            }
            return $args_url;
        }
    }

    /**
     * Set arrays or objects to pagination;
     *
     * @params = $item => array, object
     *
     * @return bool;
     */
    public function setItem($item) {
        if (is_object($item)) {
            $this->item_class = get_class($item);
            $item = get_object_vars($item);
        }
        if (is_array($item) && !empty($item)) {
            $this->setItem = $item;
        }
    }

    /**
     * Get spilted array or object;
     *
     * @note =  (object may changed to arrays)
     *
     * @return bool;
     */
    public function getItem() {
        $item = $this->getItems();
        if (empty($item)) {
            $item = array();
        }
        $offset = (int)input('offset');
        if (empty($offset)) {
            $offset = 1;
        }
        if (array_key_exists($offset, $item)) {
            if (!empty($this->item_class)) {
                return arrayObject($item[$offset], $this->item_class);
            }
            return $item[$offset];
        }
        return false;
    }

    /**
     * Spilt a arrays or objects into pagination;
     *
     * @return bool;
     */
    private function getItems() {
        if (!isset($this->setItem)) {
            return false;
        }
        $item = $this->setItem;
        if (is_array($item)) {
            $newitem = array_chunk($item, $this->ppage);
            return arraySerialize($newitem);
        }
    }

    /**
     * Output pagination bar;
     *
     * @return html;
     */
    public function pagination() {
        if (!isset($this->setItem)) {
            return false;
        }
        $item = $this->setItem;
        if (is_array($item)) {
            $newitem = array_chunk($item, $this->ppage);
            $newitem_total = count($newitem);
            $pages = arraySerialize($newitem);

            $offset = (int)input('offset');
            if (!array_key_exists($offset, $pages)) {
                $view = 1;
            } elseif (array_key_exists($offset, $pages)) {
                $view = $offset;
            }
            $params['offset'] = $view;
            $params['total'] = $newitem_total;
            return $this->view($params);
        }

    }

    /**
     * Call a structure of pagination;
     *
     * @params = array(count, active)
     *
     * @return html;
     */
    private function view($params) {
        $theme = ossn_site_settings('theme');
        return ossn_view("themes/{$theme}/pagination/view", $params);
    }


}//CLASS
