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
$he = array(
	'ossnads'                       => 'מנהל המודעות',
	'fields:required'               => 'כל השדות הם שדות חובה!',
	'ad:created'                    => 'המודעה נוצרה בהצלחה!',
	'ad:create:fail'                => 'לא ניתן ליצור את המודעה!',
	'ad:title'                      => 'כותרת',
	'ad:site:url'                   => 'כתובת האתר (URL)',
	'ad:desc'                       => 'תיאור',
	'ad:browse'                     => 'עיון',
	'ad:clicks'                     => 'קליקים',
	'sponsored'                     => 'ממומן',
	'ad:deleted'                    => "המודעה עם הכותרת '%s' נמחקה בהצלחה.",
	'ad:delete:fail'                => 'לא ניתן למחוק את המודעה! אנא נסה שוב מאוחר יותר.',
	'ad:edited'                     => 'המודעה עודכנה בהצלחה.',
	'ad:edit:fail'                  => 'לא ניתן לערוך את המודעה! אנא נסה שוב מאוחר יותר.',
	'ads:manager'                   => 'מנהל פרסום',
	'ads:boost:community'           => 'קדם את הקהילה שלך. צור קמפיין מודעות חדש או נהל את הקמפיינים הקיימים.',
	'ads:create'                    => 'צור מודעה',

	'ad:placement'                  => 'מיקומי תצוגה',
	'ad:gender:target'              => 'מיקוד דמוגרפי לפי מגדר',
	'ad:end:date'                   => 'תאריך תפוגת הקמפיין (אופציונלי)',
	'ad:photo'                      => 'קובץ תמונת הבאנר',
	'add'                           => 'צור קמפיין',

	'ad:placement:newsfeed'         => 'פיד פעילות (סרגל צד)',
	'ad:placement:profile'          => 'פרופילי משתמשים (סרגל צד)',
	'ad:placement:groups'           => 'דפי קבוצות (סרגל צד)',
	'ad:placement:global'           => 'כל שאר סרגלי הצד של ערכת הנושא (גלובלי)',

	'ad:file:choose'                => 'בחר או גרור את תמונת המודעה לכאן...',
	'ad:file:restriction'           => 'קבצי תמונה בלבד (PNG, JPG, WebP)',
	'ad:file:remove'                => 'הסר תמונה',
	'ad:char:left'                  => 'נותרו %s תווים',
	'ad:status:expired'             => 'פג תוקף',
	'ad:status:active'              => 'פעיל',
	'ad:views'                      => 'צפיות',
	'ad:status'                     => 'סטטוס',
	'ad:end:date:infinity'          => 'ללא הגבלה',

	//cron
	'ossn:adscron:title'            => 'הגדרת חובה: אוטומציה של תפוגת מודעות',
	'ossn:adscron:last:run'         => 'הפעלה אחרונה של Cron:',
	'ossn:adscron:never'            => 'אף פעם',
	'ossn:adscron:configure'        => 'הגדר',
	'ossn:adscron:description'      => 'כדי לשנות באופן אוטומטי את סטטוס המודעות ל-%s, עליך להגדיר משימת cron במערכת שתפעל פעם ביום בצהריים (12:00 PM).',
	'ossn:adscron:expired'          => 'פג תוקף',
	'ossn:adscron:command:label'    => 'פקודת Crontab',
	'ossn:adscron:path:placeholder' => 'נתיב_ה-PHP_של_השרת_שלך',
	'ossn:adscron:warning:title'    => 'הודעה חשובה:',
	'ossn:adscron:warning:text'     => 'ברגע שתוקף המודעה פג, היא %s. על המפרסמים ליצור מודעה חדשה מאפס.',
	'ossn:adscron:cannot:edit'      => 'אינה ניתנת לעריכה או לחידוש',
);
ossn_register_languages('he', $he);