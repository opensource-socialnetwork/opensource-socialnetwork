<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
?>
    <label><?php echo ossn_print('album:name'); ?></label>
    <input type="text" name="title"/>
    <input type="submit" class="ossn-hidden" id="ossn-album-submit"/>
<?php
echo ossn_plugin_view('input/privacy');
?>