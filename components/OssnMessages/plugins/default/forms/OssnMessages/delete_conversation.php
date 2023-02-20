<div class="ossn-privacy">
<?php
	$id      = input('id');
	$options = array(
			    'me' =>  ossn_print('ossnmessages:delete:me') . ' ('. ossn_print('ossnmessages:delete:me:note').')',		   
	);
	echo ossn_plugin_view('input/radio', array(
			'name' => 'type',
			'value' => 'me',
			'options' => $options,
	));
?>
<input type="hidden" name="id" value="<?php echo $id;?>" />
<input type="submit" class="hidden" value="<?php echo ossn_print('save');?>" id="ossn-mdc-save"/>
</div>
