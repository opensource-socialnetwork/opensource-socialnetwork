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
<div class="reset-notice"><?php echo ossn_print('enter:new:password'); ?></div>
<input type="password" name="password"/>

<input type="hidden" name="user" value="<?php echo input('user'); ?>"/>
<input type="hidden" name="c" value="<?php echo input('c'); ?>"/>
<div>
		<?php echo ossn_fetch_extend_views('forms/resetpassword/before/submit'); ?>
</div>
<input type="submit"  class="btn btn-success btn-sm" value="<?php echo ossn_print('reset'); ?>"/>