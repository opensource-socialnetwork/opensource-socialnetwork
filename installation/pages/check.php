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


echo '<div><div class="layout-installation"><h2>' . ossn_installation_print('ossn:prerequisites') . '</h2><br /><div style="margin:0 auto; width:900px;">';
if (OssnInstallation::isPhp()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'. ossn_installation_print('ossn:install:php') . PHP_VERSION . ' </div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail"> ' . ossn_installation_print('ossn:install:old:php') . '</div>';
    $error[] = 'php';
}
if (OssnInstallation::is_mysqli_enabled()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:mysqli').'</div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:mysqli:required').'</div>';
    $error[] = 'mysqli';
}
if (OssnInstallation::isApache()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:apache').'</div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:apache:required').'</div>';
    $error[] = 'apache';
}
if (OssnInstallation::is_mod_rewrite()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:modrewrite').'</div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:modrewrite:required').'</div>';
    $error[] = 'mod_rewrite';
}
if (OssnInstallation::isCurl()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:curl').'</div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:curl:required').'</div>';
    $error[] = 'php:curl';
}
if (OssnInstallation::isPhpGd()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:gd').'</div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:gd:required').'</div>';
    $error[] = 'php:gd';
}
if (OssnInstallation::isCon_WRITEABLE()) {
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:config').'</div>';
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:config:error').'</div>';
    $error[] = 'permission:configuration';
}
if(OssnInstallation::allowUrlFopen()){
    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:allowfopenurl').'</div>';	
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:allowfopenurl:error').'</div>';
    $error[] = 'allowfopenurl:error';	
}
if(OssnInstallation::isZipClass()){
	    echo '<div class="ossn-installation-message ossn-installation-success">'.ossn_installation_print('ossn:install:ziparchive').'</div>';	
} else {
    echo '<div class="ossn-installation-message ossn-installation-fail">'.ossn_installation_print('ossn:install:ziparchive:error').'</div>';
    $error[] = 'ziparchive:error';		
}
echo '<br />';
if (!isset($error)) {
    echo '<a href="' . ossn_installation_paths()->url . '?page=settings" class="button-blue primary">'.ossn_installation_print('ossn:install:next').'</a>';
}

echo '</div><br /><br /></div>';

