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
class PostBackground {
		public function setBackground($params) {
				if(isset($params['object_guid']) && !empty($params['object_guid'])) {
						$object = ossn_get_object($params['object_guid']);
				} elseif(isset($params['object']) && $params['object'] instanceof OssnObject) {
						$object = $params['object'];
				}
				$postbg = input('postbackground_type');
				if($object && $postbg && (!isset($_FILES['ossn_photo']) || (isset($_FILES['ossn_photo']) && empty($_FILES['ossn_photo']['name'])) )) {
						if(!empty($postbg) && strlen($postbg) <= 125) {
								$this->saveSettings($object, $postbg);
						}
				}
		}
		private function saveSettings($object, $postbg) {
				if(!isset($object->guid) || empty($postbg)) {
						return false;
				}
				$json = html_entity_decode($object->description);
				$data = json_decode($json, true);
				
				$text = ossn_input_escape($data['post']);
				$text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
				$text = ossn_restore_new_lines($text);
				
				$data['post']        = htmlspecialchars($data['post'], ENT_QUOTES, 'UTF-8');
				$data['post']        = ossn_input_escape($data['post']);
				$object->description = json_encode($data, JSON_UNESCAPED_UNICODE);
				
				$object->data->postbackground_type = $postbg;
				$object->save();
		}
		public static function getById($id){
				if(__PostBackground_List__){
					foreach(__PostBackground_List__ as $item){
							if($item['name'] == $id){
								return $item;	
							}
					}
				}
				return false;
		}
}
