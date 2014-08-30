<?php
/**
 * OpenSocialWebsite
 *
 * @package   OpenSocialWebsite
 * @author    Open Social Website Core Team <info@opensocialwebsite.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensocialwebsite.com/licence 
 * @link      http://www.opensocialwebsite.com/licence
 */
  $object = $params['object'];
  ?>
      <input type="text" name="comment" id="comment-box-<?php echo $object;?>" class="comment-box" placeholder="<?php echo ossn_print('write:comment'); ?>" />
      <input type="hidden" name="post" value="<?php echo $object;?>" />

          
      