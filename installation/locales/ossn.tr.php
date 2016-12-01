<?php
/**
 * Open Source Social Network
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$turkish = array(
	'site:settings' => 'Site Ayarları',
	'ossn:installed' => 'Yüklendi',
	'ossn:installation' => 'Yükleyici',
	'ossn:check' => 'Doğrulama',
	'ossn:installed' =>'Yüklendi',
	'ossn:installed:message' => 'Siteniz yüklendi ve kullanıma hazır.',
    'ossn:prerequisites' => 'Yükleme Koşulları',
    'ossn:settings' => 'Host Ayarları',
    'ossn:dbsettings' => 'Veritabanı (MySQL)',
	'ossn:dbuser' => 'Veritabanı Kullanıcısı',
	'ossn:dbpassword' => 'Veritabanı Şifresi',
	'ossn:dbname' => 'Veritabanı Adı',
	'ossn:dbhost' => 'Veritabanı Hostu',
    'ossn:sitesettings' => 'Site',
    'ossn:websitename' => 'Site Adı',
    'ossn:mainsettings' => 'Yol',
	'ossn:weburl' => 'Site Adresi (URL)',
	'installation:notes' => 'Veri dizini, kullanıcı dosyalarını içerir. Veri dizini, servis sağlayan yükleme yolu dışında yer almalıdır. (Ana dizinde "ossn_data" adında klasör oluşturun.)',
	'ossn:datadir' => 'Veri Dizini',
	'owner_email' => 'Sizin E-postanız',
	'notification_email' => 'Bildirim E-postası (Örneğin: noreply@domain.com)',
	'create:admin:account' => 'Admin Hesabı Oluştur',
	'ossn:setting:account' => 'Hesap Ayarları',
	
	'data:directory:invalid' => 'Geçersiz veri dizini veya dizin yazılabilir değil.',	
	'data:directory:outside' => 'Veri yükleme dizini yolu dışında olmalıdır.',
	'all:files:required' => 'Tüm dosyalar gerekli! Lütfen dosyaları kontrol edin.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Esk bir PHP versiyonuna (" . PHP_VERSION . ") sahipsiniz. Minimum PHP versiyonu 5.4 olmalıdır.",
	
	'ossn:install:mysqli' => 'MySQL etkin',
	'ossn:install:mysqli:required' => 'MySQL PHP  uzatma gerekli',
	
	'ossn:install:apache' => 'Apache etkin',
	'ossn:install:apache:required' => 'Apache gerekli',
	
	'ossn:install:modrewrite' => 'Mod_Rewrite',
	'ossn:install:modrewrite:required' => 'Mod_Rewrite gerekli',
	
	'ossn:install:curl' => 'PHP Curl',
	'ossn:install:curl:required' => 'PHP Curl gerekli',
	
	'ossn:install:gd' => 'PHP Gd Library',
	'ossn:install:gd:required' => 'PHP Gd Library gerekli',
	
	'ossn:install:config' => 'Yapılandırma Klasörü Yazılabilir',
	'ossn:install:config:error' => 'Yapılandırma Klasörü yazılabilir değil',
	
	'ossn:install:next' => 'İleri',
    'ossn:install:install' => 'Yükle',
    'ossn:install:create' => 'Oluştur',
    'ossn:install:finish' => 'Son - Tamamla',
	
	'fields:require' => 'Tüm alanlar zorunludur!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen ENABLED',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen is required',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive ENABLED',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSION REQUIRED',
);

ossn_installation_register_languages($turkish);
