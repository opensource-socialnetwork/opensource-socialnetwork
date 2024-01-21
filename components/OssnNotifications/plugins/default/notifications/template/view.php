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
					if(!isset($params['customprint'])){
						echo ossn_print("ossn:notifications:{$params['type']}", array(
							'<strong>'.$params['fullname'].'</strong>',
						));
					} else {
						echo $params['customprint'];	
					}
					?>
                    <?php if(isset($params['instance'])){ ?>
                    <span class="time-created" title="<?php echo date('d/m/Y', $params['instance']->time_created);?>"><?php echo ossn_user_friendly_time($params['instance']->time_created); ?></span>
                    <?php } ?>
				</div>
		   </div>
		</li>
</a>