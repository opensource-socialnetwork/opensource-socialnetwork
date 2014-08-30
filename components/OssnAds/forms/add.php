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
?>
<label><?php echo ossn_print('ad:title'); ?> </label>
<input type="text" name="title" />

<label><?php echo ossn_print('ad:site:url'); ?></label>
<input type="text" name="siteurl" />

<label><?php echo ossn_print('ad:desc'); ?></label>
<textarea name="description"> </textarea>

<label><?php echo ossn_print('ad:photo'); ?></label>
<input type="file" name="ossn_ads" />
<br />
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('add');?>"/>
