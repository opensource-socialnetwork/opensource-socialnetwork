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
 $friend = $params['entity'];
?>
 <div class="friends-list-item" onClick="Ossn.ChatnewTab(<?php echo $friend->guid;?>);"> 
            <div class="friends-item-inner">
                  <div class="icon"><img src="<?php echo $params['icon'];?>" /></div>
                  <div class="name"><?php echo strl($friend->fullname, 15);?></div> 
                  <div class="ossn-chat-icon-online"></div> 
            </div>       
 </div>