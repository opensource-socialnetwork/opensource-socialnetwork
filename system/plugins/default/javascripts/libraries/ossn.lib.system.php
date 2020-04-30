//<script>
/**
 * Ossn.isset
 * 
 * Checks if the variable isset or not
 * 
 * @param int|bool|func|object $variable Any variable
 * 
 * @return boolean
 */
Ossn.isset = function($variable) {
	if (typeof $variable !== 'undefined') {
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
Ossn.call_user_func_array = function(cb, parameters) {
	var $global = (typeof window !== 'undefined' ? window : global)
	var func
	var scope = null

	var validJSFunctionNamePattern = /^[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*$/

	if (typeof cb === 'string') {
		if (typeof $global[cb] === 'function') {
			func = $global[cb]
		} else if (cb.match(validJSFunctionNamePattern)) {
			func = (new Function(null, 'return ' + cb)()) // eslint-disable-line no-new-func
		}
	} else if (Object.prototype.toString.call(cb) === '[object Array]') {
		if (typeof cb[0] === 'string') {
			if (cb[0].match(validJSFunctionNamePattern)) {
				func = eval(cb[0] + "['" + cb[1] + "']") // eslint-disable-line no-eval
			}
		} else {
			func = cb[0][cb[1]]
		}

		if (typeof cb[0] === 'string') {
			if (typeof $global[cb[0]] === 'function') {
				scope = $global[cb[0]]
			} else if (cb[0].match(validJSFunctionNamePattern)) {
				scope = eval(cb[0]) // eslint-disable-line no-eval
			}
		} else if (typeof cb[0] === 'object') {
			scope = cb[0]
		}
	} else if (typeof cb === 'function') {
		func = cb
	}

	if (typeof func !== 'function') {
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
Ossn.is_callable = function(mixedVar, syntaxOnly, callableName) {
	var $global = (typeof window !== 'undefined' ? window : global)

	var validJSFunctionNamePattern = /^[_$a-zA-Z\xA0-\uFFFF][_$a-zA-Z0-9\xA0-\uFFFF]*$/

	var name = ''
	var obj = {}
	var method = ''
	var validFunctionName = false

	var getFuncName = function(fn) {
		var name = (/\W*function\s+([\w$]+)\s*\(/).exec(fn)
		if (!name) {
			return '(Anonymous)'
		}
		return name[1]
	}

	// eslint-disable-next-line no-useless-escape
	if (/(^class|\(this\,)/.test(mixedVar.toString())) {
		return false
	}

	if (typeof mixedVar === 'string') {
		obj = $global
		method = mixedVar
		name = mixedVar
		validFunctionName = !!name.match(validJSFunctionNamePattern)
	} else if (typeof mixedVar === 'function') {
		return true
	} else if (Object.prototype.toString.call(mixedVar) === '[object Array]' &&
		mixedVar.length === 2 &&
		typeof mixedVar[0] === 'object' &&
		typeof mixedVar[1] === 'string') {
		obj = mixedVar[0]
		method = mixedVar[1]
		name = (obj.constructor && getFuncName(obj.constructor)) + '::' + method
	}

	if (syntaxOnly || typeof obj[method] === 'function') {
		if (callableName) {
			$global[callableName] = name
		}
		return true
	}

	if (validFunctionName && typeof eval(method) === 'function') { // eslint-disable-line no-eval
		if (callableName) {
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
Ossn.is_hook = function($hook, $type) {
	if (Ossn.isset(Ossn.hooks[$hook][$type])) {
		return true;
	}
	return false;
}
/**
 * Unset a hook to system, hooks are usefull for callback returns
 *
 * @param string 	  $hook 		  The name of the hook
 * @param string 	  $type 		  The type of the hook
 * @param callable 	$callback 	The name of a valid function or an array with object and method
 *
 * @return boolean
 */
Ossn.unset_hook = function($hook, $type, $callback) {
	if ($hook == '' || $type == '' || $callback == '') {
		return false;
	}
	if (Ossn.is_hook($hook, $type)) {
		for (i = 0; i <= Ossn.hooks[$hook][$type].length; i++) {
			if (Ossn.isset(Ossn.hooks[$hook][$type][i])) {
				if (Ossn.isset(Ossn.hooks[$hook][$type][i].hook)) {
					if (Ossn.hooks[$hook][$type][i].hook == $callback) {
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
Ossn.add_hook = function($hook, $type, $callback, $priority = 200) {
	if ($hook == '' || $type == '') {
		return false;
	}

	if (!Ossn.isset(Ossn.hooks)) {
		Ossn.hooks = new Array();
	}
	if (!Ossn.isset(Ossn.hooks[$hook])) {
		Ossn.hooks[$hook] = new Array();
	}
	if (!Ossn.isset(Ossn.hooks[$hook][$type])) {
		Ossn.hooks[$hook][$type] = new Array();
	}
	if (!Ossn.is_callable($callback, true)) {
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
Ossn.call_hook = function($hook, $type, $params = null, $returnvalue = null) {
	$hooks = new Array();
	hookspush = Array.prototype.push

	if (Ossn.hooks[$hook][$type].length) {
		hookspush.apply($hooks, Ossn.hooks[$hook][$type]);
	}
	$hooks.sort(function(a, b) {
		if (a.priority < b.priority) {
			return -1;
		}
		if (a.priority > b.priority) {
			return 1;
		}
		return (a.index < b.index) ? -1 : 1;
	});
	$tempvalue = null;
	$.each($hooks, function(index, $item) {
		$value = Ossn.call_user_func_array($item.hook, [$hook, $type, $params, $returnvalue]);
		if (Ossn.isset($value)) {
			$tempvalue = $value;
		}
	});
	return $tempvalue;
};
