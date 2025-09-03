//<script>
/**
 * Open Source Social Network
 *
 * @package   Library only for backend
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
Ossn.register_callback('ossn', 'init', 'ossn_administrator_update_widget');
Ossn.register_callback('ossn', 'init', 'ossn_component_delete_confirmation');
Ossn.register_callback('ossn', 'init', 'ossn_unvalidated_users_multiple_controller');
Ossn.register_callback('ossn', 'init', 'ossn_dcache_tests_check_before_save');

/**
 * Checks for the updates in administrator panel
 *
 * @return void
 */
function ossn_administrator_update_widget() {
	$(document).ready(function () {
		if ($('.avaiable-updates').length) {
			Ossn.PostRequest({
				url: Ossn.site_url + "administrator/version",
				action: false,
				callback: function (callback) {
					if (callback['version']) {
						$('.avaiable-updates').html(callback['version']);
					}
				}
			});
		}
	});
}

/**
 * Show exception , are you sure?
 *
 * @return void
 */
function ossn_component_delete_confirmation() {
	$(document).ready(function () {
		$('body').on('click', '.ossn-component-delete-confirm', function (e) {
			e.preventDefault();
			var actionurl = $(this).attr('href');
			var del = confirm(Ossn.Print('ossn:exception:make:sure'));
			if (del == true) {
				var keep_pref = confirm(Ossn.Print('com:pref'));
				var keep = '';
				if (keep_pref) {
					keep = '&keep_pref=1';
				}
				window.location = actionurl + '' + keep;
			}
		});
	});
}
/**
 * Multiple user delete and validate controller
 *
 * @return void
 */
function ossn_unvalidated_users_multiple_controller() {
	$(document).ready(function () {
		$('body').on('click', '.ossn-admin-unvalidated-users-check', function () {
			if ($('.ossn-admin-unvalidated-users-check:checked').length > 0) {
				$('.ossn-unvalidated-multiple-settings').removeClass('d-none');
			} else {
				$('.ossn-unvalidated-multiple-settings').addClass('d-none');
			}
		});
		$('body').on('click', '#ossn-unvalidated-multi-validate', function () {
			var msg = Ossn.Print('ossn:exception:make:sure');
			var del = confirm(Ossn.Print(msg));
			if (del == true) {
				$guids = $.map($('.ossn-admin-unvalidated-users-check:checked'), function (i) {
					return i.value;
				});
				$url = Ossn.AddTokenToUrl(Ossn.site_url + "action/admin/validate/user?guid=" + $guids.join(','));
				window.location = $url;
			}
		});
		$('body').on('click', '#ossn-unvalidated-multi-delete', function () {
			var msg = Ossn.Print('ossn:exception:make:sure');
			var del = confirm(Ossn.Print(msg));
			if (del == true) {
				$guids = $.map($('.ossn-admin-unvalidated-users-check:checked'), function (i) {
					return i.value;
				});
				$url = Ossn.AddTokenToUrl(Ossn.site_url + "action/admin/delete/user?guid=" + $guids.join(','));
				window.location = $url;
			}
		});
	});
}
/**
 * Dynamic cache tests check before save
 *
 * @return void
 */
function ossn_dcache_tests_check_before_save() {
	$(document).ready(function() {
		$('body').on('click', '#dcache-form-submit', function(e) {
			var form = $('.ossn-admin-dcache-settings-form');

			var type = form.find('select[name="cache_server_type"]').val();
			var host = form.find('input[name="host"]').val();
			var port = form.find('input[name="port"]').val();
			var user = form.find('input[name="username"]').val();
			var password = form.find('input[name="password"]').val();

			ossn_admin_dynamic_cache_check(type, host, port, user, password, function(status) {
				var failed = '<span class="badge bg-danger">Failed</span>';
				var passed = '<span class="badge bg-success">Passed</span>';
				if (status == 1) {
					switch (type) {
						case 'redis':
							$('#dcache-redis-status').html(passed);
							break;
						case 'memcached':
							$('#dcache-memcached-status').html(passed);
							break;
					}
					form.submit();
				} else {
					switch (type) {
						case 'redis':
							$('#dcache-redis-status').html(failed);
							break;
						case 'memcached':
							$('#dcache-memcached-status').html(failed);
							break;
					}
					Ossn.trigger_message(Ossn.Print('admin:dcache:errorconnection'), 'error');
				}
			});
		});
	});
}
/**
 * Dynamic cache check for tests
 * 
 * @param string type memcached|redis
 * @param string host Cache server host name
 * @param string port Port number
 * @param string user User for auth if any
 * @param string password if user provided ,  then apply password if any
 * @param function cb Callback 
 * 
 * @return void
 */
function ossn_admin_dynamic_cache_check(type, host, port, user, password, cb) {
	Ossn.PostRequest({
		url: Ossn.site_url + 'action/admin/dynamic/cache/test',
		params: 'cache_server_type=' + type + '&host=' + host + '&port=' + port + '&username=' + user + '&password=' + password,
		beforeSend: function() {
			var loading = '<div class="ossn-loading"></div>';
			if (type == 'redis') {
				$('#dcache-redis-status').html(loading);
			}
			if (type == 'memcached') {
				$('#dcache-memcached-status').html(loading);
			}
		},
		callback: function($c) {
			cb($c);
		},
	});
} 