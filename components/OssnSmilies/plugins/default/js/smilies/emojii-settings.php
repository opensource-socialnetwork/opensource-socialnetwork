<script>
<?php
$component = new OssnComponents;
$settings = $component->getComSettings('OssnSmilies');
if($settings && $settings->close_anywhere == 'on'){
?>
	$(document).ready(function() {
		$('body').on('click', function(e) {
			if($('#master-moji .emojii-container-main').is(':visible') && e.target.className != 'ossn-chat-icon-smile' && e.target.className != 'fa fa-smile'  && e.target.className != 'emojii' && e.target.innerHTML != '😉') {
				$('#master-moji .emojii-container-main').hide();
				$('.ossn-halt').hide();
			}
		});
	});
<?php
}
?>
</script>