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
    'groups' => 'گروه‌ها',
    'add:group' => 'افزودن گروه',
    'requests' => 'درخواست‌ها',

    'members' => 'اعضا',
    'member:add:error' => 'مشکلی پیش آمد! لطفاً بعداً دوباره امتحان کنید.',
    'member:added' => 'درخواست عضویت تأیید شد!',

    'member:request:deleted' => 'درخواست عضویت رد شد!',
    'member:request:delete:fail' => 'امکان رد درخواست عضویت وجود ندارد! لطفاً بعداً دوباره امتحان کنید.',
    'membership:cancel:succes' => 'درخواست عضویت لغو شد!',
    'membership:cancel:fail' => 'امکان لغو درخواست عضویت وجود ندارد! لطفاً بعداً دوباره امتحان کنید.',

    'group:added' => 'گروه با موفقیت ایجاد شد!',
    'group:add:fail' => 'امکان ایجاد گروه وجود ندارد! لطفاً بعداً دوباره امتحان کنید.',

    'memebership:sent' => 'درخواست با موفقیت ارسال شد!',
    'memebership:sent:fail' => 'امکان ارسال درخواست وجود ندارد! لطفاً بعداً دوباره امتحان کنید.',

    'group:updated' => 'گروه به‌روزرسانی شد!',
    'group:update:fail' => 'امکان به‌روزرسانی گروه وجود ندارد! لطفاً بعداً دوباره امتحان کنید.',

    'group:name' => 'نام گروه',
    'group:desc' => 'توضیحات گروه',
    'privacy:group:public' => 'همه می‌توانند این گروه و پست‌های آن را ببینند. فقط اعضا می‌توانند در این گروه پست بگذارند.',
    'privacy:group:close' => 'همه می‌توانند این گروه را ببینند. فقط اعضا می‌توانند پست‌ها را ببینند و پست بگذارند.',

    'group:memb:remove' => 'حذف',
    'group:memb:make:owner' => 'تبدیل به مالک گروه',
    'group:memb:make:owner:confirm' => 'توجه! این اقدام، >> %s << را به مالک جدید گروه تبدیل می‌کند و شما تمام دسترسی‌های مدیریتی خود را از دست خواهید داد. آیا مطمئن هستید که می‌خواهید ادامه دهید؟',
    'group:memb:make:owner:admin:confirm' => 'توجه! این اقدام، >> %s << را به مالک جدید گروه تبدیل می‌کند و مالک قبلی تمام دسترسی‌های مدیریتی خود را از دست خواهد داد. آیا مطمئن هستید که می‌خواهید ادامه دهید؟',
    'leave:group' => 'ترک گروه',
    'join:group' => 'پیوستن به گروه',
    'total:members' => 'کل اعضا',
    'group:members' => "اعضا (%s)",
    'view:all' => 'مشاهده همه',
    'member:requests' => 'درخواست‌ها (%s)',
    'about:group' => 'درباره گروه',
    'cancel:membership' => 'لغو عضویت',

    'no:requests' => 'درخواستی وجود ندارد',
    'approve' => 'تأیید',
    'decline' => 'رد کردن',
    'search:groups' => 'جستجوی گروه‌ها',

    'close:group:notice' => 'برای مشاهده پست‌ها، عکس‌ها و نظرات این گروه عضو شوید.',
    'closed:group' => 'گروه بسته',
    'group:admin' => 'مدیر',

    'title:access:private:group' => 'پست گروه',

	// #186 group join request message var1 = user, var2 = name of group
    'ossn:notifications:group:joinrequest' => '%s درخواست عضویت در گروه %s را داده است',
    'ossn:group:by' => 'توسط:',

    'group:deleted' => 'گروه و محتوای آن حذف شد',
    'group:delete:fail' => 'امکان حذف گروه وجود ندارد',

    'group:delete:cover' => 'حذف تصویر کاور',
    'group:delete:cover:error' => 'خطایی در هنگام حذف تصویر کاور رخ داد',
    'group:delete:cover:success' => 'تصویر کاور با موفقیت حذف شد',

);
ossn_register_languages('fa', $fa);
