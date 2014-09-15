<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence 
 * @link      http://www.opensource-socialnetwork.org/licence
 */
  $object = $params['object'];
  ?>
      <input type="text" name="comment" id="comment-box-<?php echo $object;?>" class="comment-box" placeholder="<?php echo ossn_print('write:comment'); ?>" />
      <input type="hidden" name="post" value="<?php echo $object;?>" />

          
      