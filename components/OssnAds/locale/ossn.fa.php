<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$fa = array(
	'ossnads'                       => 'مدیریت تبلیغات',
	'fields:required'               => 'پر کردن همه فیلدها الزامی است!',
	'ad:created'                    => 'تبلیغ با موفقیت ایجاد شد!',
	'ad:create:fail'                => 'امکان ایجاد تبلیغ وجود ندارد!',
	'ad:title'                      => 'عنوان',
	'ad:site:url'                   => 'آدرس سایت (URL)',
	'ad:desc'                       => 'توضیحات',
	'ad:browse'                     => 'انتخاب فایل',
	'ad:clicks'                     => 'کلیک‌ها',
	'sponsored'                     => 'حامی مالی',
	'ad:deleted'                    => "تبلیغ با عنوان '%s' با موفقیت حذف شد.",
	'ad:delete:fail'                => 'امکان حذف تبلیغ وجود ندارد! لطفاً بعداً دوباره تلاش کنید.',
	'ad:edited'                     => 'تبلیغ با موفقیت ویرایش شد.',
	'ad:edit:fail'                  => 'امکان ویرایش تبلیغ وجود ندارد! لطفاً بعداً دوباره تلاش کنید.',
	'ads:manager'                   => 'مدیریت تبلیغات',
	'ads:boost:community'           => 'جامعه کاربری خود را تقویت کنید. یک کمپین تبلیغاتی جدید ایجاد کنید یا کمپین‌های موجود را مدیریت کنید.',
	'ads:create'                    => 'ایجاد تبلیغ',

	'ad:placement'                  => 'محل‌های نمایش تبلیغ',
	'ad:gender:target'              => 'هدف‌گیری دموگرافیک بر اساس جنسیت',
	'ad:end:date'                   => 'تاریخ انقضای کمپین (اختیاری)',
	'ad:photo'                      => 'تصویر بنر تبلیغاتی',
	'add'                           => 'ایجاد کمپین',

	'ad:placement:newsfeed'         => 'فید فعالیت‌ها (نوار کناری)',
	'ad:placement:profile'          => 'پروفایل کاربران (نوار کناری)',
	'ad:placement:groups'           => 'صفحات گروه‌ها (نوار کناری)',
	'ad:placement:global'           => 'نوار کناری تمامی بخش‌های دیگر پوسته (سراسری)',

	'ad:file:choose'                => 'تصویر تبلیغ را انتخاب کنید یا آن را به این‌جا بکشید...',
	'ad:file:restriction'           => 'فقط فایل‌های تصویری مجاز هستند (PNG, JPG, WebP)',
	'ad:file:remove'                => 'حذف تصویر',
	'ad:char:left'                  => '%s کاراکتر باقی‌مانده',
	'ad:status:expired'             => 'منقضی شده',
	'ad:status:active'              => 'فعال',
	'ad:views'                      => 'بازدیدها',
	'ad:status'                     => 'وضعیت',
	'ad:end:date:infinity'          => 'هرگز',

	//cron
	'ossn:adscron:title'            => 'تنظیمات الزامی: خودکارسازی انقضای تبلیغات',
	'ossn:adscron:last:run'         => 'آخرین اجرای کرون (Cron):',
	'ossn:adscron:never'            => 'هرگز',
	'ossn:adscron:configure'        => 'پیکربندی',
	'ossn:adscron:description'      => 'برای تغییر خودکار وضعیت تبلیغات به %s، باید یک کرون‌جاب (Cron Job) سیستمی تنظیم کنید تا یک بار در روز در ظهر (ساعت ۱۲:۰۰ بعد از ظهر) اجرا شود.',
	'ossn:adscron:expired'          => 'منقضی شده',
	'ossn:adscron:command:label'    => 'دستور Crontab',
	'ossn:adscron:path:placeholder' => 'YOUR_SERVER_PHP_PATH',
	'ossn:adscron:warning:title'    => 'نکته مهم:',
	'ossn:adscron:warning:text'     => 'هنگامی که یک تبلیغ منقضی می‌شود، %s. تبلیغ‌کنندگان باید یک تبلیغ جدید را از ابتدا ایجاد کنند.',
	'ossn:adscron:cannot:edit'      => 'دیگر قابل ویرایش یا تمدید نیست',
);
ossn_register_languages('fa', $fa);