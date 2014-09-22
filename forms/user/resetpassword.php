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
<h2> <?php echo ossn_print('reset:password');?> </h2>
<div class="reset-notice"><?php echo ossn_print('enter:new:password');?></div>
<input type="password" name="password"/>

<input type="hidden" name="user" value="<?php echo input('user');?>" />
<input type="hidden" name="c" value="<?php echo input('c');?>" />

<input type="submit" value="<?php echo ossn_print('reset');?>" />