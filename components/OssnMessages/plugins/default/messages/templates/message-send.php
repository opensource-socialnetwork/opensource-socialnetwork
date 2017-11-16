<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$user = $params['user'];
$message = ossn_message_print($params['message']);
$message_id=$params['message_id'];
if($user->guid == ossn_loggedin_user()->guid){
					?>
                    	<div class="row">
                                <div class="col-md-10">
                                		<div class="message-box-sent text" id="ossn-message-item-<?php echo $message_id;?>" data-id="<?php echo $message_id;?>" >
                                			<?php
                               					 if (function_exists('smilify')) {
                                					    echo smilify($message);
                             					   } else {
                                					    echo ossn_message_print($message);
                            					    }
                              				?>
											<a href="#" title="<?php echo ossn_print('delete:message'); ?>" class="message-action"><i class="fa fa-times"></i></a>
                                            <div class="time-created"><?php echo ossn_user_friendly_time(time());?></div>
                                        </div>
                                </div>
                        		<div class="col-md-2">
                                	<a href="<?php echo $user->profileURL();?>"><img  class="user-icon" src="<?php echo $user->iconURL()->small;?>" /></a>
                                </div>                                
                        </div>
                    <?php	
					} else {
						?>
                    	<div class="row">
                        		<div class="col-md-2">
                                	<a href="<?php echo $user->profileURL();?>"><img  class="user-icon" src="<?php echo $user->iconURL()->small;?>" /></a>
                                </div>                                
                                <div class="col-md-10">
                                		<div class="message-box-recieved text" id="ossn-message-item-<?php echo $message_id;?>" data-id="<?php echo $message_id;?>" >
                                			<?php
                               					 if (function_exists('smilify')) {
                                					    echo smilify($message);
                             					   } else {
                                					    echo $message;
                            					    }
                              				?>
										 <a href="#" title="<?php echo ossn_print('delete:message'); ?>" class="message-action"><i class="fa fa-times"></i></a>
                                         <div class="time-created"><?php echo ossn_user_friendly_time(time());?></div>    
                                        </div>
                                </div>
                        </div>                       
                        <?php
					}
