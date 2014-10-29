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
?>
<label><?php echo ossn_print('ad:title'); ?> </label>
<input type="text" name="title"/>

<label><?php echo ossn_print('ad:site:url'); ?></label>
<input type="text" name="siteurl"/>

<label><?php echo ossn_print('ad:desc'); ?></label>
<textarea name="description"> </textarea>

<label><?php echo ossn_print('ad:photo'); ?></label>
<input type="file" name="ossn_ads"/>
<br/>
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('add'); ?>"/>
