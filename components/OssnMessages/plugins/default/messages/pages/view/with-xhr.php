<div class="message-with">
<div class="message-inner" id="message-append-<?php echo $params['user']->guid; ?>" data-guid='<?php echo $params['user']->guid; ?>'>
<?php
echo ossn_view_pagination($params['count'], 10, array(
	'offset_name' => 'offset_message_xhr_with',															 
));
if ($params['data']) {
                foreach ($params['data'] as $message) {
                    $user = ossn_user_by_guid($message->message_from);
					if($user->guid == ossn_loggedin_user()->guid){
					?>
                    	<div class="row">
                                <div class="col-md-10">
                                	<div class="message-box-sent text">
						<?php echo ossn_call_hook('messages', 'message:smilify', null, ossn_message_print($message->message)); ?>
                                        	<div class="time-created"><?php echo ossn_user_friendly_time($message->time);?></div>    
                                        </div>
                                </div>
                        	<div class="col-md-2">
                                	<img  class="user-icon" src="<?php echo $user->iconURL()->small;?>" />
                                </div>                                
                        </div>
                    <?php	
					} else {
						?>
                    	<div class="row">
                        	<div class="col-md-2">
                                	<img  class="user-icon" src="<?php echo $user->iconURL()->small;?>" />
                                </div>                                
                                <div class="col-md-10">
                                	<div class="message-box-recieved text">
						<?php echo ossn_call_hook('messages', 'message:smilify', null, ossn_message_print($message->message)); ?>
                                        	<div class="time-created"><?php echo ossn_user_friendly_time($message->time);?></div>                                                
                                        </div>
                                </div>
                        </div>                       
                        <?php
					}
				}
}
?>
</div>
</div>
