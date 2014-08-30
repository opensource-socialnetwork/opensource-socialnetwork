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
$group = $params['group'];
?>
<label><?php echo ossn_print('group:name');?></label>
<input type="text"  name="groupname" value="<?php echo $group->title; ?>" />
<label><?php echo ossn_print('group:desc');?></label>

<textarea name="groupdesc"><?php echo trim($group->description); ?></textarea>
<br />

<label><?php echo ossn_print('privacy');?></label>
<select name="membership">
<?php
if($group->membership == OSSN_PUBLIC){
	   $open = 'selected';
      } elseif($group->membership == OSSN_PRIVATE){
		 $close = 'selected';  
	  }
	  ?>
 <option value='2' <?php echo $open;?>> <?php echo ossn_print('public');?> </option>
 <option value='1' <?php echo $close;?>> <?php echo ossn_print('close');?> </option>
</select>
<input type="hidden" name="group" value="<?php echo $group->guid;?>" />
<input type="submit" value="Save" class="ossn-button ossn-button-submit"/>