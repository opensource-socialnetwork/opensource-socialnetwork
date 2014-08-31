<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
 ?>
    <div class="messages-inner">

<div class="ossn-notification-messages">
   <?php foreach($params['recent'] as $message){
	     if($message->message_from == ossn_loggedin_user()->guid){
   	       $user = ossn_user_by_guid($message->message_to);
		   $text =  sttl($message->message, 55);
		   $replied = "<div class='ossn-arrow-back'></div><div class='reply-text'>{$text}</div>";
	      } else {
   	       $user = ossn_user_by_guid($message->message_from);
		   $text =  sttl($message->message, 60);
		   $replied = "<div class='reply-text-from'>{$text}</div>";
		  }
		 if($message->viewed == 0 && $message->message_from !== ossn_loggedin_user()->guid){
		    $new = 'message-new'; 
		 } else { $new = ''; }
   ?>
    <div class="user-item <?php echo $new;?>" onclick="Ossn.redirect('messages/message/<?php echo $user->username;?>');">
      <div class="user-item-inner">
     <div class="image"><img src="<?php echo ossn_site_url();?>avatar/<?php echo $user->username;?>/small" /></div>
     <div class="data">
      <div class="name"><?php echo sttl($user->fullname, 17);?></div><br />
      <div class="reply"><?php echo $replied;?></div>
       <div class="time"><?php echo ossn_user_friendly_time($message->time); ?> </div>
       </div>
      </div>
    </div> 
     <?php } ?>

 </div>
 </div>
     <div class="bottom-all">
     <a href="#">See All</a>
    </div>