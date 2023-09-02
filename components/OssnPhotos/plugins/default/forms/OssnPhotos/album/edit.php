<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
    <label><?php echo ossn_print('album:name'); ?></label>
    <input type="text" name="title" value="<?php echo $params['album']->title;?>"/>
    <input type="hidden" name="guid" value="<?php echo $params['album']->guid;?>" />
    <input type="submit" class="ossn-hidden" id="ossn-album-edit-submit"/>
<?php
	echo ossn_plugin_view('input/privacy', array(
		'value' => (int)$params['album']->access,											 
	));
?>