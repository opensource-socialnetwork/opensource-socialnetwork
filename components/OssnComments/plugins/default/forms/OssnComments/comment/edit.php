<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 if(isset($params['comment']->{'comments:entity'})){
	 $comment = $params['comment']->getParam('comments:entity');
 }
 if(empty($comment) && isset($params['comment']->{'comments:post'})){
	 $comment = $params['comment']->getParam('comments:post');
 }
 if(empty($comment)){
	 return;
 }
 ?>
 <div>
 	<textarea id="comment-edit" name="comment"><?php echo  $comment;?></textarea>
    <input type="hidden"  name="guid" value="<?php echo $params['comment']->getID();?>" />
    <input type="submit" class="hidden" id="ossn-comment-edit-save" />
 </div>
