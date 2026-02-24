<?php
/**
 * Open Source Social Network - Modernized Form
 */
?>
<div class="custom-row">
    <div class="custom-col">
        <input type="text" name="firstname" placeholder="<?php echo ossn_print('first:name'); ?>"/>
    </div>
    <div class="custom-col">
        <input type="text" name="lastname" placeholder="<?php echo ossn_print('last:name'); ?>"/>
    </div>
</div>

<div class="custom-row">
    <div class="custom-col">
        <input type="text" name="email" placeholder="<?php echo ossn_print('email'); ?>"/>
    </div>
    <div class="custom-col">
        <input name="email_re" type="text" placeholder="<?php echo ossn_print('email:again'); ?>"/>
    </div>
</div>
<div class="form-group-modern">
    <input type="text" name="username" maxlength="50" placeholder="<?php echo ossn_print('username'); ?>"/>
</div>

<div class="form-group-modern">
    <input type="password" name="password" placeholder="<?php echo ossn_print('password'); ?>" />
</div>

<?php
$fields = ossn_default_user_fields();
if($fields){
    echo ossn_plugin_view('user/fields/item', array('items' => $fields));
}
?>

<div id="ossn-signup-errors" class="alert alert-danger ossn-hidden"></div>

<p class="terms-text">
    <?php echo ossn_print('account:create:notice'); ?>
    <a target="_blank" href="<?php echo ossn_site_url('site/terms'); ?>"><?php echo ossn_print('site:terms'); ?></a>
</p>

<div class="ossn-loading ossn-hidden"></div>
<input type="submit" id="ossn-submit-button" class="btn btn-primary" value="<?php echo ossn_print('create:account'); ?>" />