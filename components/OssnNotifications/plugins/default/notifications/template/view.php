<?php
if($params['viewed'] !== null) {
		$viewed = '';
} elseif($params['viewed'] == null) {
		$viewed = 'class="ossn-notification-unviewed"';
}

$baseurl    = ossn_site_url();
$urlencoded = '';
if(isset($params['url'])) {
		$url        = $params['url'];
		$urlencoded = '?notification=' . urlencode($url);
}
$notification_read = "{$baseurl}notification/read/{$params['guid']}{$urlencoded}";
?>
<li <?php echo $viewed;?> id="ossn-notification-item-<?php echo $params['instance']->guid;?>"> 
	<a href='<?php echo $notification_read;?>' class="d-flex ossn-notification-item-a">
		<div class='notification-image me-2'>
			<img src='<?php echo $params['iconURL'];?>' />
		</div>
		<div class='notfi-meta position-relative w-100'>
			<div class='ossn-notification-icon-<?php echo $params['icon_type'];?>'></div>
			<div class='data'>
				<?php 
				if (!isset($params['customprint'])) {
					echo ossn_print("ossn:notifications:{$params['type']}", array(
						'<strong>'.$params['fullname'].'</strong>',
					));
				} else {
					echo $params['customprint'];	
				}
				?>
				<?php if (isset($params['instance'])) { ?>
					<span class="time-created" title="<?php echo date('d/m/Y', $params['instance']->time_created);?>">
						<?php echo ossn_user_friendly_time($params['instance']->time_created); ?>
					</span>
				<?php } ?>
			</div>
            <div class="ossn-notif-delete-item text-danger" data-guid="<?php echo $params['instance']->guid;?>"><i class="fa fa-trash"></i></div>
		</div>
	</a>
</li>