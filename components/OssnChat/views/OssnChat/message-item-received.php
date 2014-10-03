<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
 ?>
   <div class="message-reciever">
                 <div class="user-icon">
                 <img src="<?php echo $params['reciever']->iconURL()->smaller;?>" />
                 </div>
                 <div class="ossn-chat-text-data">
                       <div class="ossn-chat-triangle ossn-chat-triangle-white"></div>
                       <div class="text">
                           <div class="inner" title="<?php echo OssnChat::messageTime($params['time']);?>">
                               <?php echo OssnChat::replaceIcon($params['message']);?>
                          </div>
                       </div>
                 </div>
           </div>  