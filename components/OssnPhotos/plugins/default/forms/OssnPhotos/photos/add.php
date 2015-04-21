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
<label><?php echo ossn_print('photo:select'); ?></label>
<input type="file" name="ossnphoto"/>
<input type="submit" class="ossn-hidden" id="ossn-photos-submit"/>
<?php
// Shouldn't album privacy applied on photos? $dev.arsalan
//echo ossn_plugin_view('input/privacy');
?>
