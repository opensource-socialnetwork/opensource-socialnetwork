<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$object = $params['object'];
?>
<div class="ossn-comment-attach-photo" onclick="Ossn.Clk('#ossn-comment-image-file-p<?php echo $object; ?>');"><i class="fa fa-camera"></i></div>
<?php echo ossn_fetch_extend_views('comments/attachment/buttons'); ?>
<span type="text" name="comment" id="comment-box-p<?php echo $object; ?>" class="comment-box"
       placeholder="<?php echo ossn_print('write:comment'); ?>" contenteditable="true"></span>
<a href="javascript:void(0);" class="btn btn-primary btn-sm comment-post-btn d-sm-block d-md-none" data-type='p' data-guid='<?php echo $object; ?>'><?php echo ossn_print('post');?></a>      
<input type="hidden" name="post" value="<?php echo $object; ?>"/>
<input type="hidden" name="comment-attachment"/>
 
      
