<?php
/**
 * Open Source Social Network
 *
 * @package   (Informatikon.com).ossn
 * @author    OSSN Core Team <info@opensource-socialnetwork.org>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */

$pt = array(
	'ossnnotifications' => 'Notificações',
    'ossn:notifications:comments:post' => "%s comentou sua postagem.",
    'ossn:notifications:like:post' => "%s curtiu sua postagem.",
    'ossn:notifications:like:annotation' => "%s curtiu seu comentário.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s curtiu sua foto.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s comentou sua foto.',
    'ossn:notifications:wall:friends:tag' => '%s marcou você em uma postagem.',
    'ossn:notification:are:friends' => 'Agora vocês são amigos!',
    'ossn:notifications:comments:post:group:wall' => "%s comentou uma postagem no grupo.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s curtiu sua foto de perfil.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s comentou sua foto de perfil.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s curtiu sua capa de perfil.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s comentou sua capa de perfil.",

    'ossn:notifications:like:post:group:wall' => '%s curtiu sua postagem.',
	
    'ossn:notification:delete:friend' => 'Solicitação de amizade deletada!',
    'notifications' => 'Notificações',
    'see:all' => 'Ver todas',
    'friend:requests' => 'Solicitações de amizade',
    'ossn:notifications:friendrequest:confirmbutton' => 'Aceitar',
    'ossn:notifications:friendrequest:denybutton' => 'Rejeitar',
	
    'ossn:notification:mark:read:success' => 'Todas notificações foram marcadas como lidas',
    'ossn:notification:mark:read:error' => 'Não foi possível marcar todas notificações como lidas',
    
    'ossn:notifications:mark:as:read' => 'Marcar tudo como lido',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Feche as janelas de notificação clicando em qualquer lugar',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> fecha qualquer janela de notificação clicando em qualquer lugar da página<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s comentou sobre a foto do perfil.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s comentou na capa do perfil.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s comentou sobre a foto.',	

	'ossn:notifications:admin:settings:checkintervals:title' => 'Tempo de verificação automática de notificação (padrão 60 segundos)', 
);
ossn_register_languages('pt', $pt); 
