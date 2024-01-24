<?php
$component = new OssnComponents;
$settings = $component->getComSettings('OssnNotifications');

$auto_check = 60;	
if($settings){
	$auto_check = $settings->autocheck_time;	
}
//[E] Configure able autocheck OssnNotifications #2329
$milliseconds = intval($auto_check) * 1000; //milliseconds = seconds × 1000

?>
//<script>
$(document).ready(function() {
        setInterval(function() {
            Ossn.NotificationsCheck()
        }, <?php echo $milliseconds;?>);
});