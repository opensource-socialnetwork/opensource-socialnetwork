<?php
/**
 * Open Source Social Network
 *
 * Translated by Zaturnay - https://zaturnay.com.ve
 *
 * @package   (softlab24.com).ossn
 * @author    OSSN Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$spanish = array(
	'site:settings' => 'Configuración del Sitio',
	'ossn:installed' => 'Instalado',
	'ossn:installation' => 'Instalación',
	'ossn:check' => 'Validar',
	'ossn:installed' => 'Instalado',
	'ossn:installed:message' => 'Open Source Social Network ha sido instalado.',
    'ossn:prerequisites' => 'Requisitos de instalación',
    'ossn:settings' => 'Configuración del servidor',
    'ossn:dbsettings' => 'Base de datos',
	'ossn:dbuser' => 'Usuario de la Base de Datos',
	'ossn:dbpassword' => 'Contraseña de Base de Datos',
	'ossn:dbname' => 'Nombre de la Base de Datos',
	'ossn:dbhost' => 'Host de Base de Datos',
    'ossn:sitesettings' => 'Sitio web',
    'ossn:websitename' => 'Nombre del Sitio Web',
    'ossn:mainsettings' => 'Rutas',
	'ossn:weburl' => 'URL de OssnSite',
	'installation:notes' => 'El directorio de datos contiene los archivos de los usuarios. El directorio de datos debe estar ubicado fuera de la ruta de instalación de OSSN.',
	'ossn:datadir' => 'Directorio de Datos',
	'owner_email' => 'Correo electrónico del Propietario del Sitio',
	'notification_email' => 'Correo Electrónico de Notificación (noreply@domain.com)',
	'create:admin:account' => 'Crear una Cuenta de Administrador',
	'ossn:setting:account' => 'Configuraciones de la cuenta',
	
	'data:directory:invalid' => 'El directorio o directorio de datos no válido no se puede escribir.',	
	'data:directory:outside' => 'El directorio de datos debe estar fuera de la ruta de instalación.',
	'all:files:required' => 'Todos los archivos son necesarios! Compruebe sus archivos.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "Tienes una versión antigua de PHP " . PHP_VERSION . " Necesita PHP 5.4 o PHP 5.5",
	
	'ossn:install:mysqli' => 'MYSQLI HABILITADO',
	'ossn:install:mysqli:required' => 'MYSQLI PHP EXTENSIÓN REQUERIDA',
	
	'ossn:install:apache' => 'APACHE HABILITADO',
	'ossn:install:apache:required' => 'APACHE ES NECESARIO',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE REQUERIDO',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL REQUERIDO',
	
	'ossn:install:gd' => 'BIBLIOTECA PHP GD',
	'ossn:install:gd:required' => 'BIBLIOTECA DE PHP GD REQUERIDA',
	
	'ossn:install:config' => 'DIRECTORIO DE CONFIGURACIÓN ESCRIBLE',
	'ossn:install:config:error' => 'EL DIRECTORIO DE CONFIGURACIÓN NO ESTÁ ESCRIBLE',
	
	'ossn:install:next' => 'Siguiente',
    'ossn:install:install' => 'Instalar',
    'ossn:install:create' => 'Crear',
    'ossn:install:finish' => 'Terminar',
	
	'fields:require' => '¡Todos los campos son obligatorios!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen HABILITADO',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen is required',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive HABILITADO',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSIÓN REQUERIDA',
);

ossn_installation_register_languages($spanish);
