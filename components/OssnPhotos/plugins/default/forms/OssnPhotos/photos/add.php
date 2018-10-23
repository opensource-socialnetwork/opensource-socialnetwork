<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossn-photos-add-button">
	<input type="file" name="ossnphoto[]" multiple class="hidden"/>
	<button type="button" id="ossn-photos-add-button-inner" class="btn btn-default btn-lg"><i class="fa fa-copy"></i> <?php echo ossn_print('photo:select'); ?></button>
    <div class="images"><i class="fa fa-image"></i> <span class="count">0</span></div>
</div>

<input type="submit" class="ossn-hidden" id="ossn-photos-submit"/>
<?php
// Shouldn't album privacy applied on photos? $dev.arsalan
//echo ossn_plugin_view('input/privacy');
?>
