<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
class OssnGiphy {
		private $Endpoint = 'http://api.giphy.com/v1/gifs/';
		/**
		 * Client to connect to giphy API
		 *
		 * @param string $api    API endpoint (not a key)
		 * @param array  $args   Args for API endpoint
		 *
		 * @return boolean|array
		 */
		private function giphyClient($api, $args = array()){
				if(empty($api)){
						return false;
				}
				$key = ossn_giphy_api_key();
				if(!$key){
						return false;
				}
				$offset = input('offset_giphy', '', 0);
				if($offset > 0){
						$offset = $offset - 1; //giphy starts from 0;
				}
				$default = array(
						'api_key' => $key,
						'limit'   => 10,
						'offset'  => $offset * 10, //This is start position it should be like 10, 20, 30
				);
				$options  = array_merge($default, $args);
				$endpoint = $this->Endpoint . $api . '?' . http_build_query($options);
				$curl     = curl_init();
				curl_setopt($curl, CURLOPT_URL, $endpoint);
				curl_setopt($curl, CURLOPT_CAINFO, ossn_route()->www . 'vendors/cacert.pem');
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$result = curl_exec($curl);
				curl_close($curl);
				$data = json_decode($result, true);
				if($data){
						return $data;
				}
				return false;
		}
		/**
		 * Search a images
		 *
		 * @param string  $query Keyword for images
		 *
		 * @return boolean|array
		 */
		public function getSearch($query){
				if(empty($query)){
						return false;
				}
				return $this->giphyClient('search', array(
						'q' => $query,
				));
		}
		/**
		 * Get trending images
		 *
		 * @return boolean|array
		 */
		public function getTrending(){
				return $this->giphyClient('trending');
		}
		/**
		 * Get thumbs list
		 *
		 * @param $array $data API response from client
		 *
		 * @return boolean|array
		 */
		public function getThumbs($data){
				if(!empty($data['data'])){
						$results               = array();
						$results['pagination'] = $data['pagination'];
						$results['success']    = true;
						if(!empty($data['pagination']['total_count'])){
								if($data['pagination']['total_count'] > 10){
										$pagination = 50;
								} else {
										$pagination = $data['pagination']['count'];
								}
								$results['pagination_code'] = ossn_view_pagination($pagination, 10, array(
										'offset_name' => 'offset_giphy',
								));
						}
						foreach ($data['data'] as $item){
								preg_match('/(https?:\/\/media[0-9]\.giphy\.com\/media\/(.*)\/200w_d.webp)/', $item['images']['fixed_width_downsampled']['webp'], $matches);
								$results['images'][] = array(
										'id'    => $item['id'],
										'thumb' => $matches[0],
								);
						}
						return $results;
				}
				return false;
		}
		/**
		 * Set json response for internal use
		 *
		 * @param array $data List of array images
		 *
		 * @return void
		 */
		public function setResponse($data){
				header('Content-type:application/json;charset=utf-8');
				echo json_encode($data, JSON_PRETTY_PRINT);
				exit();
		}
}