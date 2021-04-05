<?php
if($params['viewed'] !== NULL) {
		$viewed = '';
} elseif($params['viewed'] == NULL) {
		$viewed = 'class="ossn-notification-unviewed"';
}
				
$url               = $params['url'];
$baseurl           = ossn_site_url();
$notification_read = "{$baseurl}notification/read/{$params['guid']}?notification=" . urlencode($url);
?>
<a href='<?php echo $notification_read;?>'>
		<li <?php echo $viewed;?>> 
			<div class='notification-image'>
				<img src='<?php echo $params['iconURL'];?>' />
			</div>
			<div class='notfi-meta'>
				<div class='ossn-notification-icon-<?php echo $params['icon_type'];?>'></div>
				<div class='data'>
                	<?php 
					echo ossn_print("ossn:notifications:{$params['type']}", array(
						'<strong>'.$params['fullname'].'</strong>',
					));
					?>
				</div>
		   </div>
		</li>
</a>