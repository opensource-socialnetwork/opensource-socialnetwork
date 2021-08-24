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

echo '<div><div class="layout-installation">';
echo '<h2>' . ossn_installation_print('site:settings') . '</h2>';
$notification_email = parse_url(ossn_installation_paths()->url);
if(substr($notification_email['host'], 0, 4) == 'www.'){
	$notification_email['host'] = substr($notification_email['host'], 4);
}
?>
<form action="<?php echo ossn_installation_paths()->url; ?>?action=install" method="post">

    <div>
        <label> <?php echo ossn_installation_print('ossn:dbsettings'); ?>: </label>

        <input type="text" name="dbuser" placeholder="<?php echo ossn_installation_print('ossn:dbuser'); ?>"/>
        <input type="password" name="dbpwd" placeholder="<?php echo ossn_installation_print('ossn:dbpassword'); ?>"/>
        <input type="text" name="dbname" placeholder="<?php echo ossn_installation_print('ossn:dbname'); ?>"/>
        <input type="text" name="dbhost" placeholder="<?php echo ossn_installation_print('ossn:dbhost'); ?>"/>
    </div>

    <div>

        <label> <?php echo ossn_installation_print('ossn:sitesettings'); ?>: </label>

        <input type="text" name="sitename" placeholder="<?php echo ossn_installation_print('ossn:websitename'); ?>"/>

        <input type="text" name="owner_email" placeholder="<?php echo ossn_installation_print('owner_email'); ?>"/>
        <?php
		if(!filter_var($notification_email['host'], FILTER_VALIDATE_IP)){ ?>
        <input type="text" name="notification_email" placeholder="<?php echo ossn_installation_print('notification_email'); ?>" value="noreply@<?php echo $notification_email['host'];?>"/>
        <?php } else {  ?>
        <input type="text" name="notification_email" placeholder="<?php echo ossn_installation_print('notification_email'); ?>" value=""/>                
        <?php } ?>
    </div>

    <label> <?php echo ossn_installation_print('ossn:mainsettings'); ?>: </label>
    <br/>

  	<input type="hidden" name="url" value="<?php echo OssnInstallation::url(); ?>"/>

    <div>
        <label> <?php echo ossn_installation_print('ossn:datadir'); ?> </label>
        <input type="text" name="datadir" value="<?php echo OssnInstallation::DefaultDataDir(); ?>"/>
    </div>
	<div style="display:block;margin-top:10px;">
	    <input type="submit" value="<?php echo ossn_installation_print('ossn:install:install'); ?>" class="button-blue primary">
	</div>
</form>
</div>
