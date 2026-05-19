<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$pt_br = array(
	'ossnads'                       => 'Gerenciador de Anúncios',
	'fields:required'               => 'Todos os campos são obrigatórios!',
	'ad:created'                    => 'O anúncio foi criado com sucesso!',
	'ad:create:fail'                => 'Não foi possível criar o anúncio!',
	'ad:title'                      => 'Título',
	'ad:site:url'                   => 'URL do site',
	'ad:desc'                       => 'Descrição',
	'ad:browse'                     => 'Procurar',
	'ad:clicks'                     => 'Cliques',
	'sponsored'                     => 'PATROCINADO',
	'ad:deleted'                    => "O anúncio com o título '%s' foi excluído com sucesso.",
	'ad:delete:fail'                => 'Não foi possível excluir o anúncio! Por favor, tente novamente mais tarde.',
	'ad:edited'                     => 'Anúncio modificado com sucesso.',
	'ad:edit:fail'                  => 'Não foi possível editar o anúncio! Por favor, tente novamente mais tarde.',
	'ads:manager'                   => 'Gerenciador de Publicidade',
	'ads:boost:community'           => 'Impulsione sua comunidade. Crie uma nova campanha de anúncios ou gerencie as existentes.',
	'ads:create'                    => 'Criar Anúncio',

	'ad:placement'                  => 'Áreas de Exibição do Anúncio',
	'ad:gender:target'              => 'Direcionamento Demográfico por Gênero',
	'ad:end:date'                   => 'Data de Expiração da Campanha (Opcional)',
	'ad:photo'                      => 'Imagem da Arte do Banner',
	'add'                           => 'Criar Campanha',

	'ad:placement:newsfeed'         => 'Feed de Notícias/Atividades (Barra Lateral)',
	'ad:placement:profile'          => 'Perfis de Usuários (Barra Lateral)',
	'ad:placement:groups'           => 'Páginas de Grupos (Barra Lateral)',
	'ad:placement:global'           => 'Todas as Outras Barras Laterais do Tema (Global)',

	'ad:file:choose'                => 'Escolha ou arraste a imagem do anúncio aqui...',
	'ad:file:restriction'           => 'Apenas arquivos de imagem são permitidos (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Remover Imagem',
	'ad:char:left'                  => '%s restantes',
	'ad:status:expired'             => 'Expirado',
	'ad:status:active'              => 'Ativo',
	'ad:views'                      => 'Visualizações',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Nunca',

	//cron
	'ossn:adscron:title'            => 'Configuração Obrigatória: Automatizar Expiração de Anúncios',
	'ossn:adscron:last:run'         => 'Última Execução do Cron:',
	'ossn:adscron:never'            => 'Nunca',
	'ossn:adscron:configure'        => 'Configurar',
	'ossn:adscron:description'      => 'Para alterar automaticamente o status dos anúncios para %s, você deve configurar uma tarefa cron (cron job) no sistema para rodar uma vez por dia ao meio-dia (12:00 PM).',
	'ossn:adscron:expired'          => 'Expirado',
	'ossn:adscron:command:label'    => 'Comando do Crontab',
	'ossn:adscron:path:placeholder' => 'CAMINHO_DO_PHP_NO_SEU_SERVIDOR',
	'ossn:adscron:warning:title'    => 'Aviso Importante:',
	'ossn:adscron:warning:text'     => 'Assim que um anúncio expira, ele %s. Os anunciantes devem criar um novo anúncio do zero.',
	'ossn:adscron:cannot:edit'      => 'não pode ser editado ou renovado',
);
ossn_register_languages('pt', $pt_br);