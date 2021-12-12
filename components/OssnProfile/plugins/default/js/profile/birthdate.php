//<script>
Ossn.register_callback('ossn', 'init', 'ossn_profile_birthdate_picker');
function ossn_profile_birthdate_picker(){
	$(document).ready(function(){
		var cYear = (new Date).getFullYear();
		var alldays = Ossn.Print('datepicker:days');
		var shortdays = alldays.split(",");
		var allmonths = Ossn.Print('datepicker:months');
		var shortmonths = allmonths.split(",");

		var datepick_args = {
			changeMonth: true,
			changeYear: true,
			dateFormat: 'dd/mm/yy',
			yearRange: '1900:' + cYear,
		};

		if (Ossn.isLangString('datepicker:days')) {
			datepick_args['dayNamesMin'] = shortdays;
		}
		if (Ossn.isLangString('datepicker:months')) {
			datepick_args['monthNamesShort'] = shortmonths;
		}
		var args = Ossn.call_hook('profile', 'birthdate:input', null, datepick_args);	
		$("input[name='birthdate']").datepicker(args);
		$('.ui-datepicker').addClass('notranslate');
	});
}
