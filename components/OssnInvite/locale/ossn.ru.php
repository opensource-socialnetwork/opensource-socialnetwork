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
	'com:ossn:invite' => 'Приглашения',			
	'com:ossn:invite:friends' => 'Пригласить друзей',
	'com:ossn:invite:friends:note' => 'Чтобы пригласить друзей, введите их электронную почту и короткое сообщение. Они получат приглашения на почту.',
	'com:ossn:invite:emails:note' => 'Электронные ящики разделённые запятой',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'Сообщение',
		
    	'com:ossn:invite:mail:subject' => 'Приглашение присоединиться к %s',	
    	'com:ossn:invite:mail:message' => ' %s пригласил вас присоединиться к %s. Он написало следующее сообщение:

%s

Нажми на ссылку:

%s

Ссылка на профиль: %s
',	
	'com:ossn:invite:mail:message:default' => 'Привет,

Я хочу чтобы ты заценил %s.

Ссылка на профиль : %s

Чмоки.
%s',
	'com:ossn:invite:sent' => 'Ваши друзья были приглашены. Преглашения отправил: %s.',
	'com:ossn:invite:wrong:emails' => 'Следующие электронные адреса неправильные: %s.',
	'com:ossn:invite:sent:failed' => 'Не получилось пригласить следующих товарищей: %s.',
	'com:ossn:invite:already:members' => 'Следующее товарищи уже здесь: %s',
	'com:ossn:invite:empty:emails' => 'Пожалуйста, добавьте хотя бы один электронный ящик',
);
ossn_register_languages('ru', $ru); 
