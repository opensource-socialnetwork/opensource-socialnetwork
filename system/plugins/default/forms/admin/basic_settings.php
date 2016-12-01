<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$setting = new OssnSite;
$setting = $setting->getAllSettings();

//load languages
ossn_load_available_languages();
?>
<div>
	<label><?php echo ossn_print('website:name'); ?></label>
	<input type='text' name="sitename" value="<?php echo $setting->site_name; ?>" placeholder="<?php echo ossn_print('ossn:websitename'); ?>"/>
</div>
<div>    
	<label><?php echo ossn_print('owner:email'); ?></label>
	<input type='text' name="owneremail" value="<?php echo $setting->owner_email; ?>" placeholder="<?php echo ossn_print('owner_email'); ?>"/>
</div>
<div> 
	<label><?php echo ossn_print('admin:notification:email'); ?></label>
	<input type="text" name="notification_email" value="<?php echo $setting->notification_email; ?>" placeholder="<?php echo ossn_print('notification_email'); ?>"/>
</div>
<div>
	<label><?php echo ossn_print('default:lang'); ?></label>
	<select name="sitelang">
    <?php foreach (ossn_get_installed_translations() as $lang => $translation) {
		$select = '';
		if ($lang == $setting->language) {
            $select = 'selected';
        }
        ?>
        <option value="<?php echo $lang; ?>" <?php echo $select; ?>><?php echo ossn_print($lang); ?></option>
    <?php } ?>
	</select>
</div>
<div>
	<label><?php echo ossn_print('erros:reporting'); ?></label>
	<select name="errors">
    <?php
    if ($setting->display_errors == 'off') {
        $off = 'selected';
        $on = '';
    } elseif ($setting->display_errors == 'on') {
        $on = 'selected';
        $off = '';
    }
    ?>
    <option class="option" value="on" <?php echo $on; ?>><?php echo ossn_print('erros:on'); ?></option>
    <option class="option" value="off" <?php echo $off; ?>><?php echo ossn_print('erros:off'); ?></option>

</select>
</div>
<div>
	<input type="submit" class="btn btn-primary" value="<?php echo ossn_print('save'); ?>"/>
</div>