<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright (C) SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
?>
<div>
    <input type="text" name="firstname" placeholder="<?php echo ossn_print('first:name'); ?>"/>
    <input type="text" name="lastname" placeholder="<?php echo ossn_print('last:name'); ?>"/>
</div>

<div>
    <input type="text" name="email" placeholder="<?php echo ossn_print('email'); ?>"/>
    <input name="email_re" type="text" placeholder="<?php echo ossn_print('email:again'); ?>"/>
</div>

<div>
    <input type="text" name="username" placeholder="<?php echo ossn_print('username'); ?>" class="long-input"/>
</div>

<div>
    <input type="password" name="password" placeholder="<?php echo ossn_print('password'); ?>" class="long-input"/>
</div>
<?php
$fields = ossn_default_user_fields();
if($fields){
			$vars	= array();
			$vars['items'] = $fields;
			echo ossn_plugin_view('user/fields/item', $vars);
}
?>
<div>
<?php echo ossn_fetch_extend_views('forms/signup/before/submit'); ?>
</div>

<div id="ossn-signup-errors" class="alert alert-danger"></div>

<p>
    <?php echo ossn_print('account:create:notice'); ?>
    <?php //Loosing typed in data when clicking Terms and Conditions link #620 ?>
    <a target="_blank" href="<?php echo ossn_site_url('site/terms'); ?>"><?php echo ossn_print('site:terms'); ?></a>
</p>
<div class="ossn-loading ossn-hidden"></div>
<input type="submit" id="ossn-submit-button" class="btn btn-success" value="<?php echo ossn_print('create:account'); ?>" class=""/>
