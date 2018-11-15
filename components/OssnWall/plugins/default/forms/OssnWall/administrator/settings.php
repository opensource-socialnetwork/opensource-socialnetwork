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
 <input type="submit" value="<?php echo ossn_print("save");?>" class="btn btn-success btn-sm"/>
