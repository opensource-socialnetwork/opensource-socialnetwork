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
 <label><?php echo ossn_print('ossn:smilies:admin:settings:compat:title');?></label>
 <?php echo ossn_print('ossn:smilies:admin:settings:compat:note');?>
 <select name="compatibility_mode">
 	<?php
	$component = new OssnComponents;
	$settings = $component->getComSettings('OssnSmilies');
	$compat_off = '';
	$compat_on = '';
	if($settings && $settings->compatibility_mode == 'on'){
		$compat_on = 'selected';
	} else {
		$compat_off = 'selected';
	}
	?>
 	<option value="off" <?php echo $compat_off;?>><?php echo ossn_print('ossn:smilies:admin:settings:compat:off');?></option>
    <option value="on" <?php echo $compat_on;?>><?php echo ossn_print('ossn:smilies:admin:settings:compat:on');?></option>
 </select>
 <input type="submit" value="<?php echo ossn_print("save");?>" class="btn btn-success btn-sm"/>
