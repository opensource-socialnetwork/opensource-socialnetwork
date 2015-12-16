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
if (isset($params['user']->guid)) {
    ?>
    <div class="ossn-messages">
        <div id="get-recent" style="display:none;"></div>
        <div class="messages-from">
            <div class="title">
            <a href="<?php echo ossn_site_url();?>messages/all"><?php echo ossn_print('inbox'); ?>
                    (<?php echo OssnMessages()->countUNREAD(ossn_loggedin_user()->guid); ?>) </a>
            </div>
            <div class="inner">
                <?php
                if ($params['recent']) {
                    foreach ($params['recent'] as $message) {
                        if ($message->message_from == ossn_loggedin_user()->guid) {
                            $user = ossn_user_by_guid($message->message_to);
                            $text = strl($message->message, 19);
                            $replied = "<div class='ossn-arrow-back'></div><div class='reply-text'>{$text}</div>";
                        } else {
                            $user = ossn_user_by_guid($message->message_from);
                            $text = strl($message->message, 19);
                            $replied = "<div class='reply-text-from'>{$text}</div>";
                        }
                        if ($message->viewed == 0 && $message->message_from !== ossn_loggedin_user()->guid) {
                            $new = 'message-new';
                        } else {
                            $new = '';
                        }
                        ?>
                        <div class="user-item <?php echo $new; ?>"
                                                      onclick="Ossn.redirect('messages/message/<?php echo $user->username; ?>');">

                            <div class="image"><img
                                    src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/small"/>
                            </div>
                            <div class="data">
                                <div class="name"><?php echo strl($user->fullname, 17); ?></div>
                                <br/>

                                <div class="reply"><?php echo $replied; ?></div>
                                <div class="time"><?php echo ossn_user_friendly_time($message->time); ?> </div>
                            </div>
                        </div>
                    <?php
                    }

                }?>


            </div>
        </div>

        <div class="message-with">
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
            <div class="title"> <?php echo $params['user']->fullname; ?></div>
            <div class="messages-inner" id="message-append-<?php echo $params['user']->guid; ?>">
                <?php
                if ($params['data']) {
                    foreach ($params['data'] as $message) {
                        $user = ossn_user_by_guid($message->message_from);
                        ?>
                        <div class="message-item">
                            <img src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/smaller"/>

                            <div class="data">
                                <div class="name"><a href="<?php echo $user->profileURL(); ?>"><?php echo $user->fullname; ?></a></div>
                                <div class="text">
  							  <?php
                                if (class_exists('OssnChat')) {
                                    echo OssnChat::replaceIcon(ossn_message_print($message->message));
                                } else {
                                    echo ossn_message_print($message->message);
                                }
                                ?>                                
                                 </div>
                            </div>
                        </div>
                    <?php
                    }
                }?>
            </div>

            <div class="message-form">
                <form action="#" class="message-form-form" id="message-send-<?php echo $params['user']->guid; ?>"
                      method="post">
                    <textarea name="message" placeholder="<?php echo ossn_print('message:placeholder'); ?>"></textarea>
                    <input type="hidden" name="to" value="<?php echo $params['user']->guid; ?>"/>

                    <div class="controls">
                    <?php 
                    //this form should be in OssnMessages/forms 
                    echo ossn_plugin_view('input/security_token'); 
                    ?>         
                        <div class="ossn-loading ossn-hidden"></div>           
                        <input type="submit" value="<?php echo ossn_print('send'); ?>"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <audio id="ossn-chat-sound" src="<?php echo ossn_site_url("components/OssnMessages/sound/pling.mp3"); ?>"
           preload="auto"></audio>
<?php } ?>
