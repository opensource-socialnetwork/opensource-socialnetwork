<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$object = $params['object'];
?>
<div class="ossn-comment-attach-photo" onclick="Ossn.Clk('#ossn-comment-image-file-<?php echo $object; ?>');"><i class="fa fa-camera"></i></div>
<span type="text" name="comment" id="comment-box-<?php echo $object; ?>" class="comment-box"
       placeholder="<?php echo ossn_print('write:comment'); ?>" contenteditable="true"></span>
<input type="hidden" name="post" value="<?php echo $object; ?>"/>
<input type="hidden" name="comment-attachment"/>
 
      
