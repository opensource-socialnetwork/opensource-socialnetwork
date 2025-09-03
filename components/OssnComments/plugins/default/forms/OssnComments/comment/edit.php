<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
 if(isset($params['comment']->{'comments:entity'})){
	 $comment = $params['comment']->getParam('comments:entity');
 }
 if(empty($comment) && isset($params['comment']->{'comments:post'})){
	 $comment = $params['comment']->getParam('comments:post');
 }
 if(empty($comment) && isset($params['comment']->{'comments:object'})){
	 $comment = $params['comment']->getParam('comments:object');
 } 
 //Comments without text/image only can't be edited #1336
 if(!$params['comment']){
	 return;
 }
 ?>
 <div>
 	<textarea id="comment-edit" name="comment"><?php echo  $comment;?></textarea>
    <input type="hidden"  name="guid" value="<?php echo $params['comment']->getID();?>" />
    <input type="submit" class="hidden" id="ossn-comment-edit-save" />
 </div>
