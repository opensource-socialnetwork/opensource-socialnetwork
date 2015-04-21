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
?>
<div class="message-item">
    <img src="<?php echo ossn_site_url(); ?>avatar/<?php echo $user->username; ?>/smaller"/>

    <div class="data">
        <div class="name"><a href=""><?php echo $user->fullname; ?></a></div>
        <div class="text"> <?php echo $message; ?> </div>
    </div>
</div>