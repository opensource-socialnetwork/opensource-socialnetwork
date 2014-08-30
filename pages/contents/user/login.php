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
  $error = input('error');
?>
<div class="login-page">
    <?php if($error == 1){ ?>
      <div class="login-error">
      <strong><?php echo ossn_print('login:error');?></strong><br />
      <p><?php echo ossn_print('login:error:sub');?></p>
      </div>
    <?php } ?>
    <div class="login-page-fields">
   <?php echo  ossn_view_form('login2', array('id' => 'ossn-login', 'action' => ossn_site_url('action/user/login'), 'method' => 'post'));?>
   </div>
</div>