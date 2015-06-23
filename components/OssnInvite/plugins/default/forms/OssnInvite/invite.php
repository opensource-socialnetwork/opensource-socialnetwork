<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
<div class="ossn-invite-friends">
	<h2><?php echo ossn_print('com:ossn:invite:friends');?></h2>
    <p><?php echo ossn_print('com:ossn:invite:friends:note');?></p>
    
	<label><?php echo ossn_print('com:ossn:invite:emails:note');?></label>
    <textarea rows="4" name="addresses" placeholder="<?php echo ossn_print("com:ossn:invite:emails:placeholder");?>"></textarea>
    
    <label><?php echo ossn_print('com:ossn:invite:message');?></label>
    <textarea name="message"></textarea>
    
	<input type="submit" class="ossn-button ossn-button-submit" value="<?php echo ossn_print('com:ossn:invite');?>"/>    
</div>