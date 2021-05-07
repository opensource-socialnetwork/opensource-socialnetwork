//<script>
/**
 * RawCookie setrawcookie — Send a cookie without urlencoding the cookie value
 * https://www.php.net/manual/en/function.setrawcookie.php
 *
 * @param name Key name
 * @param value cookie value
 * @param epxires Date object
 * @param path The path on the server in which the cookie will be available on. If set to '/', the cookie will be available within the entire domain.
 * @param domain The domain hostname if not specified it will be current hostname 
 * @param secure Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client. When set to true, the cookie will only be set if a secure connection exists.
 * 
 * @return boolean
 */
Ossn.setrawcookie = function(name, value, expires, path, domain, secure) {
	if (typeof expires === 'string' && (/^\d+$/).test(expires)) {
		expires = parseInt(expires, 10)
	}

	if (expires instanceof Date) {
		expires = expires.toUTCString()
	} else if (typeof expires === 'number') {
		expires = (new Date(expires * 1e3))
			.toUTCString()
	}

	var r = [name + '=' + value],
		s = {},
		i = ''
	s = {
		expires: expires,
		path: path,
		domain: domain
	}
	for (i in s) {
		if (s.hasOwnProperty(i)) {
			// Exclude items on Object.prototype
			s[i] && r.push(i + '=' + s[i])
		}
	}

	return secure && r.push('secure'), window.document.cookie = r.join(';'), true
};

/**
 * setcookie — Send a cookie
 * https://www.php.net/manual/en/function.setcookie.php
 *
 * @param name Key name
 * @param value cookie value
 * @param epxires Date object
 * @param path The path on the server in which the cookie will be available on. If set to '/', the cookie will be available within the entire domain.
 * @param domain The domain hostname if not specified it will be current hostname 
 * @param secure Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client. When set to true, the cookie will only be set if a secure connection exists.
 * 
 * @return boolean
 */
Ossn.setCookie = function(name, value, expires, path, domain, secure) {
	//https://github.com/locutusjs/locutus/
	//Ossn.setcookie('Key', 'Value');
	return Ossn.setrawcookie(name, encodeURIComponent(value), expires, path, domain, secure)
};

/**
 * getCookie
 *
 * @param name Key name
 * 
 * @return mixed
 */
Ossn.getCookie = function(name) {
	// original by: http://www.quirksmode.org/js/cookies.html
	// example 1: var $myVar = Ossn.getCookie('test');
	var i = 0,
		c = '',
		nameEQ = name + '=',
		ca = document.cookie.split(';'),
		cal = ca.length;
	for (i = 0; i < cal; i++) {
		c = ca[i].replace(/^ */, '');
		if (c.indexOf(nameEQ) === 0) {
			return decodeURIComponent(c.slice(nameEQ.length).replace(/\+/g, '%20'));
		}
	}
	return null;
};