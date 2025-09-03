<?php
	$settings = ossn_dynamic_cache_settings();
?>
<p><?php echo ossn_print('admin:dcache:note');?></p>
<table class="table table-striped">
	<tr>
		<th><?php echo ossn_print('admin:dcache:cachename');?></th>
		<th class="text-center"><?php echo ossn_print('admin:dcache:extension:enabled');?></th>
		<th><?php echo ossn_print('admin:dcache:extension:tests');?></th>
	</tr>
	<tr>
		<td>Memcached</td>
		<td class="text-center">
			<?php if(extension_loaded('memcached')){ ?>
			<i class="fa fa-check text-success"></i>
			<?php } else { ?>
			<i class="fa fa-times text-danger"></i>
			<?php } ?>
		</td>
		<th id="dcache-memcached-status">
			-
		</th>
	</tr>
	<tr>
		<td>Redis</td>
		<td class="text-center">
			<?php if(extension_loaded('redis')){ ?>
			<i class="fa fa-check text-success"></i>
			<?php } else { ?>
			<i class="fa fa-times text-danger"></i>
			<?php } ?>
		</td>
		<th id="dcache-redis-status">-</th>
	</tr>
</table>
<div class="row">
	<div class="col-md-6">
		<label><?php echo ossn_print('admin:dcache:select:server:type');?> <span class="text-danger">*</span></label>
		<?php 
			$options = array();
			if(extension_loaded('memcached')){
				$options['memcached'] = 'Memcached';
			}
			if(extension_loaded('redis')){
				$options['redis'] = 'Redis';
			}		
			echo ossn_plugin_view('input/dropdown', array(
					'name' => 'cache_server_type',
					'value' => $settings['type'],
					'placeholder' => 'Server Type',
					'options' => $options,
			));
			?>
	</div>
	<div class="col-md-6">
		<label><?php echo ossn_print('admin:dcache:host');?> <span class="text-danger">*</span></label>
		<input type="text" name="host" value="<?php echo $settings['host'];?>" />
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label><?php echo ossn_print('admin:dcache:port');?> <span class="text-danger">*</span></label>
		<input type="text" name="port" value="<?php echo $settings['port'];?>" />
	</div>
	<div class="col-md-6">
		<label><?php echo ossn_print('admin:dcache:username');?></label>
		<input type="text" name="username" value="<?php echo $settings['username'];?>" />
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<label><?php echo ossn_print('admin:dcache:password');?></label>
		<input type="text" name="password" value="<?php echo $settings['password'];?>" />
	</div>
	<div class="col-md-6">
		<label><?php echo ossn_print('admin:dcache:setstatus');?> <span class="text-danger">*</span></label>
		<?php
			echo ossn_plugin_view('input/dropdown', array(
					'name' => 'status',
					'value' => $settings['status'],
					'options' => array(
							'disabled' => ossn_print('cache:0'),
							'enabled' => ossn_print('cache:1'),
					),
			));
			?>
	</div>
</div>
<div>
	<input type="button" id="dcache-form-submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save');?>" />
</div>
<script>
	<?php if(!empty($settings['type']) && !empty($settings['host']) && !empty($settings['port'])){ ?>
	var type   = '<?php echo $settings['type'];?>';
	ossn_admin_dynamic_cache_check('<?php echo $settings['type'];?>', '<?php echo $settings['host'];?>', '<?php echo $settings['port'];?>', '<?php echo $settings['username'];?>', '<?php echo $settings['password'];?>', function(status){
						var failed = '<span class="badge bg-danger">Failed</span>';																  
						var passed = '<span class="badge bg-success">Passed</span>';																  
						if(status == 1){
								switch(type){
									case 'redis':
											$('#dcache-redis-status').html(passed);
										break;
									case 'memcached':
											$('#dcache-memcached-status').html(passed);
										break;
								}
						} else {
								switch(type){
									case 'redis':
											$('#dcache-redis-status').html(failed);
										break;
									case 'memcached':
											$('#dcache-memcached-status').html(failed);
										break;
								}		
								Ossn.trigger_message('Error has occured', 'error');
						}
	});		
	<?php } ?>
</script>