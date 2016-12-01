<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<label><?php echo ossn_print('ad:title'); ?> </label>
<input type="text" name="title"/>

<label><?php echo ossn_print('ad:site:url'); ?></label>
<input type="text" name="siteurl"/>

<label><?php echo ossn_print('ad:desc'); ?></label>
<textarea name="description"></textarea>

<label><?php echo ossn_print('ad:photo'); ?></label>
<input type="file" name="ossn_ads"/>
<br/>
<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('add'); ?>"/>
