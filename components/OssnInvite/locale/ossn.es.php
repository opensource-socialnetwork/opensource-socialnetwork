<?php
/**
 * Open Source Social Network
 *
 * Translated by Zaturnay - https://zaturnay.com.ve
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$es = array(
	'com:ossn:invite' => 'Invitar',			
	'com:ossn:invite:friends' => 'Invitar Amigos',
	'com:ossn:invite:friends:note' => 'Para invitar amigos a unirse a usted en esta red, ingrese sus direcciones de correo electrónico y un breve mensaje. Recibirán un correo electrónico con su invitación.',
	'com:ossn:invite:emails:note' => 'Direcciones de correo electrónico (separadas por una coma)',
	'com:ossn:invite:emails:placeholder' => 'yaneth@example.com, edward@example.com',
	'com:ossn:invite:message' => 'Mensaje',
		
    	'com:ossn:invite:mail:subject' => 'Invitación a unirse a %s',	
    	'com:ossn:invite:mail:message' => 'Has sido invitado a unirte %s por %s. Incluyeron el siguiente mensaje:

%s

Para unirse, haga clic en el siguiente enlace:

%s

Enlace del perfil: %s
',	
	'com:ossn:invite:mail:message:default' => 'Hola,

Quería invitarte a unirte a mi red aquí en %s.

Enlace de perfil : %s

Atentamente.
%s',
	'com:ossn:invite:sent' => 'Sus amigos fueron invitados. Invitaciones enviadas: %s.',
	'com:ossn:invite:wrong:emails' => 'Las siguientes direcciones no son válidas: %s.',
	'com:ossn:invite:sent:failed' => 'No se pueden invitar a las siguientes direcciones: %s.',
	'com:ossn:invite:already:members' => 'Las siguientes direcciones ya son miembros: %s',
	'com:ossn:invite:empty:emails' => 'Agregue al menos una dirección de correo electrónico',
);
ossn_register_languages('es', $es); 
