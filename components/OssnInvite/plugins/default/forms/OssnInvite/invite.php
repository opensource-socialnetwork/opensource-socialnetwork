<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-invite-friends">
    <p><?php echo ossn_print('com:ossn:invite:friends:note');?></p>
    
	<label><?php echo ossn_print('com:ossn:invite:emails:note');?></label>
    <textarea rows="4" name="addresses" placeholder="<?php echo ossn_print("com:ossn:invite:emails:placeholder");?>"></textarea>
    
    <label><?php echo ossn_print('com:ossn:invite:message');?></label>
    <textarea name="message"></textarea>
    
	<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('com:ossn:invite');?>"/>    
</div>