<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$englsih = array(
		'site:settings'                     => 'Site Settings',
		'ossn:installed'                    => 'Installed',
		'ossn:installation'                 => 'Installation',
		'ossn:check'                        => 'Validate',
		'ossn:installed'                    => 'Installed',
		'ossn:installed:message'            => 'Open Source Social Network has been installed.',
		'ossn:prerequisites'                => 'Installation prerequisites',
		'ossn:settings'                     => 'Server Settings',
		'ossn:dbsettings'                   => 'Database',
		'ossn:dbuser'                       => 'Database User',
		'ossn:dbpassword'                   => 'Database Password',
		'ossn:dbname'                       => 'Database Name',
		'ossn:dbhost'                       => 'Database Host',
		'ossn:sitesettings'                 => 'Website',
		'ossn:websitename'                  => 'Website name',
		'ossn:mainsettings'                 => 'Paths',
		'ossn:weburl'                       => 'OssnSite Url',
		'installation:notes'                => 'The data directory contains users files. The data directory must be located outside the OSSN installation path.',
		'ossn:datadir'                      => 'Data Directory',
		'owner_email'                       => 'Site Owner Email',
		'notification_email'                => 'Notification Email',
		'notification_email:noreply'        => 'noreply@domain.com',
		'create:admin:account'              => 'Create Admin Account',
		'ossn:setting:account'              => 'Account settings',

		'data:directory:invalid'            => 'Invalid data directory or directory is not writeable.',
		'data:directory:outside'            => 'Data directory must be outside the installation path.',
		'all:files:required'                => 'All files are required! Please check your files.',

		'ossn:install:php'                  => 'PHP ',
		'ossn:install:old:php'              => 'You have an old version of PHP ' . PHP_VERSION . ' You need minimum PHP 8.0 or 8.x',

		'ossn:install:mysqli'               => 'MYSQLI ENABLED',
		'ossn:install:mysqli:required'      => 'MYSQLI PHP EXTENSION REQUIRED',

		'ossn:install:apache'               => 'APACHE ENABLED',
		'ossn:install:apache:required'      => 'APACHE IS REQUIRED',

		'ossn:install:modrewrite'           => 'MOD_REWRITE',
		'ossn:install:modrewrite:required'  => 'MOD_REWRITE REQUIRED',

		'ossn:install:curl'                 => 'PHP CURL',
		'ossn:install:curl:required'        => 'PHP CURL REQUIRED',

		'ossn:install:gd'                   => 'PHP GD LIBRARY',
		'ossn:install:gd:required'          => 'PHP GD LIBRARY REQUIRED',

		'ossn:install:config'               => 'CONFIGURATION DIRECTORY WRITEABLE',
		'ossn:install:config:error'         => 'CONFIGURATION DIRECTORY IS NOT WRITEABLE',

		'ossn:install:next'                 => 'Next',
		'ossn:install:install'              => 'Install',
		'ossn:install:create'               => 'Create',
		'ossn:install:finish'               => 'Finish',

		'fields:require'                    => 'All fields are required!',

		'ossn:install:allowfopenurl'        => 'PHP allow_url_fopen ENABLED',
		'ossn:install:allowfopenurl:error'  => 'PHP allow_url_fopen is required',

		'ossn:install:ziparchive'           => 'PHP ZipArchive ENABLED',
		'ossn:install:ziparchive:error'     => 'PHP ZipArchive EXTENSION REQUIRED',
		'ossn:install:cachedir:note:failed' => 'Make sure your files and directories are owned by correct apache user.',

		'ossn:install:checklist'            => 'Prerequisites',
		'ossn:install:licence'              => 'License',
		'ossn:install:account'              => 'Account',
		'ossn:install:complete'             => 'Finish',
		'create:admin:account:sub'          => 'Set up your administrator credentials to manage your social network.',
		'create:admin:account:firstname'    => 'First Name',
		'create:admin:account:lastname'     => 'Last Name',
		'create:admin:account:email'        => 'Email',
		'create:admin:account:cemail'       => 'Confirm Email',
		'create:admin:account:username'     => 'Username',
		'create:admin:account:password'     => 'Password',
		'create:admin:account:birthdate'    => 'Birthdate',
		'create:admin:account:month'        => 'Month',
		'create:admin:account:day'          => 'Day',
		'create:admin:account:year'         => 'Year',
		'create:admin:account:gender'       => 'Gender',
		'create:admin:account:male'         => 'Male',
		'create:admin:account:female'       => 'Female',
		'create:admin:account:other'        => 'Other',
		'ossn:dbsettings:desc'              => 'Enter your database credentials to connect OSSN to your server.',
		'ossn:sitesettings:desc'            => 'Configure your website name, administrator email, and system paths.',
		'ossn:datadir:desc'                 => 'Critical Security Step',
		'ossn:datadir:info'                 => 'This is where all user files, photos, and private data will be stored. <strong>This is the most important path in your installation.</strong>',
		'ossn:datadir:step1'                => 'OSSN will attempt to create this folder automatically.',
		'ossn:datadir:step2'                => 'Ensure the system has <strong>write permissions</strong> for this path.',
		'ossn:datadir:step3'                => 'For maximum security, this folder <strong>must be located outside of your public_html</strong> (web root) directory.',
		'ossn:back'                         => 'Back',
		'ossn:license:title'                => 'Software License Agreement',
		'ossn:license:desc'                 => 'Please review the terms and conditions carefully before proceeding with the installation.',
		'ossn:prerequisites:desc'           => 'Please ensure your server environment meets the following requirements before proceeding.',
		'data:directory:unabletoautocreate' => 'Unable to automatically create data directory!',
		'helpcenter'                        => 'Help Center',
);

ossn_installation_register_languages($englsih);