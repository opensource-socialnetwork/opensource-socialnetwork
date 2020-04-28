<script>
<?php
$component = new OssnComponents;
$settings = $component->getComSettings('OssnSmilies');
if($settings && $settings->close_anywhere == 'on'){
?>
	$(document).ready(function() {
		$('body').click(function(e) {
			if($('#master-moji .emojii-container-main').is(':visible') && e.target.className != 'ossn-chat-icon-smile' && e.target.className != 'fa fa-smile-o'  && e.target.className != 'emojii' && e.target.innerHTML != '😉') {
				$('#master-moji .emojii-container-main').hide();
			}
		});
	});
<?php
}
?>
</script>