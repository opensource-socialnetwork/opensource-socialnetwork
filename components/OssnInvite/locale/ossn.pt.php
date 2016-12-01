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
	'com:ossn:invite' => 'Convidar',			
	'com:ossn:invite:friends' => 'Convidar Amigos',
	'com:ossn:invite:friends:note' => 'Para convidar amigos para entrar na rede, insira os endereços de e-mail e uma breve mensagem. Eles receberão um e-mail contendo o seu convite.',
	'com:ossn:invite:emails:note' => 'Endereços de e-mail (separados por vírgula)',
	'com:ossn:invite:emails:placeholder' => 'luan@exemplo.com, vinicius@exemplo.com',
	'com:ossn:invite:message' => 'Mensagem',
		
    	'com:ossn:invite:mail:subject' => 'Convite para participar %s',	
    	'com:ossn:invite:mail:message' => 'Você enviou um convite para participar %s por %s com sucesso. Eles incluíram a seguinte mensagem:

%s

Para entrar, clique no seguinte link:

%s

Link do perfil: %s
',	
	'com:ossn:invite:mail:message:default' => 'Olá,

Eu quero te convidar para entrar para minha rede social %s.

Link do perfil : %s

Abraço.
%s',
	'com:ossn:invite:sent' => 'Seus amigos foram convidados. Convites enviados: %s.',
	'com:ossn:invite:wrong:emails' => 'O seguinte endereço não é válido: %s.',
	'com:ossn:invite:sent:failed' => 'Não foi possível enviar para os seguintes endereços: %s.',
	'com:ossn:invite:already:members' => 'O seguinte endereço já está cadastrado no site: %s',
	'com:ossn:invite:empty:emails' => 'Por favor, adicione pelo menos um endereço de e-mail',
);
ossn_register_languages('pt', $pt); 
