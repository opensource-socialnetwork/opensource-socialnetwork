//<script>
/**
 *  Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
var Ossn = Ossn || {};
Ossn.Startups = new Array();
Ossn.hooks = new Array();
Ossn.events = new Array();
/**
 * Register a startup function
 *
 * @return void
 */
Ossn.RegisterStartupFunction = function($func) {
	Ossn.Startups.push($func);
};
/**
 * Click on element
 *
 * @param $elem = element;
 *
 * @return void
 */
Ossn.Clk = function($elem) {
	$($elem).click();
};
/**
 * Ossn.str_replace
 * 
 * Replace all occurrences of the search string with the replacement string
 * See https://www.php.net/manual/en/function.str-replace.php
 *
 * @author original by https://locutus.io/php/str_replace/
 * 
 * @param string  search   The value being searched for, otherwise known as the needle. An array may be used to designate multiple needles.
 * @param string  replace  The replacement value that replaces found search values. An array may be used to designate multiple replacements.
 * @param string  subject  The string or array being searched and replaced on, otherwise known as the haystack.
 * @param integer countObj If passed, this will be set to the number of replacements performed.
 *
 * @return boolean
 */
Ossn.str_replace = function(search, replace, subject, countObj){
	var i = 0
	var j = 0
	var temp = ''
	var repl = ''
	var sl = 0
	var fl = 0
	var f = [].concat(search)
	var r = [].concat(replace)
	var s = subject
	var ra = Object.prototype.toString.call(r) === '[object Array]'
	var sa = Object.prototype.toString.call(s) === '[object Array]'
	s = [].concat(s)

	var $global = (typeof window !== 'undefined' ? window : global)
	$global.$locutus = $global.$locutus || {}
	var $locutus = $global.$locutus
	$locutus.php = $locutus.php || {}

	if (typeof(search) === 'object' && typeof(replace) === 'string') {
		temp = replace
		replace = []
		for (i = 0; i < search.length; i += 1) {
			replace[i] = temp
		}
		temp = ''
		r = [].concat(replace)
		ra = Object.prototype.toString.call(r) === '[object Array]'
	}

	if (typeof countObj !== 'undefined') {
		countObj.value = 0
	}

	for (i = 0, sl = s.length; i < sl; i++) {
		if (s[i] === '') {
			continue
		}
		for (j = 0, fl = f.length; j < fl; j++) {
			temp = s[i] + ''
			repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0]
			s[i] = (temp).split(f[j]).join(repl)
			if (typeof countObj !== 'undefined') {
				countObj.value += ((temp.split(f[j])).length - 1)
			}
		}
	}
	return sa ? s : s[0];
};
/**
 * Redirect user to other page
 *
 * @param $url path
 *
 * @return void
 */
Ossn.redirect = function($url) {
	window.location = Ossn.site_url + $url;
};
/**
 * Get url paramter
 *
 * @param name Parameter name;
 * @param url complete url
 *
 * @return string
 */
Ossn.UrlParams = function(name, url) {
	var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(url);
	if (!results) {
		return 0;
	}
	return results[1] || 0;
};
/**
 * Returns an object with key/values of the parsed query string.
 *
 * @param  {String} string The string to parse
 * @return {Object} The parsed object string
 */
Ossn.ParseStr = function(string) {
	var params = {},
		result,
		key,
		value,
		re = /([^&=]+)=?([^&]*)/g,
		re2 = /\[\]$/;

	while (result = re.exec(string)) {
		key = decodeURIComponent(result[1].replace(/\+/g, ' '));
		value = decodeURIComponent(result[2].replace(/\+/g, ' '));

		if (re2.test(key)) {
			key = key.replace(re2, '');
			if (!params[key]) {
				params[key] = [];
			}
			params[key].push(value);
		} else {
			params[key] = value;
		}
	}

	return params;
};
/**
 * Parse a URL into its parts. Mimicks http://php.net/parse_url
 *
 * @param {String} url       The URL to parse
 * @param {Int}    component A component to return
 * @param {Bool}   expand    Expand the query into an object? Else it's a string.
 *
 * @return {Object} The parsed URL
 */
Ossn.ParseUrl = function(url, component, expand) {
	// Adapted from http://blog.stevenlevithan.com/archives/parseuri
	// which was release under the MIT
	// It was modified to fix mailto: and javascript: support.
	expand = expand || false;
	component = component || false;

	var re_str =
		// scheme (and user@ testing)
		'^(?:(?![^:@]+:[^:@/]*@)([^:/?#.]+):)?(?://)?'

		// possibly a user[:password]@
		+ '((?:(([^:@]*)(?::([^:@]*))?)?@)?'
		// host and port
		+ '([^:/?#]*)(?::(\\d*))?)'
		// path
		+ '(((/(?:[^?#](?![^?#/]*\\.[^?#/.]+(?:[?#]|$)))*/?)?([^?#/]*))'
		// query string
		+ '(?:\\?([^#]*))?'
		// fragment
		+ '(?:#(.*))?)',
		keys = {
			1: "scheme",
			4: "user",
			5: "pass",
			6: "host",
			7: "port",
			9: "path",
			12: "query",
			13: "fragment"
		},
		results = {};

	if (url.indexOf('mailto:') === 0) {
		results['scheme'] = 'mailto';
		results['path'] = url.replace('mailto:', '');
		return results;
	}

	if (url.indexOf('javascript:') === 0) {
		results['scheme'] = 'javascript';
		results['path'] = url.replace('javascript:', '');
		return results;
	}

	var re = new RegExp(re_str);
	var matches = re.exec(url);

	for (var i in keys) {
		if (matches[i]) {
			results[keys[i]] = matches[i];
		}
	}

	if (expand && typeof(results['query']) != 'undefined') {
		results['query'] = ParseStr(results['query']);
	}

	if (component) {
		if (typeof(results[component]) != 'undefined') {
			return results[component];
		} else {
			return false;
		}
	}
	return results;
};
/**
 * Ossn.isset
 * 
 * Checks if the variable isset or not
 * 
 * @param int|bool|func|object $variable Any variable
 * 
 * @return boolean
 */
Ossn.isset = function($variable){
	if(typeof $variable !== 'undefined'){
		return true;
	}
	return false;
};
/**
 * Ossn.call_user_func_array
 * 
 * Checks if the variable isset or not
 * See https://www.php.net/manual/en/function.call-user-func-array.php
 *
 * @author original by Thiago Mata (https://thiagomata.blog.com)
 * @author original by revised by: Jon Hohle
 * @author original byimproved by: Brett Zamir (https://brett-zamir.me)
 * @author original byimproved by: Diplom@t (https://difane.com/)
 * @author original byimproved by: Brett Zamir (https://brett-zamir.me)
 * 
 * @param string 	cb		A callback function
 * @param array|object  parameters	A option values
 * 
 * @return mixed
 */
Ossn.call_user_func_array = function(cb, parameters){
	var $global = (typeof window !== 'undefined' ? window : global)
	var func
	var scope = null

	var validJSFunctionNamePattern = /^[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*$/;

	if(typeof cb === 'string'){
		if(typeof $global[cb] === 'function'){
			func = $global[cb]
		} else if(cb.match(validJSFunctionNamePattern)){
			func = (new Function(null, 'return ' + cb)()) // eslint-disable-line no-new-func
		}
	} else if(Object.prototype.toString.call(cb) === '[object Array]'){
		if(typeof cb[0] === 'string'){
			if(cb[0].match(validJSFunctionNamePattern)){
				func = eval(cb[0] + "['" + cb[1] + "']") // eslint-disable-line no-eval
			}
		} else {
			func = cb[0][cb[1]]
		}

		if(typeof cb[0] === 'string'){
			if(typeof $global[cb[0]] === 'function'){
				scope = $global[cb[0]]
			} else if(cb[0].match(validJSFunctionNamePattern)){
				scope = eval(cb[0]) // eslint-disable-line no-eval
			}
		} else if(typeof cb[0] === 'object'){
			scope = cb[0]
		}
	} else if(typeof cb === 'function'){
		func = cb
	}

	if(typeof func !== 'function'){
		throw new Error(func + ' is not a valid function')
	}

	return func.apply(scope, parameters)
};
/**
 * Ossn.is_callable
 * 
 * Checks if the variable isset or not
 * See https://www.php.net/manual/en/function.is-callable.php
 *
 * @author original by Thiago Mata (https://thiagomata.blog.com)
 * @author original by revised by: Jon Hohle
 * @author original byimproved by: Brett Zamir (https://brett-zamir.me)
 * @author original byimproved by: Diplom@t (https://difane.com/)
 * @author original byimproved by: Brett Zamir (https://brett-zamir.me)
 * 
 * @param variable|function 	mixedVar 	A function or callback name
 * @param boolean             	syntaxOnly 	If set to TRUE the function only verifies that var might be a function or method. It will only reject simple variables that are not strings, or an array that does not have a valid structure to be used as a callback. The valid ones are supposed to have only 2 entries, the first of which is an object or a string, and the second a string.
 *
 * @return boolean
 */
Ossn.is_callable = function(mixedVar, syntaxOnly, callableName){
	var $global = (typeof window !== 'undefined' ? window : global)

	var validJSFunctionNamePattern = /^[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*$/;

	var name = ''
	var obj = {}
	var method = ''
	var validFunctionName = false

	var getFuncName = function(fn){
		var name = (/\W*function\s+([\w$]+)\s*\(/).exec(fn)
		if(!name){
			return '(Anonymous)'
		}
		return name[1]
	}

	// eslint-disable-next-line no-useless-escape
	if(/(^class|\(this\,)/.test(mixedVar.toString())){
		return false
	}

	if(typeof mixedVar === 'string'){
		obj = $global
		method = mixedVar
		name = mixedVar
		validFunctionName = !!name.match(validJSFunctionNamePattern)
	} else if(typeof mixedVar === 'function'){
		return true
	} else if(Object.prototype.toString.call(mixedVar) === '[object Array]' &&
		mixedVar.length === 2 &&
		typeof mixedVar[0] === 'object' &&
		typeof mixedVar[1] === 'string'){
		obj = mixedVar[0]
		method = mixedVar[1]
		name = (obj.constructor && getFuncName(obj.constructor)) + '::' + method
	}

	if(syntaxOnly || typeof obj[method] === 'function'){
		if(callableName){
			$global[callableName] = name
		}
		return true
	}

	if(validFunctionName && typeof eval(method) === 'function'){ // eslint-disable-line no-eval
		if(callableName){
			$global[callableName] = name
		}
		return true
	}

	return false
}
/**
 * Check if hook exists or not
 *
 * @param string $hook 	The name of the hook
 * @param string $type 	The type of the hook
 *
 * @return boolean
 */
Ossn.is_hook = function($hook, $type){
	if(Ossn.isset(Ossn.hooks[$hook][$type])){
		return true;
	}
	return false;
}
/**
 * Unset a hook to system, hooks are usefull for callback returns
 *
 * @param string	$hook		The name of the hook
 * @param string	$type		The type of the hook
 * @param callable	$callback	The name of a valid function or an array with object and method
 *
 * @return boolean
 */
Ossn.unset_hook = function($hook, $type, $callback){
	if($hook == '' || $type == '' || $callback == ''){
		return false;
	}
	if(Ossn.is_hook($hook, $type)){
		for (i = 0; i <= Ossn.hooks[$hook][$type].length; i++){
			if(Ossn.isset(Ossn.hooks[$hook][$type][i])){
				if(Ossn.isset(Ossn.hooks[$hook][$type][i].hook)){
					if(Ossn.hooks[$hook][$type][i].hook == $callback){
						Ossn.hooks[$hook][$type].splice(i, 1);
						break;
					}
				}
			}
		}
	}
};
/**
 * Add a hook to system, hooks are usefull for callback returns
 *
 * @param string	$hook		The name of the hook
 * @param string	$type		The type of the hook
 * @param callable 	$callback	The name of a valid function or an array with object and method
 * @param int		$priority	The priority - 200 is default, lower numbers called first
 *
 * @return boolean
 */
Ossn.add_hook = function($hook, $type, $callback, $priority = 200){
	if($hook == '' || $type == ''){
		return false;
	}
	if(!Ossn.isset(Ossn.hooks)){
		Ossn.hooks = new Array();
	}
	if(!Ossn.isset(Ossn.hooks[$hook])){
		Ossn.hooks[$hook] = new Array();
	}
	if(!Ossn.isset(Ossn.hooks[$hook][$type])){
		Ossn.hooks[$hook][$type] = new Array();
	}
	if(!Ossn.is_callable($callback, true)){
		return false;
	}

	$priority = Math.max(parseInt($priority), 0);
	Ossn.hooks[$hook][$type].push({
		'hook': $callback,
		'priority': $priority,
	});
	return true;
};
/**
 * Call a hook
 *
 * @param string	$hook		The name of the hook
 * @param string	$type		The type of the hook
 * @param array|object  $params		Additional parameters to pass to the handlers
 * @param mixed		$returnvalue 	An initial return value
 *
 * @return mixed
 */
Ossn.call_hook = function($hook, $type, $params = null, $returnvalue = null){
	$hooks = new Array();
	hookspush = Array.prototype.push

	if(Ossn.isset(Ossn.hooks[$hook]) && Ossn.isset(Ossn.hooks[$hook][$type])){
		hookspush.apply($hooks, Ossn.hooks[$hook][$type]);
	}
	$hooks.sort(function(a, b){
		if(a.priority < b.priority){
			return -1;
		}
		if(a.priority > b.priority){
			return 1;
		}
		return (a.index < b.index) ? -1 : 1;
	});
	$.each($hooks, function(index, $item){
		$value = Ossn.call_user_func_array($item.hook, [$hook, $type, $returnvalue, $params]);
		if(Ossn.isset($value)){
			$returnvalue = $value;
		}
	});
	return $returnvalue;
};
/**
 * Check if callback exists or not
 *
 * @param string $callback 	The name of the callback
 * @param string $type 	The type of the callback
 *
 * @return boolean
 */
Ossn.is_callback = function($event, $type){
	if(Ossn.isset(Ossn.events[$event][$type])){
		return true;
	}
	return false;
}
/**
 * Add a callback to system, callbacks are usefull for do something when some event occurs
 *
 * @param string	$event		The name of the callback
 * @param string	$type		The type of the callback
 * @param callable 	$callback	The name of a valid function
 * @param int		$priority	The priority - 200 is default, lower numbers called first
 *
 * @return boolean
 */
Ossn.register_callback = function($event, $type, $callback, $priority = 200){
	if($event == '' || $type == ''){
		return false;
	}
	if(!Ossn.isset(Ossn.events)){
		Ossn.events = new Array();
	}
	if(!Ossn.isset(Ossn.events[$event])){
		Ossn.events[$event] = new Array();
	}
	if(!Ossn.isset(Ossn.events[$event][$type])){
		Ossn.events[$event][$type] = new Array();
	}
	if(!Ossn.is_callable($callback, true)){
		return false;
	}
	$priority = Math.max(parseInt($priority), 0);
	Ossn.events[$event][$type].push({
		'callback': $callback,
		'priority': $priority,
	});
	return true;
};
/**
 * Unset a event callback to system
 *
 * @param string 	$event		The name of the callback
 * @param string	$type		The type of the callback
 * @param callable	$callback	The name of a valid function
 *
 * @return boolean
 */
Ossn.unset_callback = function($event, $type, $callback){
	if($event == '' || $type == '' || $callback == ''){
		return false;
	}
	if(Ossn.is_callback($event, $type)){
		for (i = 0; i <= Ossn.events[$event][$type].length; i++){
			if(Ossn.isset(Ossn.events[$event][$type][i])){
				if(Ossn.isset(Ossn.events[$event][$type][i].callback)){
					if(Ossn.events[$event][$type][i].callback == $callback){
						Ossn.events[$event][$type].splice(i, 1);
						break;
					}
				}
			}
		}
	}
};
/**
 * Trigger a callback
 *
 * @param string	$callback	The name of the callback
 * @param string	$type		The type of the callback
 * @param array|object  $params		Additional parameters to pass to the handlers
 * @param mixed		$returnvalue 	An initial return value
 *
 * @return mixed
 */
Ossn.trigger_callback = function($event, $type, $params = null){
	$events = new Array();
	eventspush = Array.prototype.push

	if(Ossn.isset(Ossn.events[$event]) && Ossn.isset(Ossn.events[$event][$type])){
		eventspush.apply($events, Ossn.events[$event][$type]);
	} else {
		return false;
	}
	$events.sort(function(a, b){
		if(a.priority < b.priority){
			return -1;
		}
		if(a.priority > b.priority){
			return 1;
		}
		return (a.index < b.index) ? -1 : 1;
	});
	$tempvalue = null;
	$.each($events, function(index, $item){
		if(Ossn.is_callable($item.callback) && (Ossn.call_user_func_array($item.callback, [$event, $type, $params]) == false)){
			return false;
		}
	});
	return true;
};
