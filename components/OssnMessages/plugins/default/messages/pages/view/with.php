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
<div class="message-inner" id="message-append-<?php echo $params['user']->guid; ?>">
<?php
if ($params['data']) {
                foreach ($params['data'] as $message) {
                    $user = ossn_user_by_guid($message->message_from);
					if($user->guid == ossn_loggedin_user()->guid){
					?>
                    	<div class="row">
                                <div class="col-md-10">
                                		<div class="message-box-sent text">
                                			<?php
                               					 if (function_exists('smilify')) {
                                					    echo smilify(ossn_message_print($message->message));
                             					   } else {
                                					    echo ossn_message_print($message->message);
                            					    }
                              				?>
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
                                			<?php
                               					 if (function_exists('smilify')) {
                                					    echo smilify(ossn_message_print($message->message));
                             					   } else {
                                					    echo ossn_message_print($message->message);
                            					    }
                              				?>
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
        <?php
			echo ossn_view_form('send', array(
					'component' => 'OssnMessages',
					'class' => 'message-form-form',
					'id' => "message-send-{$params['user']->guid}",
					'params' => $params
			), false);
		?>