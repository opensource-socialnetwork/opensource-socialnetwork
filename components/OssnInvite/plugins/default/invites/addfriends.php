<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 $guid = input('com_invite_friend');
 if($guid && !empty($guid)){ ?>
 <input type="hidden" name="com_invite_friend" value="<?php echo $guid;?>" />
<?php
 }