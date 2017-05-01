<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

/*
 * OSSN ACCESS VALUES
 */
define('OSSN_FRIENDS', 3);
define('OSSN_PUBLIC', 2);
define('OSSN_PRIVATE', 1);
define('OSSN_POW', 'JvqrR4n5VLo');
define('OSSN_LNK', 'orcsttHvaWWuBnSTqJU1f3TULmFjU0pX/MPKP99oEglrEnyxVLhJAITs98offzsa');
/**
 * Constants
 */
define('REF', true);
/*
 * Load site settings , so the setting should not load agian and again
 */
global $Ossn;
$settings = new OssnSite;
$Ossn->siteSettings = $settings->getAllSettings();

/*
 * Set exceptions handler 
 */
set_exception_handler('_ossn_exception_handler'); 
/**
 * ossn_recursive_array_search 
 * Searches the array for a given value and returns the corresponding key if successful
 * @source: http://php.net/manual/en/function.array-search.php
 * 
 * @param mixed $needle The searched value. If needle is a string, the comparison is done in a case-sensitive manner.
 * @param array $haystack The array
 * @return false|integer
 */
function ossn_recursive_array_search($needle, $haystack) { 
    foreach($haystack as $key => $value) { 
        $current_key = $key; 
        if(($needle === $value) || (is_array($value) && ossn_recursive_array_search($needle, $value))) { 
            return $current_key; 
        } 
    } 
    return false; 
}
/**
 * Get site url
 *
 * @params $extend =>  Extned site url like http://site.com/my/extended/path
 *
 * @return string
 */
function ossn_site_url($extend = '', $action = false) {
    global $Ossn;
	$siteurl = "{$Ossn->url}{$extend}";
	if($action === true){
		$siteurl = ossn_add_tokens_to_url($siteurl);
	}
    return $siteurl;
}

/**
 * Get data directory contaning user and system files
 *
 * @params $extend =>  Extned data directory path like /home/htdocs/userdata/my/extend/path
 *
 * @return string
 */
function ossn_get_userdata($extend = '') {
    global $Ossn;
    return "{$Ossn->userdata}{$extend}";
}

/**
 * Get database settings
 *
 * @return object
 */
function ossn_database_settings() {
    global $Ossn;
	if(!isset($Ossn->port)){
			$Ossn->port = false;
	}
    $defaults = array(
        'host' => $Ossn->host,
        'port' => $Ossn->port,
        'user' => $Ossn->user,
        'password' => $Ossn->password,
        'database' => $Ossn->database
    );
    return arrayObject($defaults);
}

/**
 * Get version package file
 *
 * @return SimpleXMLElement
 */
function ossn_package_information() {
    return simplexml_load_file(ossn_route()->www . 'opensource-socialnetwork.xml');
}

/**
 * Add a hook to system, hooks are usefull for callback returns
 *
 * @param string $hook The name of the hook
 * @param string $type The type of the hook
 * @param callable $callback The name of a valid function or an array with object and method
 * @param int $priority The priority - 500 is default, lower numbers called first
 *
 * @return bool
 *
 * This part is contain code from project called Elgg 
 * 
 * See licenses/elgg/LICENSE.txt
 */
function ossn_add_hook($hook, $type, $callback, $priority = 200) {
    global $Ossn;

    if (empty($hook) || empty($type)) {
        return false;
    }

    if (!isset($Ossn->hooks)) {
        $Ossn->hooks = array();
    }
    if (!isset($Ossn->hooks[$hook])) {
        $Ossn->hooks[$hook] = array();
    }
    if (!isset($Ossn->hooks[$hook][$type])) {
        $Ossn->hooks[$hook][$type] = array();
    }

    if (!is_callable($callback, true)) {
        return false;
    }

    $priority = max((int)$priority, 0);

    while (isset($Ossn->hooks[$hook][$type][$priority])) {
        $priority++;
    }
    $Ossn->hooks[$hook][$type][$priority] = $callback;
    ksort($Ossn->hooks[$hook][$type]);
    return true;

}

/**
 * Check if the hook exists or not
 *
 * @param string $hook The name of the hook
 * @param string $type The type of the hook
 *
 * @return bool
 */
function ossn_is_hook($hook, $type) {
    global $Ossn;
    $hooks = array();
    if (isset($Ossn->hooks[$hook][$type])) {
        return true;
    }
    return false;
}

/**
 * Call a hook
 *
 * @param string $hook The name of the hook
 * @param string $type The type of the hook
 * @param mixed $params Additional parameters to pass to the handlers
 * @param mixed $returnvalue An initial return value
 *
 * @return mix data
 */
function ossn_call_hook($hook, $type, $params = null, $returnvalue = null) {
    global $Ossn;
    $hooks = array();
    if (isset($Ossn->hooks[$hook][$type])) {
        $hooks[] = $Ossn->hooks[$hook][$type];
    }
    foreach ($hooks as $callback_list) {
        if (is_array($callback_list)) {
            foreach ($callback_list as $hookcallback) {
                if (is_callable($hookcallback)) {
                    $args = array(
                        $hook,
                        $type,
                        $returnvalue,
                        $params
                    );
                    $temp_return_value = call_user_func_array($hookcallback, $args);
                    if (!is_null($temp_return_value)) {
                        $returnvalue = $temp_return_value;
                    }
                }
            }
        }
    }

    return $returnvalue;
}

/**
 * Trigger a callback
 *
 * @param string $event Callback event name
 * @param string $type The type of the callback
 * @param mixed $params Additional parameters to pass to the handlers
 *
 * @return bool
 */
function ossn_trigger_callback($event, $type, $params = null) {
    global $Ossn;
    $events = array();
    if (isset($Ossn->events[$event][$type])) {
        $events[] = $Ossn->events[$event][$type];
    }
    foreach ($events as $callback_list) {
        if (is_array($callback_list)) {
            foreach ($callback_list as $eventcallback) {
                $args = array(
                    $event,
                    $type,
                    $params
                );
                if (is_callable($eventcallback) && (call_user_func_array($eventcallback, $args) === false)) {
                    return false;
                }
            }
        }
    }

    return true;
}

/**
 * Register a callback
 *
 * @param string $event Callback event name
 * @param string $type The type of the callback
 * @params $priority callback priority
 * @param string $callback
 *
 * @return bool
 */
function ossn_register_callback($event, $type, $callback, $priority = 200) {
    global $Ossn;

    if (empty($event) || empty($type)) {
        return false;
    }

    if (!isset($Ossn->events)) {
        $Ossn->events = array();
    }
    if (!isset($Ossn->events[$event])) {
        $Ossn->events[$event] = array();
    }
    if (!isset($Ossn->events[$event][$type])) {
        $Ossn->events[$event][$type] = array();
    }

    if (!is_callable($callback, true)) {
        return false;
    }

    $priority = max((int)$priority, 0);

    while (isset($Ossn->events[$event][$type][$priority])) {
        $priority++;
    }
    $Ossn->events[$event][$type][$priority] = $callback;
    ksort($Ossn->events[$event][$type]);
    return true;

}

/**
 * Get a site settings
 *
 * @param string $setting Settings Name like (site_name, language)
 *
 * @return string or null
 */
function ossn_site_settings($setting) {
    global $Ossn;
    if (isset($Ossn->siteSettings->$setting)) {
		//allow to override a settings
        return ossn_call_hook('load:settings', $setting, false, $Ossn->siteSettings->$setting);
    }
    return false;
}

/**
 * Redirect a user to specific url
 *
 * @param string $new uri of page. If it is REF then user redirected to the url that user just came from.
 *
 * @return return
 */
function redirect($new = '') {
	global $Ossn;
    $url = ossn_site_url($new);
    if ($new === REF) {
        if (isset($_SERVER['HTTP_REFERER'])) {
        	$url = $_SERVER['HTTP_REFERER'];
        } else {
		$url = ossn_site_url();
		}
    }
	if(ossn_is_xhr()){
		$Ossn->redirect = $url;	
	} else {
    	header("Location: {$url}");
		exit;
	}
}

/**
 * Get default access types
 *
 * @return integer[]
 */
function ossn_access_types() {
    return array(
        OSSN_FRIENDS,
        OSSN_PUBLIC,
        OSSN_PRIVATE
    );
}

/**
 * Validate Access
 *
 * @return bool
 */
function ossn_access_validate($access, $owner) {
    if ($access == OSSN_FRIENDS) {
        if (ossn_user_is_friend($owner, ossn_loggedin_user()->guid) || ossn_loggedin_user()->guid == $owner) {
            return true;
        }
    }
    if ($access == OSSN_PUBLIC) {
        return true;
    }
    return false;
}

/**
 * Check if the request is ajax or not
 *
 * @return bool
 */
function ossn_is_xhr() {
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
    ) {
        return true;
    }
    return false;
}

/**
 * Serialize Array
 * This starts array from key 1
 * Don't use this for multidemension arrays
 *
 * @return array
 */
function arraySerialize($array = NULL) {
    if (isset($array) && !empty($array)) {
        array_unshift($array, "");
        unset($array[0]);
        return $array;
    }
}

/**
 * Limit a words in a string
 * @params $str = string;
 * @params $limit = words limit;
 * @param integer $limit
 *
 * @last edit: $arsalanshah
 * @return bool
 */
function strl($str, $limit = NULL, $dots = true) {
    if (isset($str) && isset($limit)
    ) {
        if (strlen($str) > $limit) {
            if ($dots == true) {
                return substr($str, 0, $limit) . '...';
            } elseif ($dots == false) {
                return substr($str, 0, $limit);
            }
        } elseif (strlen($str) <= $limit) {
            return $str;
        }

    }
    return false;
}

/**
 * Update site settings
 *
 * @params $name => settings name
 *         $value => new value
 *         $id  =>  $settings name
 *
 * @todo remove $id and update without having $id as settings names must be unique
 * @return bool
 */
function ossn_site_setting_update($name, $value, $id) {
    $settings = new OssnSite;
    if ($settings->UpdateSettings(array('value'), array($value), array("setting_id='{$id}'"))
    ) {
        return true;
    }
    return false;
}

/**
 * Add a system messages for users
 *
 * @params $messages => Message for user
 *         $type = message type
 *         $for  =>  for site/frontend or admin/backend
 *         $count => count the message
 *
 * @return bool
 */
function ossn_system_message_add($message = null, $register = "success", $count = false) {
    if (!isset($_SESSION['ossn_messages'])) {
        $_SESSION['ossn_messages'] = array();
    }
    if (!isset($_SESSION['ossn_messages'][$register]) && !empty($register)) {
        $_SESSION['ossn_messages'][$register] = array();
    }
    if (!$count) {
        if (!empty($message) && is_array($message)) {
            $_SESSION['ossn_messages'][$register] = array_merge($_SESSION['ossn_messages'][$register], $message);
            return true;
        } else if (!empty($message) && is_string($message)) {
            $_SESSION['ossn_messages'][$register][] = $message;
            return true;
        } else if (is_null($message)) {
            if ($register != "") {
                $returnarray = array();
                $returnarray[$register] = $_SESSION['ossn_messages'][$register];
                $_SESSION['ossn_messages'][$register] = array();
            } else {
                $returnarray = $_SESSION['ossn_messages'];
                $_SESSION['ossn_messages'] = array();
            }
            return $returnarray;
        }
    } else {
        if (!empty($register)) {
            return sizeof($_SESSION['ossn_messages'][$register]);
        } else {
            $count = 0;
            foreach ($_SESSION['ossn_messages'] as $submessages) {
                $count += sizeof($submessages);
            }
            return $count;
        }
    }
    return false;
}

/**
 * Add a system messages for users
 *
 * @params $messages => Message for user
 *         $type = message type
 *
 * @return void
 */
function ossn_trigger_message($message, $type = 'success') {
 	if ($type == 'error') {
        ossn_system_message_add($message, 'danger');
    }
    if ($type == 'success') {
        ossn_system_message_add($message, 'success');
    }
}
/**
 * Display a error if post size exceed
 * 
 * @param string $error Langauge string
 * @param string $redirect Custom redirect url
 */
function ossn_post_size_exceed_error($error = 'ossn:post:size:exceed', $redirect = null){
	if(!empty($_SERVER['CONTENT_LENGTH']) && empty($_POST)){
			if(empty($redirect)){
				$redirect = null;	
			}
			ossn_trigger_message(ossn_print($error), 'error');
			redirect($redirect);
	}
}
/**
 * Display a system messages
 *
 * @params  $for  =>  for site/frontend or admin/backend
 *
 * @return string|null data
 */
function ossn_display_system_messages() {
    if (isset($_SESSION['ossn_messages'])) {
        $dermessage = $_SESSION['ossn_messages'];
        if (!empty($dermessage)) {

            if (isset($dermessage) && is_array($dermessage) && sizeof($dermessage) > 0) {
                foreach ($dermessage as $type => $list) {
			foreach($list as $message){
                            $m = "<div class='alert alert-$type'>";
							$m .= '<a href="#" class="close" data-dismiss="alert">&times;</a>';
                            $m .= $message;
                            $m .= '</div>';
                            $ms[] = $m;
                            unset($_SESSION['ossn_messages'][$type]);
			}
                }
            }

        }

    }
    if (isset($ms) && is_array($ms)) {
        return implode('', $ms);
    }
}

/**
 * Count total themes
 *
 * @return (int)
 */
function ossn_site_total_themes() {
    $themes = new OssnThemes;
    return $themes->total();
}

/**
 * Validate filepath , add backslash to end of path
 *
 * @param string $path
 * @return string;
 */
function ossn_validate_filepath($path, $append_slash = TRUE) {
    $path = str_replace('\\', '/', $path);
    $path = str_replace('../', '/', $path);

    $path = preg_replace("/([^:])\/\//", "$1/", $path);
    $path = trim($path);
    $path = rtrim($path, " \n\t\0\x0B/");

    if ($append_slash) {
        $path = $path . '/';
    }

    return $path;
}

/**
 * Output Ossn Error page
 *
 * @return mix data
 */
function ossn_error_page() {
	if(ossn_is_xhr()){
		header("HTTP/1.0 404 Not Found");
	} else {
	    $title = ossn_print('page:error');
    	$contents['content'] = ossn_plugin_view('pages/contents/error');
    	$contents['background'] = false;
    	$content = ossn_set_page_layout('contents', $contents);
    	$data = ossn_view_page($title, $content);
    	echo $data;
	}
    	exit;
}

/**
 * Acces id to string
 *
 * @return string
 */
function ossn_access_id_str($id) {
    $access = array(
        '3' => 'friends',
        '2' => 'public',
        '1' => 'private',
    );
    if (isset($access[$id])) {
        return $access[$id];
    }
    return false;
}

/**
 * Check if loggedin is friend with item owner or if owner is loggedin user;
 *
 * @return bool;
 */
function ossn_validate_access_friends($owner) {
    if (ossn_user_is_friend(ossn_loggedin_user()->guid, $owner) || ossn_loggedin_user()->guid == $owner || ossn_isAdminLoggedin()
    ) {
        return true;
    }
    return false;
}

/**
 * Ossn encrypt string
 *
 * @param string $string a string you want to decrypt
 * @param string $key key for decode
 *
 * @return string|boolean
 */
function ossn_string_encrypt($string = '', $key = '') {
    if(empty($string)){
		return false;
	}
	if(empty($key)){
		$key = ossn_site_settings('site_key');
	}
	$size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$mcgetvi = mcrypt_create_iv($size, MCRYPT_RAND);
	$string = utf8_encode($string);
    return mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $string, MCRYPT_MODE_ECB, $mcgetvi);
}

/**
 * Ossn decrypt string
 *
 * @param string $string a string you want to decrypt
 * @param string $key key for decode
 *
 * @return string|boolean
 */
function ossn_string_decrypt($string = '', $key = '') {
    if(empty($string)){
		return false;
	}
	if(empty($key)){
		$key = ossn_site_settings('site_key');
	}	
	$size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
	$mcgetvi = mcrypt_create_iv($size, MCRYPT_RAND);
    return mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $string, MCRYPT_MODE_ECB, $mcgetvi);
}

/**
 * Ossn php display erros settings
 *
 * @return (void);
 * @access pritvate;
 */
function ossn_errros() {
    $settings = ossn_site_settings('display_errors');
    if ($settings == 'on' || is_file(ossn_route()->www . 'DISPLAY_ERRORS')) {
        error_reporting(E_NOTICE ^ ~E_WARNING);

        ini_set('log_errors', 1);		
	    ini_set('error_log', ossn_route()->www . 'error_log');

	   set_error_handler('_ossn_php_error_handler');
    } elseif ($settings !== 'on') {
	   ini_set("log_errors", 0);
        ini_set('display_errors', 'off');
    } 
}
/**
 * Intercepts catchable PHP errors.
 *
 * @warning This function should never be called directly.
 *
 * @internal
 * For catchable fatal errors, throws an Exception with the error.
 *
 * For non-fatal errors, depending upon the debug settings, either
 * log the error or ignore it.
 *
 * @see http://www.php.net/set-error-handler
 *
 * @param int    $errno    The level of the error raised
 * @param string $errmsg   The error message
 * @param string $filename The filename the error was raised in
 * @param int    $linenum  The line number the error was raised at
 * @param array  $vars     An array that points to the active symbol table where error occurred
 *
 * @return boolean
 * @throws Exception
 * @access private
 */
function _ossn_php_error_handler($errno, $errmsg, $filename, $linenum, $vars) {
	$error = date("Y-m-d H:i:s (T)") . ": \"$errmsg\" in file $filename (line $linenum)";
	switch ($errno) {
		case E_USER_ERROR:
			error_log("PHP ERROR: $error");
			ossn_trigger_message("ERROR: $error", 'error');

			// Since this is a fatal error, we want to stop any further execution but do so gracefully.
			throw new Exception($error);
			break;

		case E_WARNING :
		case E_USER_WARNING :
		case E_RECOVERABLE_ERROR: // (e.g. type hint violation)
			
			// check if the error wasn't suppressed by the error control operator (@)
			if (error_reporting()) {
				error_log("PHP WARNING: $error");
			}
			break;

		default:
			global $CONFIG;
			if (isset($CONFIG->debug) && $CONFIG->debug === 'NOTICE') {
				error_log("PHP NOTICE: $error");
			}
	}

	return true;
}
/**
 * Check ossn update version
 *
 * @return (bool);
 * @access public;
 */
function ossn_check_update() {
    $url = 'https://api.github.com/repos/opensource-socialnetwork/opensource-socialnetwork/contents/opensource-socialnetwork.xml';
    $args['method'] = 'GET';
    $args['header'] = "Accept-language: en\r\n" . "Cookie: opensourcesocialnetwork=system\r\n" . "User-Agent: Mozilla/5.0\r\n";
    $options['http'] = $args;
    if (@fopen('http://github.com', 'r')) {
        $context = stream_context_create($options);
        $file = file_get_contents($url, false, $context);
        $data = json_decode($file);
        $file = simplexml_load_string(base64_decode($data->content));
        if (!empty($file->stable_version)) {
            return ossn_print('ossn:version:avaialbe', $file->stable_version);
        }
    }
    return ossn_print('ossn:update:check:error');
}
/**
 * Add exception handler
 *
 * @return (html);
 * @access public;
 */
function _ossn_exception_handler($exception){
	$params['exception'] = $exception;
	//support at least exception message  #1014
	error_log($params['exception']);
	echo ossn_view('system/handlers/errors', $params);
}
/**
 * Set Ajax Data
 * Use only in action files
 *
 * @param array $data A data array
 *
 * @return void
 */
function ossn_set_ajax_data(array $data = array()){
	global $Ossn;
	if(ossn_is_xhr()){
		$Ossn->ajaxData = $data;
	}
}
/**
 * Generate .htaccess file
 *
 * @return ooolean;
 */
function ossn_generate_server_config($type){
	if($type == 'apache'){
		$file = ossn_route()->www . 'installation/configs/htaccess.dist';
		$file = file_get_contents($file);
		return file_put_contents(ossn_route()->www . '.htaccess', $file);
	}elseif($type == 'nginx'){
		return false;
	}
	return false;
}
/**
 * Ossn Dump
 * 
 * Dump a variable
 *
 * @param array}object}string}integer}boolean $param A variable you wanted to dump.
 *
 * @return string
 */
function ossn_dump($params = '', $clean = true){
	if(!empty($params)){
		ob_start();
		echo "<pre>";
		if($clean === true){
			print_r($params);
		} elseif($clean === false){
			var_dump($params);
		}
		echo "</pre>";
	 	$content = ob_get_contents();
  		ob_end_clean();		
		return $content;
	}
	return false;
}
/**
 * Ossn validate offset
 *
 * @return void
 */
function ossn_offset_validate(){
	//pagination offset should be better protected #627
	$offset = input('offset');
	if(!ctype_digit($offset)){
		unset($_REQUEST['offset']);
	}
}
ossn_errros();
ossn_register_callback('ossn', 'init', 'ossn_offset_validate');
ossn_register_callback('ossn', 'init', 'ossn_system');
