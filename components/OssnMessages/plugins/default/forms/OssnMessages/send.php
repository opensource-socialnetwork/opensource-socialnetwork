<textarea name="message" placeholder="<?php echo ossn_print('message:placeholder'); ?>"></textarea>
<input type="hidden" name="to" value="<?php echo $params['user']->guid; ?>"/>
<div class="ossn-message-attachment-details" data-guid="<?php echo $params['user']->guid; ?>"></div>
<div class="controls">
	<?php 
		//this form should be in OssnMessages/forms 
		echo ossn_plugin_view('input/security_token'); 
		?>
	<div class="ossn-loading ossn-hidden"></div>
	<input type="submit" class="btn btn-primary btn-sm" value="<?php echo ossn_print('send'); ?>"/>
    <div class="ossn-message-icon-attachment" data-guid="<?php echo $params['user']->guid; ?>"></div>
    <input type="file"  name="attachment" accept="image/*,.docx, .pdf" class="ossn-omessage-attachment d-none" data-guid="<?php echo $params['user']->guid; ?>" />
</div>
