<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

echo '<div><div class="layout-installation">';
echo '<h2>' . ossn_installation_print('site:settings') . '</h2>';
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
        <input type="text" name="notification_email" placeholder="<?php echo ossn_installation_print('notification_email'); ?>"/>
    </div>

    <label> <?php echo ossn_installation_print('ossn:mainsettings'); ?>: </label>
    <br/>

    <div>
        <label> <?php echo ossn_installation_print('ossn:weburl'); ?> </label>
        <input type="text" name="url" value="<?php echo OssnInstallation::url(); ?>"/>
    </div>

    <div>
        <label> <?php echo ossn_installation_print('ossn:datadir'); ?> </label>
        <input type="text" name="datadir" value="<?php echo OssnInstallation::DefaultDataDir(); ?>"/>
    </div>
	<div style="display:block;margin-top:10px;">
	    <input type="submit" value="<?php echo ossn_installation_print('ossn:install:install'); ?>" class="button-blue primary">
	</div>
</form>


</div>
