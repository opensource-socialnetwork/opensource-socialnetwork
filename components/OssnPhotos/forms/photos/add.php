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
<label><?php echo ossn_print('photo:select'); ?></label>
<input type="file" name="ossnphoto"/>
<input type="submit" class="ossn-hidden" id="ossn-photos-submit"/>
<?php
// Shouldn't album privacy applied on photos? $dev.arsalan
//echo ossn_view('system/templates/privacy');
?>
