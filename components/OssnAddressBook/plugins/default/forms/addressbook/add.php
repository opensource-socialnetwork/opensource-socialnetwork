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
<div class="ossnab-composer-grid">
		<div class="ossnab-field">
				<input type="text" name="name" class="ossnab-input" placeholder="<?php echo ossn_print('ossnaddressbook:name:placeholder'); ?>" autocomplete="off" required>
		</div>
		<div class="ossnab-field">
				<input type="text" name="phone" class="ossnab-input" placeholder="<?php echo ossn_print('ossnaddressbook:phone:placeholder'); ?>" autocomplete="off">
		</div>
		<div class="ossnab-field">
				<input type="email" name="email" class="ossnab-input" placeholder="<?php echo ossn_print('ossnaddressbook:email:placeholder'); ?>" autocomplete="off">
		</div>
		<div class="ossnab-field">
				<input type="text" name="company" class="ossnab-input" placeholder="<?php echo ossn_print('ossnaddressbook:company:placeholder'); ?>" autocomplete="off">
		</div>
		<div class="ossnab-field">
				<input type="text" name="address" class="ossnab-input" placeholder="<?php echo ossn_print('ossnaddressbook:address:placeholder'); ?>" autocomplete="off">
		</div>
		<div class="ossnab-field">
				<select name="category" class="ossnab-select" title="<?php echo ossn_print('ossnaddressbook:category'); ?>">
						<option value="personal"><?php echo ossn_print('ossnaddressbook:category:personal'); ?></option>
						<option value="work"><?php echo ossn_print('ossnaddressbook:category:work'); ?></option>
						<option value="family"><?php echo ossn_print('ossnaddressbook:category:family'); ?></option>
						<option value="other"><?php echo ossn_print('ossnaddressbook:category:other'); ?></option>
				</select>
		</div>
</div>
<div class="ossnab-composer-footer">
		<textarea name="description" rows="2" class="ossnab-textarea" placeholder="<?php echo ossn_print('ossnaddressbook:note:placeholder'); ?>"></textarea>
		<div class="ossnab-composer-btns">
				<button type="submit" class="ossnab-submit-btn">
						<i class="fa fa-plus me-1"></i><?php echo ossn_print('ossnaddressbook:add'); ?>
				</button>
				<button type="button" class="ossnab-cancel-btn" id="ossnab-composer-cancel">
						<?php echo ossn_print('ossnaddressbook:cancel'); ?>
				</button>
		</div>
</div>
