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

$component = new OssnComponents;
$settings = $component->getComSettings('OssnSmilies');
?>

<label><?php echo ossn_print('ossn:smilies:admin:settings:compat:title');?></label>
<?php echo ossn_print('ossn:smilies:admin:settings:compat:note');?>
<select name="compatibility_mode">
 	<?php
	$compat_off = '';
	$compat_on = '';
	if($settings && $settings->compatibility_mode == 'on'){
		$compat_on = 'selected';
	} else {
		$compat_off = 'selected';
	}
	?>
	<option value="off" <?php echo $compat_off;?>><?php echo ossn_print('ossn:admin:settings:off');?></option>
	<option value="on" <?php echo $compat_on;?>><?php echo ossn_print('ossn:admin:settings:on');?></option>
</select>
<br />
<label><?php echo ossn_print('ossn:smilies:admin:settings:close_anywhere:title');?></label>
<?php echo ossn_print('ossn:smilies:admin:settings:close_anywhere:note');?>
<select name="close_anywhere">
 	<?php
	$close_anywhere_off = '';
	$close_anywhere_on = '';
	if($settings && $settings->close_anywhere == 'on'){
		$close_anywhere_on = 'selected';
	} else {
		$close_anywhere_off = 'selected';
	}
	?>
	<option value="off" <?php echo $close_anywhere_off;?>><?php echo ossn_print('ossn:admin:settings:off');?></option>
	<option value="on" <?php echo $close_anywhere_on;?>><?php echo ossn_print('ossn:admin:settings:on');?></option>
</select>
<input type="submit" value="<?php echo ossn_print("save");?>" class="btn btn-success btn-sm"/>
