<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014 iNFORMATIKON TECHNOLOGIES
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      http://www.opensource-socialnetwork.org/licence
 */
$pt = array(
    'groups' => 'Grupos',
    'add:group' => 'Adicionar grupo',
    'requests' => 'Solicitações',

    'members' => 'Membros',
    'member:add:error' => 'Ocorreu um erro! Por favor tente novamente mais tarde.',
    'member:added' => 'Solicitações de entrada aprovadas!',

    'member:request:deleted' => 'Solicitações de entrada negadas!',
    'member:request:delete:fail' => 'Não é possivel recusar as solicitações de entrada! Tente novamente mais tarde.',
    'membership:cancel:succes' => 'Solicitações de entrada canceladas!',
    'membership:cancel:fail' => 'Não é possivel recusar a solicitação de entrada! Tente novamente mais tarde.',

    'group:added' => 'Grupo criado com sucesso!',
    'group:add:fail' => 'Não é possivel criar o grupo! Tente novamente mais tarde.',

    'memebership:sent' => 'Solicitação de entrada enviada!',
    'memebership:sent:fail' => 'Não é possivel enviar a solicitação! Tente novamente mais tarde.',

    'group:updated' => 'Grupo atualizado com sucesso!',
    'group:update:fail' => 'Erro ao atualizar o grupo! Tente novamente mais tarde.',

    'group:name' => 'Nome do grupo',
    'group:desc' => 'Descrição do grupo',
    'privacy:group:public' => 'Todos podem ver que está no grupo e o que foi postado. Somente membros podem postar no grupo.',
    'privacy:group:close' => 'Todos podem ver o grupo. Somente membros podem postar e ver as outras postagens no grupo.',

    'group:memb:remove' => 'Remover',
    'leave:group' => 'Sair do grupo',
    'join:group' => 'Entrar no grupo',
    'total:members' => 'Total de membros',
    'group:members' => "Membros (%s)",
    'view:all' => 'Ver todos',
    'member:requests' => 'SOLICITAÇÕES (%s)',
    'about:group' => 'Sobre o grupo',
    'cancel:membership' => 'Cancelar membro',

    'no:requests' => 'Nenhuma solicitação',
    'approve' => 'Aprovar',
    'decline' => 'Rejeitar',
    'search:groups' => 'Buscar grupos',

    'close:group:notice' => 'Entre no grupo para ver as postagens, fotos e comentários.',
    'closed:group' => 'Grupo fechado',
    'group:admin' => 'Administrador',
	
	'title:access:private:group' => 'Postagens do grupo',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s solicitaram a entrada em %s',
	'ossn:group:by' => 'Por:',
	
	'group:deleted' => 'Grupo e conteúdo do grupo deletados',
	'group:delete:fail' => 'O grupo não pode ser deletado',	
);
ossn_register_languages('pt', $pt); 
