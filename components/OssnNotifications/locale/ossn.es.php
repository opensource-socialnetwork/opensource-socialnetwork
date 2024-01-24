<?php
/**
 * Open Source Social Network
 *
 * Translated by Zaturnay - https://zaturnay.com.ve
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$es = array(
	'ossnnotifications' => 'Notificaciones',
    'ossn:notifications:comments:post' => "%s comentó en el post.",
    'ossn:notifications:like:post' => "%s me ha gustado tu publicación.",
    'ossn:notifications:like:annotation' => "%s me gustó tu comentario",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s me gustó tu foto.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s ha comentado tu foto.',
    'ossn:notifications:wall:friends:tag' => '%s te etiquetó en una publicación.',
    'ossn:notification:are:friends' => '¡Ahora son amigos!',
    'ossn:notifications:comments:post:group:wall' => "%s comentó la publicación del grupo.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s me gustó tu foto de perfil",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s comentó tu foto de perfil.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s le gustó tu portada del perfil.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s ha comentado en tu portada del perfil.",

    'ossn:notifications:like:post:group:wall' => '%s me ha gustado tu publicación.',
	
    'ossn:notification:delete:friend' => '¡Petición de amigo suprimida!',
    'notifications' => 'Notificaciones',
    'see:all' => 'Ver todo',
    'friend:requests' => 'Solicitudes de Amistad',
    'ossn:notifications:friendrequest:confirmbutton' => 'Confirmar',
    'ossn:notifications:friendrequest:denybutton' => 'Rechazar',
	
    'ossn:notification:mark:read:success' => 'Marcado correctamente como leído',
    'ossn:notification:mark:read:error' => 'No se puede marcar todo como leído',
    
    'ossn:notifications:mark:as:read' => 'Marcar todo como leido',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Cierre las ventanas de notificación haciendo clic en cualquier lugar',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> cierra cualquier ventana de notificación haciendo clic en cualquier lugar de la página<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s comentó en la foto de perfil.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s comentó en la portada del perfil.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s comentó en la foto.',		
	
	'ossn:notifications:admin:settings:checkintervals:title' => 'Tiempo de verificación automática de notificaciones (predeterminado 60 segundos)', 	
);
ossn_register_languages('es', $es); 
