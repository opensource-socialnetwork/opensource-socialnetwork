<?php
/**
 * 	OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence 
 * @link      http://www.opensource-socialnetwork.com/licence
 */
$setting = new OssnSite;
$setting = $setting->getAllSettings();
?>
<label><?php echo ossn_print('website:name');?></label>
<input type='text' name="sitename"  value="<?php echo $setting->site_name;?>" placeholder='Website Name'/>
<label><?php echo ossn_print('owner:email');?></label>
<input type='text' name="owneremail" value="<?php echo $setting->owner_email;?>" placeholder='Owner Email'/>

<label><?php echo ossn_print('default:lang');?></label>
<select name="sitelang">
<?php foreach(ossn_locales() as $lang){ 
if($lang == $setting->language){ $select = 'selected'; }
?>
<option class="option"value="<?php echo $lang;?>" <?php echo $select;?>><?php echo ossn_print($lang);?></option>
<?php } ?>
</select>

<label><?php echo ossn_print('erros:reporting');?></label>
<select name="errors">
<?php 
if($cache == 'off'){ 
  $off = 'selected'; 
}elseif($cache == 'on'){
  $on = 'selected';	
}
?>
<option class="option" value="on" <?php echo $on;?>><?php echo ossn_print('erros:on');?></option>
<option class="option" value="off" <?php echo $off;?>><?php echo ossn_print('erros:off');?></option>

</select>

<input type="submit" class="ossn-admin-button button-dark-blue" value="<?php echo ossn_print('save');?>"/>
