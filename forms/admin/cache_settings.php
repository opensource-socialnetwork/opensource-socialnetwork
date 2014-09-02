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
$cache = ossn_site_settings('cache');
if($cache == 1){
  $enabled = 'selected';
} elseif($cache == 0){
  $disabled = 'selected';
}
?>
<h3> Status : <?php echo ossn_print("cache:{$cache}"); ?> </h3>

<select name="cache">
<option value="1" <?php echo $enabled;?>> <?php echo ossn_print('cache:enable');?> </option>
<option value="0" <?php echo $disabled;?>> <?php echo ossn_print('cache:disable');?>  </option>
</select>
<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save');?>"/>
<div class="ossn-com-install-notice">
  <?php echo ossn_print('cache:notice'); ?>
</div>