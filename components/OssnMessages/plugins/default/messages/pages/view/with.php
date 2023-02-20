<script>
	Ossn.SendMessage(<?php echo $params['user']->guid;?>);
	        $(document).ready(function () {
	            setInterval(function () {
	                Ossn.getMessages('<?php echo $params['user']->username;?>', '<?php echo $params['user']->guid;?>');
	                //Ossn.getRecent('<?php echo $params['user']->guid;?>');
	            }, 5000);
	           	Ossn.message_scrollMove(<?php echo $params['user']->guid;?>);
	  });
</script>
<div class="message-with">
	<div class="message-inner" id="message-append-<?php echo $params['user']->guid; ?>" data-guid='<?php echo $params['user']->guid; ?>'>
		<?php
			if(isset($params['countm'])){
					$params['count'] = $params['countm'];	
			}
			echo ossn_view_pagination($params['count'], 10, array(
										'offset_name' => 'offset_message_xhr_with',															 
			));
			if ($params['data']) {
			                foreach ($params['data'] as $message) {
								//reduce query
								if($message->message_from ==  $params['user']->guid){
										$user =  $params['user'];	
								} else {
				                    $user = ossn_loggedin_user();
								}
								$deleted = false;
								$class = '';
								if(isset($message->is_deleted) && $message->is_deleted == true){
											$deleted = true;
											$class = ' ossn-message-deleted';
								}
								$args = array(
										'instance' => (clone $message),
										'view_type' => 'messages/pages/view/with',
								);
								if($user->guid == ossn_loggedin_user()->guid){
								?>
		<div class="row" id="message-item-<?php echo $message->id ?>">
			<div class="col-md-12 pull-right">
				<div class="message-box-sent text<?php echo $class;?>">
					<?php if($deleted){ ?>
					<span><i class="fa fa-times-circle"></i><?php echo ossn_print('ossnmessages:deleted');?></span>
					<a class="ossn-message-delete" data-id= '<?php echo $message->id;?>' data-href="<?php echo ossn_site_url("action/message/delete?id={$message->id}", true);?>"><i class="fa fa-ellipsis-h"></i></a>				                    
					<?php } else { ?>
					<span><?php echo ossn_call_hook('messages', 'message:smilify', $args, ossn_message_print($message->message)); ?></span>
					<div class="time-created"><?php echo ossn_user_friendly_time($message->time);?></div>
					<a class="ossn-message-delete" data-id= '<?php echo $message->id;?>' data-href="<?php echo ossn_site_url("action/message/delete?id={$message->id}", true);?>"><i class="fa fa-ellipsis-h"></i></a>	
                      <?php
							echo ossn_plugin_view('messages/attachment', array(
									'instance' => $message,										  
							));
						?>                    			
					<?php } ?>                                            
				</div>
			</div>
		</div>
		<?php	
			} else {
				?>
		<div class="row" id="message-item-<?php echo $message->id ?>">
			<div class="col-md-12 pull-left">
				<div class="message-box-recieved text <?php echo $class;?>">
					<?php if($deleted){ ?>
						<span><i class="fa fa-times-circle"></i><?php echo ossn_print('ossnmessages:deleted');?></span>
					<a class="ossn-message-delete" data-id= '<?php echo $message->id;?>' data-href="<?php echo ossn_site_url("action/message/delete?id={$message->id}", true);?>"><i class="fa fa-ellipsis-h"></i></a>				                                            
						<?php } else { ?>
						<span><?php echo ossn_call_hook('messages', 'message:smilify', $args, ossn_message_print($message->message)); ?></span>
						<div class="time-created"><?php echo ossn_user_friendly_time($message->time);?></div>
					<a class="ossn-message-delete" data-id= '<?php echo $message->id;?>' data-href="<?php echo ossn_site_url("action/message/delete?id={$message->id}", true);?>"><i class="fa fa-ellipsis-h"></i></a>			
                      <?php
							echo ossn_plugin_view('messages/attachment', array(
									'instance' => $message,										  
							));
						?>                    	                                            
					<?php } ?>
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
<?php
echo ossn_view_form('send', array(
	'component' => 'OssnMessages',
	'class' => 'message-form-form',
	'id' => "message-send-{$params['user']->guid}",
	'params' => $params
), false);
