<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$user = $params['user'];
$message = ossn_message_print($params['message']);
if($user->guid == ossn_loggedin_user()->guid){
					?>
                    	<div class="row">
                                <div class="col-md-10">
                                		<div class="message-box-sent text">
                                			<?php
                               					 if (class_exists('OssnChat')) {
                                					    echo OssnChat::replaceIcon(ossn_message_print($message));
                             					   } else {
                                					    echo ossn_message_print($message);
                            					    }
                              				?>
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
                                		<div class="message-box-recieved text">
                                			<?php
                               					 if (class_exists('OssnChat')) {
                                					    echo OssnChat::replaceIcon($message);
                             					   } else {
                                					    echo $message;
                            					    }
                              				?>
                                         <div class="time-created"><?php echo ossn_user_friendly_time(time());?></div>    
                                        </div>
                                </div>
                        </div>                       
                        <?php
					}