<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$setting = new OssnSite;
$setting = $setting->getAllSettings();

//load languages
ossn_load_available_languages();
?>
<label><?php echo ossn_print('website:name'); ?></label>
<input type='text' name="sitename" value="<?php echo $setting->site_name; ?>" placeholder="<?php echo ossn_print('ossn:websitename'); ?>"/>
<label><?php echo ossn_print('owner:email'); ?></label>
<input type='text' name="owneremail" value="<?php echo $setting->owner_email; ?>" placeholder="<?php echo ossn_print('owner_email'); ?>"/>
<label><?php echo ossn_print('notification:email'); ?></label>
<input type="text" name="notification_email" value="<?php echo $setting->notification_email; ?>" placeholder="<?php echo ossn_print('notification_email'); ?>"/>

<label><?php echo ossn_print('default:lang'); ?></label>
<select name="sitelang">
    <?php foreach (ossn_get_installed_translations() as $lang => $translation) {
		$select = '';
		if ($lang == $setting->language) {
            $select = 'selected';
        }
        ?>
        <option class="option"
                value="<?php echo $lang; ?>" <?php echo $select; ?>><?php echo ossn_print($lang); ?></option>
    <?php } ?>
</select>

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

<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save'); ?>"/>
