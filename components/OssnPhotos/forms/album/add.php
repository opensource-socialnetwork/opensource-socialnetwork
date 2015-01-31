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
?>
    <label><?php echo ossn_print('album:name'); ?></label>
    <input type="text" name="title"/>
    <input type="submit" class="ossn-hidden" id="ossn-album-submit"/>
<?php
echo ossn_view('system/templates/input/privacy');
?>