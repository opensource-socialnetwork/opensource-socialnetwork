<?php
/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence 
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
//<script>
/**
 * 	Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
var Ossn = Ossn || {};
Ossn.Startups = new Array();
/**
 * Register a startup function
 *
 * @return void
 */
Ossn.RegisterStartupFunction = function($func) {
	Ossn.Startups.push($func);
};
/**
 * Register a ajax request
 *
 * @param $data['form'] = form id
 *        $data['callback'] = call back function
 *        $data['error'] = on error function
 *        $data['beforeSend'] = before send function
 *        $data['url'] = form action url
 *
 * @return bool
 */
Ossn.ajaxRequest = function($data) {
	$(function() {
		var $form_name = $data['form'];
		var url = $data['url'];
		var callback = $data['callback'];
		var error = $data['error'];
		var befsend = $data['beforeSend'];
		var action = $data['action'];
		var containMedia = $data['containMedia'];
		var $xhr = $data['xhr'];
		if (url == true) {
			url = $($form_name).attr('action');
		}
		$('body').on("submit", $form_name, function(event) {
            		event.preventDefault();
 			event.stopImmediatePropagation();
 			
			if (!callback) {
				return false;
			}
			if (!befsend) {
				befsend = function() {}
			}
			if (!action) {
				action = false;
			}
			if (action == true) {
				url = Ossn.AddTokenToUrl(url);
			}

			if (!error) {
				error = function(xhr, status, error) {
					if (error == 'Internal Server Error' || error !== '') {
						Ossn.MessageBox('syserror/unknown');
					}
				};
			}
			if (!$xhr) {
				$xhr = function() {
					var xhr = new window.XMLHttpRequest();
					return xhr;
				};
			}
			var $form = $(this);
			if (containMedia == true) {
				$vars = {
					xhr: $xhr,
					async: true,
					cache: false,
					contentType: false,
					type: 'post',
					beforeSend: befsend,
					url: url,
					error: error,
					data: new FormData($form[0]),
					processData: false,
					success: callback,
				};
			} else {
				$vars = {
					xhr: $xhr,
					async: true,
					type: 'post',
					beforeSend: befsend,
					url: url,
					error: error,
					data: $form.serialize(),
					success: callback,
				};
			}

			$.ajax($vars);
		});
	});
};
/**
 * Register a post request
 *
 * @param $data['callback'] = call back function
 *        $data['error'] = on error function
 *        $data['beforeSend'] = before send function
 *        $data['url'] = form action url
 *
 * @return bool
 */
Ossn.PostRequest = function($data) {
	var url = $data['url'];
	var callback = $data['callback'];
	var error = $data['error'];
	var befsend = $data['beforeSend'];
	var $fdata = $data['params'];
	var action = $data['action'];
	var $xhr = $data['xhr'];
	if (!callback) {
		return false;
	}
	if (!befsend) {
		befsend = function() {}
	}
	if (!action) {
		action = true;
	}
	if (action == true) {
		url = Ossn.AddTokenToUrl(url);
	}
	if (!error) {
		error = function() {};
	}
	if (!$xhr) {
		$xhr = function() {
			var xhr = new window.XMLHttpRequest();
			return xhr;
		};
	}
	$.ajax({
		xhr: $xhr,
		async: true,
		type: 'post',
		beforeSend: befsend,
		url: url,
		error: error,
		data: $fdata,
		success: callback,
	});
};
/**
 * Message done
 *
 * @param $message = message
 *
 * @return mix data
 */
Ossn.MessageDone = function($message) {
	return "<div class='ossn-message-done'>" + $message + "</div>";
};
/**
 * Redirect user to other page
 *
 * @param $url = path
 *
 * @return void
 */
Ossn.redirect = function($url) {
	window.location = Ossn.site_url + $url;
};
/**
 * Setup a profile cover buttons
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.profile-cover').hover(function() {
			$('.profile-cover-controls').find('a').show();
		}, function() {
			$('.profile-cover-controls').find('a').hide();
		});
	});
});
/**
 * Setup a profile photo buttons
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.profile-photo').hover(function() {
			$('.upload-photo').slideDown();
		}, function() {
			$('.upload-photo').slideUp();
		});
	});
});
/**
 * Setup ajax request for user register
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	Ossn.ajaxRequest({
		url: Ossn.site_url + "action/user/register",
		form: '#ossn-home-signup',

		beforeSend: function(request) {
			var failedValidate = false;
			$('#ossn-submit-button').show();
			$('#ossn-home-signup .ossn-loading').addClass("ossn-hidden");

			$('#ossn-home-signup').find('#ossn-signup-errors').hide();
			$('#ossn-home-signup input').filter(function() {
				$(this).closest('span').removeClass('ossn-required');
				if (this.type == 'radio') {
					if (!$("input[name='gender']:checked").val()) {
						$(this).closest('span').addClass('ossn-required');
						failedValidate = true;
					}
				}
				if (this.value == "") {
					$(this).addClass('ossn-red-borders');
					failedValidate = true;
					request.abort();
					return false;
				}
			});
			if (failedValidate == false) {
				$('#ossn-submit-button').hide();
				$('#ossn-home-signup .ossn-loading').removeClass("ossn-hidden");
			}
		},
		callback: function(callback) {
			if (callback['dataerr']) {
				$('#ossn-home-signup').find('#ossn-signup-errors').html(callback['dataerr']).fadeIn();
				$('#ossn-submit-button').show();
				$('#ossn-home-signup .ossn-loading').addClass("ossn-hidden");
			} else if (callback['success'] == 1) {
				$('#ossn-home-signup').html(Ossn.MessageDone(callback['datasuccess']));
			} else {
				$('#ossn-home-signup .ossn-loading').addClass("ossn-hidden");
				$('#ossn-submit-button').attr('type', 'submit')
				$('#ossn-submit-button').attr('style', 'opacity:1;');
			}
		}
	});
});
/**
 * Setup system messages
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		if ($('.ossn-system-messages').find('a').length) {
			$('.ossn-system-messages').find('.ossn-system-messages-inner').show();
			$('.ossn-system-messages').find('.ossn-system-messages-inner').animate({
				opacity: 0.9
			}, 10000, function() {
				$('.ossn-system-messages').find('.ossn-system-messages-inner').empty();
			}).slideUp('slow');
		}
	});
});
/**
 * Add a system messages for users
 *
 * @param string $messages Message for user
 * @param string $type Message type success (default) or error
 *
 * @return void
 */
Ossn.trigger_message = function($message, $type) {
	$type = $type || 'success';
	if ($type == 'error') {
		//compitable to bootstrap framework
		$type = 'danger';
	}
	if ($message == '') {
		return false;
	}
	$html = "<div class='alert alert-" + $type + "'><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>" + $message + "</div>";
	$('.ossn-system-messages').find('.ossn-system-messages-inner').append($html);
	if ($('.ossn-system-messages').find('.ossn-system-messages-inner').is(":not(:visible)")) {
		$('.ossn-system-messages').find('.ossn-system-messages-inner').slideDown('slow');
	}
	$('.ossn-system-messages').find('.ossn-system-messages-inner').animate({
		opacity: 0.9
	}, 10000, function() {
		$('.ossn-system-messages').find('.ossn-system-messages-inner').empty();
	}).slideUp('slow');
};

/**
 * Topbar dropdown button
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-topbar-dropdown-menu-button').click(function() {
			if ($('.ossn-topbar-dropdown-menu-content').is(":not(:visible)")) {
				$('.ossn-topbar-dropdown-menu-content').show();
			} else {
				$('.ossn-topbar-dropdown-menu-content').hide();
			}
		});

	});
});
/**
 * Show exception on component delete
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		//show a confirmation mssage before delete component #444
		$('.ossn-com-delete-button').click(function(e) {
			e.preventDefault();
			var del = confirm(Ossn.Print('ossn:component:delete:exception'));
			if (del == true) {
				var actionurl = $(this).attr('href');
				window.location = actionurl;
			}
		});
	});
});
/**
 * Show exception , are you sure?
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.ossn-make-sure').click(function(e) {
			e.preventDefault();
			var del = confirm(Ossn.Print('ossn:exception:make:sure'));
			if (del == true) {
				var actionurl = $(this).attr('href');
				window.location = actionurl;
			}
		});
	});
});
/**
 * Show exception on user delete
 *
 * @return void
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		$('.userdelete').click(function(e) {
			e.preventDefault();
			var del = confirm(Ossn.Print('ossn:user:delete:exception'));
			if (del == true) {
				var actionurl = $(this).attr('href');
				window.location = actionurl;
			}

		});
	});
});
/**
 * Close a Ossn message box
 *
 * @return void
 */
Ossn.MessageBoxClose = function() {
	$('.ossn-message-box').hide();
	$('.ossn-halt').removeClass('ossn-light').hide();
	$('.ossn-halt').attr('style', '');

};
/**
 * Load Message box
 *
 * @return void
 */
Ossn.MessageBox = function($url) {
	Ossn.PostRequest({
		url: Ossn.site_url + $url,
		beforeSend: function() {
			$('.ossn-halt').addClass('ossn-light');
			$('.ossn-halt').attr('style', 'height:' + $(document).height() + 'px;');
			$('.ossn-halt').show();
			$('.ossn-message-box').html('<div class="ossn-loading ossn-box-loading"></div>');
			$('.ossn-message-box').fadeIn('slow');
		},
		callback: function(callback) {
			$('.ossn-message-box').html(callback).fadeIn();
		},
	});

};
/**
 * Load a media viewer
 *
 * @return void
 */
Ossn.Viewer = function($url) {
	Ossn.PostRequest({
		url: Ossn.site_url + $url,

		beforeSend: function() {
			$('.ossn-halt').removeClass('ossn-light');
			$('.ossn-halt').show();
			$('.ossn-viewer').html('<table class="ossn-container"><tr><td class="image-block" style="text-align: center;width:100%;"><div class="ossn-viewer-loding">Loading...</div></td></tr></table>');
			$('.ossn-viewer').show();
		},
		callback: function(callback) {
			$('.ossn-viewer').html(callback).show();
		},
	});
};
/**
 * Close a media viewer
 *
 * @return void
 */
Ossn.ViewerClose = function($url) {
	$('.ossn-halt').addClass('ossn-light');
	$('.ossn-halt').hide();
	$('.ossn-viewer').html('');
	$('.ossn-viewer').hide();
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
 * Get url paramter
 *
 * @param name Parameter name;
 *        url complete url
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
 * Add action token to url
 *
 * @param string data Full complete url
 */
Ossn.AddTokenToUrl = function(data) {
	// 'http://example.com?data=sofar'
	if (typeof data === 'string') {
		// is this a full URL, relative URL, or just the query string?
		var parts = Ossn.ParseUrl(data),
			args = {},
			base = '';

		if (parts['host'] === undefined) {
			if (data.indexOf('?') === 0) {
				// query string
				base = '?';
				args = Ossn.ParseStr(parts['query']);
			}
		} else {
			// full or relative URL
			if (parts['query'] !== undefined) {
				// with query string
				args = Ossn.ParseStr(parts['query']);
			}
			var split = data.split('?');
			base = split[0] + '?';
		}
		args["ossn_ts"] = Ossn.Config.token.ossn_ts;
		args["ossn_token"] = Ossn.Config.token.ossn_token;

		return base + jQuery.param(args);
	}
};
/**
 * sprintf() for JavaScript 0.7-beta1
 * http://www.diveintojavascript.com/projects/javascript-sprintf
 */
var sprintf = (function() {
	function get_type(variable) {
		return Object.prototype.toString.call(variable).slice(8, -1).toLowerCase();
	}

	function str_repeat(input, multiplier) {
		for (var output = []; multiplier > 0; output[--multiplier] = input) { /* do nothing */ }
		return output.join('');
	}

	var str_format = function() {
		if (!str_format.cache.hasOwnProperty(arguments[0])) {
			str_format.cache[arguments[0]] = str_format.parse(arguments[0]);
		}
		return str_format.format.call(null, str_format.cache[arguments[0]], arguments);
	};

	str_format.format = function(parse_tree, argv) {
		var cursor = 1,
			tree_length = parse_tree.length,
			node_type = '',
			arg, output = [],
			i, k, match, pad, pad_character, pad_length;
		for (i = 0; i < tree_length; i++) {
			node_type = get_type(parse_tree[i]);
			if (node_type === 'string') {
				output.push(parse_tree[i]);
			} else if (node_type === 'array') {
				match = parse_tree[i]; // convenience purposes only
				if (match[2]) { // keyword argument
					arg = argv[cursor];
					for (k = 0; k < match[2].length; k++) {
						if (!arg.hasOwnProperty(match[2][k])) {
							throw (sprintf('[sprintf] property "%s" does not exist', match[2][k]));
						}
						arg = arg[match[2][k]];
					}
				} else if (match[1]) { // positional argument (explicit)
					arg = argv[match[1]];
				} else { // positional argument (implicit)
					arg = argv[cursor++];
				}

				if (/[^s]/.test(match[8]) && (get_type(arg) != 'number')) {
					throw (sprintf('[sprintf] expecting number but found %s', get_type(arg)));
				}
				switch (match[8]) {
					case 'b':
						arg = arg.toString(2);
						break;
					case 'c':
						arg = String.fromCharCode(arg);
						break;
					case 'd':
						arg = parseInt(arg, 10);
						break;
					case 'e':
						arg = match[7] ? arg.toExponential(match[7]) : arg.toExponential();
						break;
					case 'f':
						arg = match[7] ? parseFloat(arg).toFixed(match[7]) : parseFloat(arg);
						break;
					case 'o':
						arg = arg.toString(8);
						break;
					case 's':
						arg = ((arg = String(arg)) && match[7] ? arg.substring(0, match[7]) : arg);
						break;
					case 'u':
						arg = Math.abs(arg);
						break;
					case 'x':
						arg = arg.toString(16);
						break;
					case 'X':
						arg = arg.toString(16).toUpperCase();
						break;
				}
				arg = (/[def]/.test(match[8]) && match[3] && arg >= 0 ? '+' + arg : arg);
				pad_character = match[4] ? match[4] == '0' ? '0' : match[4].charAt(1) : ' ';
				pad_length = match[6] - String(arg).length;
				pad = match[6] ? str_repeat(pad_character, pad_length) : '';
				output.push(match[5] ? arg + pad : pad + arg);
			}
		}
		return output.join('');
	};

	str_format.cache = {};

	str_format.parse = function(fmt) {
		var _fmt = fmt,
			match = [],
			parse_tree = [],
			arg_names = 0;
		while (_fmt) {
			if ((match = /^[^\x25]+/.exec(_fmt)) !== null) {
				parse_tree.push(match[0]);
			} else if ((match = /^\x25{2}/.exec(_fmt)) !== null) {
				parse_tree.push('%');
			} else if ((match = /^\x25(?:([1-9]\d*)\$|\(([^\)]+)\))?(\+)?(0|'[^$])?(-)?(\d+)?(?:\.(\d+))?([b-fosuxX])/.exec(_fmt)) !== null) {
				if (match[2]) {
					arg_names |= 1;
					var field_list = [],
						replacement_field = match[2],
						field_match = [];
					if ((field_match = /^([a-z_][a-z_\d]*)/i.exec(replacement_field)) !== null) {
						field_list.push(field_match[1]);
						while ((replacement_field = replacement_field.substring(field_match[0].length)) !== '') {
							if ((field_match = /^\.([a-z_][a-z_\d]*)/i.exec(replacement_field)) !== null) {
								field_list.push(field_match[1]);
							} else if ((field_match = /^\[(\d+)\]/.exec(replacement_field)) !== null) {
								field_list.push(field_match[1]);
							} else {
								throw ('[sprintf] huh?');
							}
						}
					} else {
						throw ('[sprintf] huh?');
					}
					match[2] = field_list;
				} else {
					arg_names |= 2;
				}
				if (arg_names === 3) {
					throw ('[sprintf] mixing positional and named placeholders is not (yet) supported');
				}
				parse_tree.push(match);
			} else {
				throw ('[sprintf] huh?');
			}
			_fmt = _fmt.substring(match[0].length);
		}
		return parse_tree;
	};

	return str_format;
})();

var vsprintf = function(fmt, argv) {
	argv.unshift(fmt);
	return sprintf.apply(null, argv);
};
/**
 * Ossn Print
 * Print a langauge string
 */
Ossn.Print = function(str, args) {
	if (OssnLocale[str]) {
		if (!args) {
			return OssnLocale[str];
		} else {
			return vsprintf(OssnLocale[str], args);
		}
	}
	return str;
};
/**
 * Check if the language string is avaialble or not
 *
 * @return boolean
 */
Ossn.isLangString = function(str, args) {
	if (OssnLocale[str]) {
		return true;
	}
	return false;
};
/**
 * Get a available update version
 * 
 * @added in v3.0 
 */
Ossn.RegisterStartupFunction(function() {
	$(document).ready(function() {
		if ($('.avaiable-updates').length) {
			Ossn.PostRequest({
				url: Ossn.site_url + "administrator/version",
				action: false,
				callback: function(callback) {
					if (callback['version']) {
						$('.avaiable-updates').html(callback['version']);
					}
				}
			});
		}
	});
});
/**
 * Initialize ossn startup functions
 *
 * @return void
 */
Ossn.Init = function() {
	for (var i = 0; i <= Ossn.Startups.length; i++) {
		if (typeof Ossn.Startups[i] !== "undefined") {
			Ossn.Startups[i]();
		}
	}
};
