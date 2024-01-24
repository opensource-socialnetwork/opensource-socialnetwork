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

$ru = array(
	'ossnnotifications' => 'Уведомления',
    'ossn:notifications:comments:post' => "%s оставил комментарий к записи.",
    'ossn:notifications:like:post' => "%s полюбил вашу запись.",
    'ossn:notifications:like:annotation' => "%s полюбил ваш комментарий.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s полюбил ваше фото.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s оставил комментарий к вашей фотографии.',
    'ossn:notifications:wall:friends:tag' => '%s отметил вас в записи.',
    'ossn:notification:are:friends' => 'Вы теперь друзья!',
    'ossn:notifications:comments:post:group:wall' => "%s оставил комментарий в записи группы.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s полюбил вашу фотографию профиля.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s оставил комментарий к вашей фотографии профиля.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s полюбил вашу обложку профиля.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s оставил комментарий к вашей обложке профиля.",

    'ossn:notifications:like:post:group:wall' => '%s полюбил вашу запись.',
	
    'ossn:notification:delete:friend' => 'Запрос в друзей удалён!',
    'notifications' => 'Уведомления',
    'see:all' => 'Смотреть все',
    'friend:requests' => 'Запросы в друзья',
    'ossn:notifications:friendrequest:confirmbutton' => 'Подтвердить',
    'ossn:notifications:friendrequest:denybutton' => 'Хз кто это',
	
    'ossn:notification:mark:read:success' => 'Успешно отмечено прочитаным',
    'ossn:notification:mark:read:error' => 'Не получилось отметить как прочитаные',
    
    'ossn:notifications:mark:as:read' => 'Отметить всё как прочитаные',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Закройте окна уведомлений, щелкнув в любом месте',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> закрывает любое окно уведомлений, нажимая в любом месте на странице<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s прокомментировал фото профиля.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s прокомментировал обложку профиля.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s прокомментировал фото.',
	
	'ossn:notifications:admin:settings:checkintervals:title' => 'Время автоматической проверки уведомлений (по умолчанию 60 секунд)', 
);
ossn_register_languages('ru', $ru); 
