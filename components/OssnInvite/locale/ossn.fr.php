<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$fr = array(
	'com:ossn:invite' => 'Inviter',			
	'com:ossn:invite:friends' => 'Inviter un ami',
	'com:ossn:invite:friends:note' => 'Pour inviter des amis à vous rejoindre sur ce réseau, entrez leurs adresses email et un bref message. Ils recevront un email contenant votre invitation.',
	'com:ossn:invite:emails:note' => 'Adresses email (séparés par une virgule)',
	'com:ossn:invite:emails:placeholder' => 'smith@example.com, john@example.com',
	'com:ossn:invite:message' => 'Message',
		
    	'com:ossn:invite:mail:subject' => 'Invitation à rejoindre %s',	
    	'com:ossn:invite:mail:message' => 'Vous avez été invité à rejoindre %s par %s. Ils comprenaient le message suivant:

%s

Pour vous inscrire, cliquez sur le lien suivant:

%s

Lien profil: %s
',	
	'com:ossn:invite:mail:message:default' => 'Bonjour,

Je voulais vous inviter à rejoindre mon réseau ici sur %s.

Lien profil : %s

Cordialement.
%s',
	'com:ossn:invite:sent' => 'Vos amis ont été invités. Invitations envoyées: %s.',
	'com:ossn:invite:wrong:emails' => 'Les adresses suivantes ne sont pas valides: %s.',
	'com:ossn:invite:sent:failed' => 'Vous ne pouvez pas inviter les adresses suivantes: %s.',
	'com:ossn:invite:already:members' => 'Les adresses suivantes sont déjà membres: %s',
	'com:ossn:invite:empty:emails' => 'S\'il vous plaît ajouter au moins une adresse email',
);
ossn_register_languages('fr', $fr); 