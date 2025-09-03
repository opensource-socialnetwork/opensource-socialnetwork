<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div>
	<label> <?php echo ossn_print('first:name'); ?> </label>
	<input type='text' name="firstname" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('last:name'); ?> </label>
	<input type='text' name="lastname" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('username'); ?> </label>
	<input type='text' name="username" maxlength="50" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('email'); ?> </label>
	<input type='text' name="email" placeholder=''/>
</div>
<div>
	<label> <?php echo ossn_print('password'); ?> </label>
	<input type='password' name="password" placeholder=''/>
</div>
<?php
$fields = ossn_default_user_fields();
if($fields){
			$vars	= array();
			$vars['items'] = $fields;
			$vars['label'] = true;
			echo ossn_plugin_view('user/fields/item', $vars);
}
?>
<div>
	<label> <?php echo ossn_print('type'); ?> </label>

	<select name="type">
    	<option value="normal"><?php echo ossn_print('normal'); ?></option>
    	<option value="admin"> <?php echo ossn_print('admin'); ?> </option>
	</select>
</div>
<div>
	<input type="submit" class="btn btn-success btn-sm" value="<?php echo ossn_print('save'); ?>"/>
</div>
