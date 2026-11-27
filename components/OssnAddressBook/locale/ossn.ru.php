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
		'ossnaddressbook:menu'               => 'Адресная книга',
		'ossnaddressbook:title'              => 'Адресная книга',
		'ossnaddressbook:subtitle:contacts'  => 'контактов',
		'ossnaddressbook:subtitle:favorites' => 'избранных',
		'ossnaddressbook:search:placeholder' => 'Поиск контактов по имени, телефону, e-mail или компании...',
		'ossnaddressbook:add'                => 'Добавить контакт',
		'ossnaddressbook:add:toggle'         => 'Новый контакт',
		'ossnaddressbook:name:placeholder'   => 'Полное имя *',
		'ossnaddressbook:phone:placeholder'  => 'Телефон / WhatsApp',
		'ossnaddressbook:email:placeholder'  => 'Адрес электронной почты',
		'ossnaddressbook:company:placeholder' => 'Компания / Организация',
		'ossnaddressbook:address:placeholder' => 'Адрес / Город',
		'ossnaddressbook:note:placeholder'   => 'Личные заметки (необязательно)...',
		'ossnaddressbook:category'           => 'Группа',
		'ossnaddressbook:category:all'       => 'Все',
		'ossnaddressbook:category:favorites' => 'Избранные',
		'ossnaddressbook:category:personal'  => 'Личные',
		'ossnaddressbook:category:work'      => 'Работа',
		'ossnaddressbook:category:family'    => 'Семья',
		'ossnaddressbook:category:other'     => 'Другое',
		'ossnaddressbook:favorite'           => 'Избранное',
		'ossnaddressbook:edit'               => 'Редактировать',
		'ossnaddressbook:save'               => 'Сохранить',
		'ossnaddressbook:cancel'             => 'Отмена',
		'ossnaddressbook:delete'             => 'Удалить',
		'ossnaddressbook:delete:all'         => 'Удалить все',
		'ossnaddressbook:delete:all:confirm' => 'Вы уверены, что хотите удалить все контакты? Это действие нельзя отменить.',
		'ossnaddressbook:empty'              => 'Ваша адресная книга пуста. Добавьте свой первый контакт выше!',
		'ossnaddressbook:add:error'          => 'Не удалось добавить контакт. Пожалуйста, введите имя.',
		'ossnaddressbook:edit:error'         => 'Не удалось обновить контакт.',
		'ossnaddressbook:delete:error'       => 'Не удалось удалить контакт.',
		'ossnaddressbook:import'             => 'Импорт',
		'ossnaddressbook:export:csv'         => 'Экспорт в CSV',
		'ossnaddressbook:export:vcf'         => 'Экспорт в vCard',
		'ossnaddressbook:import:success'     => 'Контактов успешно импортировано: %s.',
		'ossnaddressbook:import:error'       => 'Выберите файл CSV или vCard (.vcf) для импорта.',
		'ossnaddressbook:import:invalid'     => 'Неподдерживаемый формат файла. Допускаются только файлы .csv и .vcf.',
		'ossnaddressbook:import:empty'       => 'В загруженном файле не найдено допустимых контактов.',
);
ossn_register_languages('ru', $ru);
