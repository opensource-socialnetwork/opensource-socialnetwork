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
	'ossnads'                       => 'Менеджер рекламы',
	'fields:required'               => 'Все поля обязательны для заполнения!',
	'ad:created'                    => 'Объявление успешно создано!',
	'ad:create:fail'                => 'Не удалось создать объявление!',
	'ad:title'                      => 'Название',
	'ad:site:url'                   => 'URL сайта',
	'ad:desc'                       => 'Описание',
	'ad:browse'                     => 'Обзор',
	'ad:clicks'                     => 'Клики',
	'sponsored'                     => 'РЕКЛАМА',
	'ad:deleted'                    => "Объявление с названием '%s' было успешно удалено.",
	'ad:delete:fail'                => 'Не удалось удалить объявление! Пожалуйста, попробуйте позже.',
	'ad:edited'                     => 'Объявление успешно изменено.',
	'ad:edit:fail'                  => 'Не удалось отредактировать объявление! Пожалуйста, попробуйте позже.',
	'ads:manager'                   => 'Управление рекламой',
	'ads:boost:community'           => 'Развивайте свое сообщество. Создайте новую рекламную кампанию или управляйте существующими.',
	'ads:create'                    => 'Создать объявление',

	'ad:placement'                  => 'Места размещения рекламы',
	'ad:gender:target'              => 'Демографический таргетинг по полу',
	'ad:end:date'                   => 'Дата окончания кампании (необязательно)',
	'ad:photo'                      => 'Изображение баннера',
	'add'                           => 'Создать кампанию',

	'ad:placement:newsfeed'         => 'Лента активности (боковая панель)',
	'ad:placement:profile'          => 'Профили пользователей (боковая панель)',
	'ad:placement:groups'           => 'Страницы групп (боковая панель)',
	'ad:placement:global'           => 'Боковые панели всех остальных тем (глобально)',

	'ad:file:choose'                => 'Выберите или перетащите изображение объявления сюда...',
	'ad:file:restriction'           => 'Разрешены только файлы изображений (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Удалить изображение',
	'ad:char:left'                  => 'Осталось символов: %s',
	'ad:status:expired'             => 'Истек срок действия',
	'ad:status:active'              => 'Активно',
	'ad:views'                      => 'Просмотры',
	'ad:status'                     => 'Статус',
	'ad:end:date:infinity'          => 'Никогда',

	//cron
	'ossn:adscron:title'            => 'Обязательная настройка: автоматическое завершение рекламы',
	'ossn:adscron:last:run'         => 'Последний запуск Cron:',
	'ossn:adscron:never'            => 'Никогда',
	'ossn:adscron:configure'        => 'Настроить',
	'ossn:adscron:description'      => 'Чтобы автоматически изменять статус объявлений на %s, необходимо настроить системную задачу cron для запуска один раз в день в полдень (12:00).',
	'ossn:adscron:expired'          => 'Истек срок действия',
	'ossn:adscron:command:label'    => 'Команда Crontab',
	'ossn:adscron:path:placeholder' => 'ПУТЬ_К_PHP_НА_ВАШЕМ_СЕРВЕРЕ',
	'ossn:adscron:warning:title'    => 'Важное примечание:',
	'ossn:adscron:warning:text'     => 'Как только срок действия объявления истекает, оно %s. Рекламодателям необходимо создавать новое объявление с нуля.',
	'ossn:adscron:cannot:edit'      => 'не может быть отредактировано или продлено',
);
ossn_register_languages('ru', $ru);