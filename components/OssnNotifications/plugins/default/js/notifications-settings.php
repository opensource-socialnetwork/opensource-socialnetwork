<script>
<?php
$component = new OssnComponents;
$settings = $component->getComSettings('OssnNotifications');
if($settings && $settings->close_anywhere == 'on'){
?>
$(document).ready(function() {
	$('body').click(function(e){
		var clicked_target = e.target.className.substring(0, 6);
		if (clicked_target != 'btn bt' && clicked_target != 'ossn-n' && clicked_target != 'ossn-i' && clicked_target != 'fa fa-') {
			Ossn.NotificationBoxClose();
			$('.ossn-notifications-notification').attr('onClick', 'Ossn.NotificationShow(this)');
			$('.ossn-notifications-messages').attr('onClick', 'Ossn.NotificationMessagesShow(this)');
			$('.ossn-notifications-friends').attr('onClick', 'Ossn.NotificationFriendsShow(this)');
		}
	});
});
<?php
}
?>
</script>
