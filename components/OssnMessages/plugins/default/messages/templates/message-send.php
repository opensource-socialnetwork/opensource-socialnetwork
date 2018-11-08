<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$user = $params['user'];
$message = ossn_message_print($params['message']);
$message_id = $params['message_id'];
if($user->guid == ossn_loggedin_user()->guid){
					?>
                    	<div class="row" id="message-item-<?php echo $message_id ?>">
                                <div class="col-md-10">
                                	<div class="message-box-sent text">
						<span><?php echo ossn_call_hook('messages', 'message:smilify', null, ossn_message_print($message)); ?></span>
                                        	<div class="time-created"><?php echo ossn_user_friendly_time(time());?>
                                            		<a class="ossn-message-delete" href="<?php echo ossn_site_url("action/message/delete?id={$message_id}", true);?>"><i class="fa fa-times"></i></a>				
						</div>
                                	</div>
                                </div>
                        	<div class="col-md-2">
                                	<a href="<?php echo $user->profileURL();?>"><img  class="user-icon" src="<?php echo $user->iconURL()->small;?>" /></a>
                                </div>                                
                        </div>
                    <?php	
					} else {
						?>
                    	<div class="row" id="message-item-<?php echo $message_id ?>">
                        	<div class="col-md-2">
                                	<a href="<?php echo $user->profileURL();?>"><img  class="user-icon" src="<?php echo $user->iconURL()->small;?>" /></a>
                                </div>                                
                                <div class="col-md-10">
                                	<div class="message-box-recieved text">
						<?php echo ossn_call_hook('messages', 'message:smilify', null, ossn_message_print($message)); ?>
                                        	<div class="time-created"><?php echo ossn_user_friendly_time(time());?></div>    
                                        </div>
                                </div>
                        </div>                       
                        <?php
					}
