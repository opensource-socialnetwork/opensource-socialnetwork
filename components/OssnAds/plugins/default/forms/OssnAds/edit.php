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
<label><?php echo ossn_print('ad:title'); ?> </label>
<input type="text" name="title" value="<?php echo $params['entity']->title;?>"/>

<label><?php echo ossn_print('ad:site:url'); ?></label>
<input type="text" name="siteurl" value="<?php echo $params['entity']->site_url;?>"/>

<label><?php echo ossn_print('ad:desc'); ?></label>
<textarea name="description"><?php echo $params['entity']->description;?></textarea>

<label><?php echo ossn_print('ad:photo'); ?></label>
<input type="file" name="ossn_ads"/>
<input type="hidden" name="entity" value="<?php echo $params['entity']->guid;?>" />
<div class="ossn-ad-image" style="background:url('<?php echo ossn_ads_image_url($params['entity']->guid);?>') no-repeat;background-size: contain;"></div>
<br/>
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save'); ?>"/>
