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
	'ossnads'                       => 'Administrador de anuncios',
	'fields:required'               => '¡Todos los campos son obligatorios!',
	'ad:created'                    => '¡El anuncio ha sido creado con éxito!',
	'ad:create:fail'                => '¡No se pudo crear el anuncio!',
	'ad:title'                      => 'Título',
	'ad:site:url'                   => 'URL del sitio',
	'ad:desc'                       => 'Descripción',
	'ad:browse'                     => 'Examinar',
	'ad:clicks'                     => 'Clics',
	'sponsored'                     => 'PATROCINADO',
	'ad:deleted'                    => "El anuncio con el título '%s' ha sido eliminado con éxito.",
	'ad:delete:fail'                => '¡No se pudo eliminar el anuncio! Por favor, inténtelo de nuevo más tarde.',
	'ad:edited'                     => 'Anuncio modificado con éxito.',
	'ad:edit:fail'                  => '¡No se pudo editar el anuncio! Por favor, inténtelo de nuevo más tarde.',
	'ads:manager'                   => 'Administrador de publicidad',
	'ads:boost:community'           => 'Impulse su comunidad. Cree una nueva campaña publicitaria o gestione las existentes.',
	'ads:create'                    => 'Crear anuncio',

	'ad:placement'                  => 'Zonas de ubicación de anuncios',
	'ad:gender:target'              => 'Segmentación demográfica por género',
	'ad:end:date'                   => 'Fecha de finalización de la campaña (Opcional)',
	'ad:photo'                      => 'Imagen del diseño del banner',
	'add'                           => 'Crear campaña',

	'ad:placement:newsfeed'         => 'Sección de noticias de actividad (Barra lateral)',
	'ad:placement:profile'          => 'Perfiles de usuario (Barra lateral)',
	'ad:placement:groups'           => 'Páginas de grupos (Barra lateral)',
	'ad:placement:global'           => 'Todas las demás barras laterales del tema (Global)',

	'ad:file:choose'                => 'Seleccione o arrastre la imagen del anuncio aquí...',
	'ad:file:restriction'           => 'Solo se permiten archivos de imagen (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Eliminar imagen',
	'ad:char:left'                  => 'Quedan %s caracteres',
	'ad:status:expired'             => 'Expirado',
	'ad:status:active'              => 'Activo',
	'ad:views'                      => 'Visualizaciones',
	'ad:status'                     => 'Estado',
	'ad:end:date:infinity'          => 'Nunca',

	//cron
	'ossn:adscron:title'            => 'Configuración requerida: Automatizar la expiración de anuncios',
	'ossn:adscron:last:run'         => 'Última ejecución del Cron:',
	'ossn:adscron:never'            => 'Nunca',
	'ossn:adscron:configure'        => 'Configurar',
	'ossn:adscron:description'      => 'To automáticamente cambiar el estado de los anuncios a %s, debe configurar una tarea cron del sistema para que se ejecute una vez al día al mediodía (12:00 PM).',
	'ossn:adscron:expired'          => 'Expirado',
	'ossn:adscron:command:label'    => 'Comando de Crontab',
	'ossn:adscron:path:placeholder' => 'RUTA_PHP_DE_SU_SERVIDOR',
	'ossn:adscron:warning:title'    => 'Aviso importante:',
	'ossn:adscron:warning:text'     => 'Una vez que un anuncio expira, este %s. Los anunciantes deben crear un anuncio nuevo desde cero.',
	'ossn:adscron:cannot:edit'      => 'no se puede editar ni renovar',
);
ossn_register_languages('es', $es);