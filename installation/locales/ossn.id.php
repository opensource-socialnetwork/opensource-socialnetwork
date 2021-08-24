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


$indonesian = array(
	'site:settings' => 'Pengaturan Situs',
	'ossn:installed' => 'Install',
	'ossn:installation' => 'Instalasi',
	'ossn:check' => 'Mengesahkan',
	'ossn:installed' => 'Install',
	'ossn:installed:message' => 'Open Source Social Network telah terinstall.',
    'ossn:prerequisites' => 'Prasyarat Install',
    'ossn:settings' => 'Pengaturan Server',
    'ossn:dbsettings' => 'Database',
	'ossn:dbuser' => 'User Database',
	'ossn:dbpassword' => 'Password Database',
	'ossn:dbname' => 'Nama Database',
	'ossn:dbhost' => 'Host Database',
    'ossn:sitesettings' => 'Situs',
    'ossn:websitename' => 'Nama Situs',
    'ossn:mainsettings' => 'Paths',
	'ossn:weburl' => 'OssnSite Url',
	'installation:notes' => 'Direktori data berisi file pengguna. Direktori data harus terletak di luar jalur instalasi OSSN.',
	'ossn:datadir' => 'Direktori Data',
	'owner_email' => 'Email Pemilik Situs',
	'notification_email' => 'Email Pemberitahuan (noreply@domain.com)',
	'create:admin:account' => 'Buat Akun Admin',
	'ossn:setting:account' => 'Pengaturan Akun',
	
	'data:directory:invalid' => 'Direktori data atau direktori tidak valid tidak dapat dibuat.',	
	'data:directory:outside' => 'Direktori data harus berada di luar jalur instalasi.',
	'all:files:required' => 'Semua file wajib diisi! Silakan cek kembali file Anda.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Anda memiliki PHP versi lama " . PHP_VERSION . " Anda membutuhkan PHP versi 7.0 atau 7.x",
	
	'ossn:install:mysqli' => 'MYSQLI DIAKTIFKAN',
	'ossn:install:mysqli:required' => 'PHP EXSENSION MYSQLI DIBUTUHKAN',
	
	'ossn:install:apache' => 'APACHE DIAKTIFKAN',
	'ossn:install:apache:required' => 'APACHE DIBUTUHKAN',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE DIBUTUHKAN',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL DIBUTUHKAN',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY DIBUTUHKAN',
	
	'ossn:install:config' => 'CONFIGURATION DIRECTORY WRITEABLE',
	'ossn:install:config:error' => 'DIREKTUR KONFIGURASI TIDAK DITULIS',
	
	'ossn:install:next' => 'Lanjut',
    'ossn:install:install' => 'Install',
    'ossn:install:create' => 'Buat',
    'ossn:install:finish' => 'Selesai',
	
	'fields:require' => 'Semua bidang yang diperlukan!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen ENABLED',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen dibutuhkan',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive ENABLED',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSION DIBUTUHKAN',
	'ossn:install:cachedir:note:failed' => 'Make sure yoPastikan file dan direktori Anda dimiliki oleh pengguna apache yang benar.',	
);

ossn_installation_register_languages($indonesian);
