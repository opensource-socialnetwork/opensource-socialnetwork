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
$cache = ossn_site_settings('cache');
if ($cache == 1) {
    $enabled = 'selected';
    $disabled = '';
} elseif ($cache == 0) {
    $disabled = 'selected';
    $enabled = '';
}
?>
<h4> Status : <?php echo ossn_print("cache:{$cache}"); ?> </h4>

<div>
	<select name="cache">
   	 	<option value="1" <?php echo $enabled; ?>> <?php echo ossn_print('cache:enable'); ?> </option>
   	 	<option value="0" <?php echo $disabled; ?>> <?php echo ossn_print('cache:disable'); ?>  </option>
	</select>
</div>
<div>
	<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
</div>    
<div class="alert alert-info page-botton-notice">
    <?php echo ossn_print('cache:notice'); ?>
</div>