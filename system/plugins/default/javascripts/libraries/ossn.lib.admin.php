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
/**
 * Checks for the updates in administrator panel
 *
 * @return void
 */
function ossn_administrator_update_widget(){
	$(document).ready(function(){
		if($('.avaiable-updates').length){
			Ossn.PostRequest({
				url: Ossn.site_url + "administrator/version",
				action: false,
				callback: function(callback){
					if(callback['version']){
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
function ossn_component_delete_confirmation(){
	$(document).ready(function(){
		$('body').on('click', '.ossn-component-delete-confirm', function(e){
			e.preventDefault();
			var actionurl = $(this).attr('href');
			var del = confirm(Ossn.Print('ossn:exception:make:sure'));
			if(del == true){
				var keep_pref = confirm(Ossn.Print('com:pref'));
				var keep = '';
				if(keep_pref){
						keep = '&keep_pref=1';	
				}
				window.location = actionurl+''+keep;
			}
		});
	});
}