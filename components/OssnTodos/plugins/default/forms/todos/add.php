<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div class="ossntodos-input-main">
    <i class="fa fa-plus ossntodos-input-icon"></i>
    <input type="text" name="title" class="ossntodos-input" placeholder="<?php echo ossn_print('ossntodos:placeholder'); ?>" autocomplete="off" required>
</div>
<div class="ossntodos-composer-actions">
    <select name="priority" class="ossntodos-select" title="<?php echo ossn_print('ossntodos:priority'); ?>">
        <option value="normal"><?php echo ossn_print('ossntodos:priority:normal'); ?></option>
        <option value="high"><?php echo ossn_print('ossntodos:priority:high'); ?></option>
        <option value="low"><?php echo ossn_print('ossntodos:priority:low'); ?></option>
    </select>
    <input type="date" name="due_date" class="ossntodos-date" title="<?php echo ossn_print('ossntodos:due:date'); ?>">
    <button type="submit" class="ossntodos-submit-btn">
        <i class="fa fa-plus me-1"></i><?php echo ossn_print('ossntodos:add'); ?>
    </button>
</div>