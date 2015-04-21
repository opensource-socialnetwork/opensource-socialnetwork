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
/**
 * Generate token using timestamp
 * 
 * @param array $timestamp current timestamp
 * @return string
 */ 
function ossn_generate_action_token($timestamp){
	if(!isset($timestamp) && empty($timestamp)){
		$timestamp = time();
	}
	$site_screat = ossn_site_settings('site_key');
	$session_id = session_id();
	return md5($timestamp . $site_screat . $session_id);
}
/**
 * Build url from parts
 * 
 * @param array $parts	Url parts
 * @return string
 */
function ossn_build_token_url($parts){
	$scheme = isset($parts['scheme']) ? "{$parts['scheme']}://" : '';
	$host = isset($parts['host']) ? "{$parts['host']}" : '';
	$port = isset($parts['port']) ? ":{$parts['port']}" : '';
	$path = isset($parts['path']) ? "{$parts['path']}" : '';
	$query = isset($parts['query']) ? "?{$parts['query']}" : '';
   
	$string = $scheme . $host . $port . $path . $query;
	return $string;
}
/**
 * Add action tokens to url
 * 
 * @param string $url	Full complete url
 * 
 * @return string
 */
function ossn_add_tokens_to_url($url){
	$params = parse_url($url);
	
	$query = array();
	if(isset($params['query'])){
		parse_str($params['query'],  $query);
	}
	$tokens['ossn_ts'] = time();
	$tokens['ossn_token'] = ossn_generate_action_token($tokens['ossn_ts']);
	$tokens = array_merge($query, $tokens);
	
	$query = http_build_query($tokens);
	
	$params['query'] = $query;
	return  ossn_build_token_url($params);	
}
/**
 * Validate given tokens
 *
 * @return (bool)
 */
function ossn_validate_actions(){
	$ossnts = input('ossn_ts');
	$ossntoken = input('ossn_token');
	if(empty($ossnts) || empty($ossntoken)){
		return false;
	}
	$generate = ossn_generate_action_token($ossnts);
	if($ossntoken == $generate){
		return true;
	}
	return false;
}
/**
 * Validate an action token on requested action.
 *
 * Calls to actions will automatically validate tokens. If token is invalid
 * the action stops and user will be redirected with warning of invalid token.
 *
 * @param string $callback	Name of callback
 * @param string $type	Type of callback
 * @param array $params
 *
 * @access private
 * @return void
 */
function ossn_action_validate_callback($callback, $type, $params){
	$action = $params['action'];
	$bypass = array();
	$bypass = ossn_call_hook('action', 'validate:bypass', null, $bypass);
	
	//validate post request also
	ossn_post_size_exceed_error();
	
	if(!in_array($action, $bypass)){
		if(!ossn_validate_actions()){
			if(ossn_is_xhr()){
				header("HTTP/1.0 404 Not Found");
				exit;
			} else {
				ossn_trigger_message(ossn_print('ossn:securitytoken:failed'), 'error');
				redirect(REF);
			}
		}
	}
	
}
ossn_register_callback('action', 'load', 'ossn_action_validate_callback');
