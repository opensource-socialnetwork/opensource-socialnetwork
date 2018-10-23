<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
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