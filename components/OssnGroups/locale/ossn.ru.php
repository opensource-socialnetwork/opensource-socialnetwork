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
$ru = array(
    'groups' => 'Группы',
    'add:group' => 'Добавить группы',
    'requests' => 'Запросы',

    'members' => 'Члены',
    'member:add:error' => 'Что-то пошлло не так! Повторите позже.',
    'member:added' => 'Членство одобрено!',

    'member:request:deleted' => 'Членство отклонено!',
    'member:request:delete:fail' => 'Не получилось отклонить членство. Попробуйте позже.',
    'membership:cancel:succes' => 'Членство отменено!',
    'membership:cancel:fail' => 'Не получилось отменить членство. Попробуйте позже.',

    'group:added' => 'Группа успешно создана!',
    'group:add:fail' => 'Не получилось создать группу. Попробуйте позже.',

    'memebership:sent' => 'Запрос успешно отправлен!',
    'memebership:sent:fail' => 'Не получилось отправить запрос. Попробуйте позже',

    'group:updated' => 'Группа обновлена!',
    'group:update:fail' => 'Не получилось обновить группу. Попробуйте позже.',

    'group:name' => 'Название группы',
    'group:desc' => 'Описание группы',
    'privacy:group:public' => 'Все могут видеть записи группы. Только члены группы могут делать записи в группу.',
    'privacy:group:close' => 'Все видят группу. Только члены группы могут писать и видеть записи.',

    'group:memb:remove' => 'Удалить',
    'leave:group' => 'Покинуть группу',
    'join:group' => 'Присоединиться',
    'total:members' => 'Всего членов',
    'group:members' => "Члены (%s)",
    'view:all' => 'Посмотреть всех',
    'member:requests' => 'Запросы (%s)',
    'about:group' => 'Группа о',
    'cancel:membership' => 'Отозвать членство',

    'no:requests' => 'Нет запросов',
    'approve' => 'Утвердить',
    'decline' => 'Запретить',
    'search:groups' => 'Поиск групп',

    'close:group:notice' => 'Присоединиться к группе чтобы смотреть записи, фотографии и комментарии.',
    'closed:group' => 'Закрытая группа',
    'group:admin' => 'Администратор',
	
	'title:access:private:group' => 'Записи группы',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s запросил доступ к %s',
	'ossn:group:by' => 'От:',
	
	'group:deleted' => 'Группа и её содержимое удалены',
	'group:delete:fail' => 'Группа не может быть удалена',	

	'group:delete:cover' => 'удалить обложку',
	'group:delete:cover:error' => 'При удалении изображения обложки произошла ошибка',
	'group:delete:cover:success' => 'Изображение на обложке было успешно удалено',

	//need translation
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',	
);
ossn_register_languages('ru', $ru); 
