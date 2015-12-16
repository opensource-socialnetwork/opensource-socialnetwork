 		<div id="get-recent" style="display:none;"></div>
        <div class="messages-from">
            <div class="inner">
                <?php
                if ($params['recent']) {
                    foreach ($params['recent'] as $message) {
                        if ($message->message_from == ossn_loggedin_user()->guid) {
                            $user = ossn_user_by_guid($message->message_to);
                            $text = strl($message->message, 32);
                            $replied = "<i class='fa fa-reply'></i><div class='reply-text'>{$text}</div>";
                        } else {
                            $user = ossn_user_by_guid($message->message_from);
                            $text = strl($message->message, 32);
                            $replied = "<div class='reply-text-from'>{$text}</div>";
                        }
                        if ($message->viewed == 0 && $message->message_from !== ossn_loggedin_user()->guid) {
                            $new = 'message-new';
                        } else {
                            $new = '';
                        }
                        ?>
                        <div class="row user-item <?php echo $new; ?>">
                        	<div onclick="Ossn.redirect('messages/message/<?php echo $user->username; ?>');">
								<div class="col-md-2">
 		                               <img class="image" src="<?php echo $user->iconURL()->smaller; ?>"/>
                         	   </div>    
                         	   <div class="col-md-10 data">
                         	       <div class="name"><?php echo strl($user->fullname, 17); ?></div>
                         	       <div class="time time-created"><?php echo ossn_user_friendly_time($message->time); ?> </div>
                         	       <div class="reply"><?php echo $replied; ?></div>
                            	</div>
                            </div>    
                        </div>
                    <?php
                    }

                }?>


            </div>
        </div>