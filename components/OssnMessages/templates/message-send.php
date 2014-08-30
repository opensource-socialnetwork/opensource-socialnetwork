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
	$user = $params['user'];
	$message = $params['message']
	?>
    <div class="message-item">
       <img src="<?php echo ossn_site_url();?>avatar/<?php echo  $user->username;?>/smaller" />
       <div class="data">
         <div class="name"><a href=""><?php echo $user->fullname;?></a></div>
         <div class="text"> <?php echo $message;?> </div>
       </div>
    </div>   