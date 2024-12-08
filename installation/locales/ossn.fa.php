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


$persian = array(
	'site:settings' => 'تنظیمات سایت',
	'ossn:installed' => 'نصب شده',
	'ossn:installation' => 'نصب',
	'ossn:check' => 'بررسی',
	'ossn:installed:message' => 'شبکه اجتماعی متن‌باز با موفقیت نصب شد.',
	'ossn:prerequisites' => 'پیش‌نیازهای نصب',
	'ossn:settings' => 'تنظیمات سرور',
	'ossn:dbsettings' => 'پایگاه داده',
	'ossn:dbuser' => 'کاربر پایگاه داده',
	'ossn:dbpassword' => 'رمز عبور پایگاه داده',
	'ossn:dbname' => 'نام پایگاه داده',
	'ossn:dbhost' => 'میزبان پایگاه داده',
	'ossn:sitesettings' => 'وب‌سایت',
	'ossn:websitename' => 'نام وب‌سایت',
	'ossn:mainsettings' => 'مسیرها',
	'ossn:weburl' => 'آدرس سایت OSSN',
	'installation:notes' => 'پوشه داده‌ها شامل فایل‌های کاربران است. این پوشه باید خارج از مسیر نصب OSSN قرار داشته باشد.',
	'ossn:datadir' => 'پوشه داده‌ها',
	'owner_email' => 'ایمیل مالک سایت',
	'notification_email' => 'ایمیل اعلان (noreply@domain.com)',
	'create:admin:account' => 'ایجاد حساب مدیر',
	'ossn:setting:account' => 'تنظیمات حساب',

	'data:directory:invalid' => 'پوشه داده‌ها نامعتبر است یا قابلیت نوشتن ندارد.',
	'data:directory:outside' => 'پوشه داده‌ها باید خارج از مسیر نصب باشد.',
	'all:files:required' => 'تمام فایل‌ها الزامی هستند! لطفاً فایل‌های خود را بررسی کنید.',

	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "شما از نسخه قدیمی PHP " . PHP_VERSION . " استفاده می‌کنید. حداقل به PHP نسخه 8.0 یا 8.x نیاز دارید.",

	'ossn:install:mysqli' => 'MYSQLI فعال است',
	'ossn:install:mysqli:required' => 'افزونه MYSQLI PHP مورد نیاز است',

	'ossn:install:apache' => 'APACHE فعال است',
	'ossn:install:apache:required' => 'APACHE مورد نیاز است',

	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE مورد نیاز است',

	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'افزونه PHP CURL مورد نیاز است',

	'ossn:install:gd' => 'کتابخانه PHP GD',
	'ossn:install:gd:required' => 'کتابخانه PHP GD مورد نیاز است',

	'ossn:install:config' => 'پوشه تنظیمات قابل نوشتن است',
	'ossn:install:config:error' => 'پوشه تنظیمات قابل نوشتن نیست',

	'ossn:install:next' => 'بعدی',
	'ossn:install:install' => 'نصب',
	'ossn:install:create' => 'ایجاد',
	'ossn:install:finish' => 'پایان',

	'fields:require' => 'همه فیلدها الزامی هستند!',

	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen فعال است',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen مورد نیاز است',

	'ossn:install:ziparchive' => 'PHP ZipArchive فعال است',
	'ossn:install:ziparchive:error' => 'افزونه PHP ZipArchive مورد نیاز است',

	'ossn:install:cachedir:note:failed' => 'مطمئن شوید که فایل‌ها و پوشه‌های شما متعلق به کاربر صحیح آپاچی هستند.',
);

ossn_installation_register_languages($persian);
