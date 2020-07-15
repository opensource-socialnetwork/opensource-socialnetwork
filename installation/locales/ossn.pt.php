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


$portuguese = array(
	'site:settings' => 'Configurações do site',
	'ossn:installed' => 'Innstalado',
	'ossn:installation' => 'Instalação',
	'ossn:check' => 'Validado',
	'ossn:installed' => 'Instalado',
	'ossn:installed:message' => 'Open Source Social Network foi instalado com sucesso.',
    'ossn:prerequisites' => 'Installation prerequisites',
    'ossn:settings' => 'Configurações do servidor',
    'ossn:dbsettings' => 'Banco de dados',
	'ossn:dbuser' => 'Usuário do banco de dados',
	'ossn:dbpassword' => 'Senha do banco de dados',
	'ossn:dbname' => 'Nome do banco de dados',
	'ossn:dbhost' => 'Host do banco de dados',
    'ossn:sitesettings' => 'Website',
    'ossn:websitename' => 'Nome do website',
    'ossn:mainsettings' => 'Pastas',
	'ossn:weburl' => 'OssnSite Url',
	'installation:notes' => 'The data directory contains users files. The data directory must be located outside the OSSN installation path.',
	'ossn:datadir' => 'Diretório de dados',
	'owner_email' => 'Site Owner Email',
	'notification_email' => 'E-mail para notificações (noreply@domain.com)',
	'create:admin:account' => 'Criar conta de administrador',
	'ossn:setting:account' => 'Configuração da conta',
	
	'data:directory:invalid' => 'Invalid data directory or directory is not writeable.',	
	'data:directory:outside' => 'Data directory must be outside the installation path.',
	'all:files:required' => 'All files are required! Please check your files.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => "You have an old version of PHP " . PHP_VERSION . " You need PHP 7.0 or 7.x",
	
	'ossn:install:mysqli' => 'MYSQLI ENABLED',
	'ossn:install:mysqli:required' => 'MYSQLI PHP EXTENSION REQUIRED',
	
	'ossn:install:apache' => 'APACHE ENABLED',
	'ossn:install:apache:required' => 'APACHE IS REQUIRED',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE REQUIRED',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL REQUIRED',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY REQUIRED',
	
	'ossn:install:config' => 'CONFIGURATION DIRECTORY WRITEABLE',
	'ossn:install:config:error' => 'CONFIGURATION DIRECTORY IS NOT WRITEABLE',
	
	'ossn:install:next' => 'Próximo',
    'ossn:install:install' => 'Instalar',
    'ossn:install:create' => 'Criar',
    'ossn:install:finish' => 'Finalizar',
	
	'fields:require' => 'Todos os campos são obrigatórios!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen ENABLED',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen is required',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive ENABLED',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSION REQUIRED',
	'ossn:install:cachedir:note:failed' => 'Certifique-se de que seus arquivos e diretórios sejam de propriedade do usuário apache correto.',	
);

ossn_installation_register_languages($portuguese);
