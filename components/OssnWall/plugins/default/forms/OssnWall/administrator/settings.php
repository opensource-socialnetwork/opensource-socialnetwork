<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.Open Source Social Network.org/licence
 * @link      http://www.Open Source Social Network.org/licence
 */
 ?>
 <label><?php echo ossn_print('settings');?> (<?php echo ossn_print('ossn:wall:admin:notice');?>)</label>
 <select name="type">
 	<?php
	$friends = '';
	$public = '';
	if(ossn_get_homepage_wall_access() == 'friends'){
		$friends = 'selected';
	} elseif(ossn_get_homepage_wall_access() == 'public'){
		$public = 'selected';
	}
	?>
 	<option value="friends" <?php echo $friends;?>><?php echo ossn_print('ossn:wall:friends:posts');?></option>
    <option value="public" <?php echo $public;?>><?php echo ossn_print('ossn:wall:allsite:posts');?></option>
 </select>
 <input type="submit" value="<?php echo ossn_print("save");?>" class="ossn-admin-button button-dark-blue"/>
