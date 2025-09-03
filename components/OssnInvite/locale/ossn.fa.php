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
	'com:ossn:invite' => 'دعوت کردن',
	'com:ossn:invite:friends' => 'دعوت از دوستان',
	'com:ossn:invite:friends:note' => 'برای دعوت از دوستان جهت پیوستن به این شبکه، آدرس‌های ایمیل آن‌ها و یک پیام کوتاه وارد کنید. آن‌ها یک ایمیل حاوی دعوت‌نامه شما دریافت خواهند کرد.',
	'com:ossn:invite:emails:note' => 'آدرس‌های ایمیل (با کاما از هم جدا کنید)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'پیام',

    	'com:ossn:invite:mail:subject' => 'دعوت‌نامه برای پیوستن به %s',
    	'com:ossn:invite:mail:message' => 'شما توسط %s به پیوستن به %s دعوت شده‌اید. پیام زیر برای شما ارسال شده است:

%s

برای پیوستن، روی لینک زیر کلیک کنید:

%s

لینک پروفایل: %s',

'com:ossn:invite:mail:message:default' => 'سلام،

من می‌خواستم شما را به پیوستن به شبکه من در %s دعوت کنم.

لینک پروفایل: %s

با احترام،
%s',
	'com:ossn:invite:sent' => 'دوستان شما دعوت شدند. دعوت‌نامه‌های ارسال‌شده: %s.',
	'com:ossn:invite:wrong:emails' => 'آدرس‌های زیر نامعتبر هستند: %s.',
	'com:ossn:invite:sent:failed' => 'امکان دعوت از آدرس‌های زیر وجود ندارد: %s.',
	'com:ossn:invite:already:members' => 'آدرس‌های زیر قبلاً عضو شده‌اند: %s',
	'com:ossn:invite:empty:emails' => 'لطفاً حداقل یک آدرس ایمیل وارد کنید',
);
ossn_register_languages('fa', $fa);
