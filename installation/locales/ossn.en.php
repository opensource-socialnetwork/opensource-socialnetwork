<?php
/**
 *    OpenSource-SocialNetwork
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   General Public Licence http://opensource-socialnetwork.com/licence
 * @link      http://www.opensource-socialnetwork.com/licence
 */


$englsih = array(
	'site:settings' => 'Site Settings',
	'ossn:installed' => 'Installed',
	'ossn:installation' => 'Installation',
	'ossn:check' => 'Validate',
	'ossn:installed' => 'Installed',
	'ossn:installed:message' => 'Opensource Socialnetwork has been installed. After finish please remove installation directory.',
    'ossn:prerequisites' => 'Installation prerequisites',
    'ossn:settings' => 'Server Settings',
    'ossn:dbsettings' => 'Database',
	'ossn:dbuser' => 'Database User',
	'ossn:dbpassword' => 'Database Password',
	'ossn:dbname' => 'Database Name',
	'ossn:dbhost' => 'Database Host',
    'ossn:sitesettings' => 'Website',
    'ossn:websitename' => 'Website name',
    'ossn:mainsettings' => 'Paths',
	'ossn:weburl' => 'OssnSite Url',
	'installation:notes' => 'Data Direcotry contain users files, Data Directory must be outside or Ossn Installation',
	'ossn:datadir' => 'Data Directory',
	'owner_email' => 'Site Owner Email',
	'notification_email' => 'Notification Email (noreply@domain.com)',
	'create:admin:account' => 'Create Admin Account',
	'ossn:setting:account' => 'Account settings',
	
	'data:directory:invalid' => 'Invalid data directoy or directory is not writeable',	
	'data:directory:outside' => 'Data directory must outside',
	'all:files:required' => 'All files are required please check your files',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "You have old PHP " . PHP_VERSION . " You need PHP 5.3 or Higher",
	
	'ossn:install:mysqli' => 'MYSQLI ENABLED',
	'ossn:install:mysqli:required' => 'MYSQLI PHP EXTENSION REQUIRED',
	
	'ossn:install:apache' => 'APACHE ENABLED',
	'ossn:install:apache:required' => 'APACHE IS REQUIRED',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE REQUIRED',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL REQUIRED',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY REQUIRED',
	
	'ossn:install:config' => 'CONFIGURATION DIRECTORY WRITEABLE',
	'ossn:install:config:error' => 'CONFIGURATION DIRECTORY IS NOT WRITEABLE',
	
	'ossn:install:next' => 'Next',
    'ossn:install:install' => 'Install',
    'ossn:install:create' => 'Create',
    'ossn:install:finish' => 'Finish',
	
	'fields:require' => 'All fields are required',
);

ossn_installation_register_languages($englsih);
