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
    'groups' => 'קבוצות',
    'add:group' => 'הוספת קבוצה',
    'requests' => 'בקשות',

    'members' => 'חברים',
    'member:add:error' => 'משהו לא תקין, נסו שוב מאוחר יותר.',
    'member:added' => 'בקשת חברות אושרה!',

    'member:request:deleted' => 'בקשת חברות לא אושרה!',
    'member:request:delete:fail' => 'לא ניתן לפסול בקשת חברות, נסו שוב מאוחר יותר.',
    'membership:cancel:succes' => 'בקשת חברות בוטליה!',
    'membership:cancel:fail' => 'לא ניתן לבטל בקשת חברות! נסו שוב מאוחר יותר.',

    'group:added' => 'הקבוצה נוצרה בהצלחה!',
    'group:add:fail' => 'לא ניתן ליצור קבוצה! נסו שוב מאוחר יותר.',

    'memebership:sent' => 'הבקשה נשלחה בהצלחה!',
    'memebership:sent:fail' => 'לא ניתן לשלוח בקשה! נסו שוב מאוחר יותר.',

    'group:updated' => 'הקבוצה עודכנה!',
    'group:update:fail' => 'לא ניתן לעדכן קבוצה, נסו שוב מאוחר יותר.',

    'group:name' => 'שם קבוצה',
    'group:desc' => 'תיאור קבוצה',
    'privacy:group:public' => 'כל אחד יכול לראות את הקבוצה והפוסטים שבה. רק חברים יכולים לכתוב בקבוצה',
    'privacy:group:close' => 'כולם יכולים לראות את הקבוצה, רק חברים יכולים לכתוב ולראות פוסטים',

    'group:memb:remove' => 'הסרה',
    'leave:group' => 'עזוב קבוצה',
    'join:group' => 'הצטרף לקבוצה',
    'total:members' => 'סך הכל חברים',
    'group:members' => "חברים (%s)",
    'view:all' => 'הצג הכל',
    'member:requests' => 'בקשות (%s)',
    'about:group' => 'אודות הקבוצה',
    'cancel:membership' => 'ביטול חברות',

    'no:requests' => 'אין בקשות',
    'approve' => 'אישור',
    'decline' => 'דחייה',
    'search:groups' => 'חיפוש קבוצות',

    'close:group:notice' => 'יש להצטרף לקבוצה זו על מנת לראות פוסטים, תמונות ותגובות.',
    'closed:group' => 'קבוצה סגורה',
    'group:admin' => 'מנהל',
	
	'title:access:private:group' => 'פוסט בקבוצה',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s ביקש להצטרף לקבוצה %s',
	'ossn:group:by' => 'על ידי:',
	
	'group:deleted' => 'הקבוצה ותוכנה נמחקו',
	'group:delete:fail' => 'לא ניתן למחוק קבוצה',	

 	'group:delete:cover' => 'מחק את תמונת הכותרת',
	'group:delete:cover:error' => 'אירעה שגיאה בעת מחיקת תמונת השער',
	'group:delete:cover:success' => 'תמונת השער נמחקה בהצלחה',
	
	//need translation
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',	
);
ossn_register_languages('he', $he); 
