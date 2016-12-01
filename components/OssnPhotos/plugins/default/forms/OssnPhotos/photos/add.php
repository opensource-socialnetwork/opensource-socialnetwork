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
?>
<label><?php echo ossn_print('photo:select'); ?></label>
<input type="file" name="ossnphoto"/>
<input type="submit" class="ossn-hidden" id="ossn-photos-submit"/>
<?php
// Shouldn't album privacy applied on photos? $dev.arsalan
//echo ossn_plugin_view('input/privacy');
?>
