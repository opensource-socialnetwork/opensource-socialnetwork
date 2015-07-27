<?php
/**
 * Open Source Social Network
 *
 * @packageOpen Source Social Network
 * @author    Open Social Website Core Team <info@informatikon.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$group = $params['group'];
?>
<label><?php echo ossn_print('group:name'); ?></label>
<input type="text" name="groupname" value="<?php echo $group->title; ?>"/>
<label><?php echo ossn_print('group:desc'); ?></label>

<textarea name="groupdesc"><?php echo trim($group->description); ?></textarea>
<br/>

<label><?php echo ossn_print('privacy'); ?></label>
<select name="membership">
    <?php
    if ($group->membership == OSSN_PUBLIC) {
        $open = 'selected';
        $close = '';
    } elseif ($group->membership == OSSN_PRIVATE) {
        $close = 'selected';
        $open = '';
    }
    ?>
    <option value='2' <?php echo $open; ?>> <?php echo ossn_print('public'); ?> </option>
    <option value='1' <?php echo $close; ?>> <?php echo ossn_print('close'); ?> </option>
</select>
<input type="hidden" name="group" value="<?php echo $group->guid; ?>"/>
<input type="submit" value="<?php echo ossn_print('save'); ?>" class="ossn-button ossn-button-submit"/>
<?php
	echo ossn_plugin_view('output/url', array(
			'text' => ossn_print('delete'),
			'href' => ossn_site_url("action/group/delete?guid=$group->guid"),
			'class' => 'button-grey delete-group ossn-make-sure',
			'action' => true,
	));