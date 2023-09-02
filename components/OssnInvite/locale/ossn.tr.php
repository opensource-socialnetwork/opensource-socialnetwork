<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network
 * @author    Open Source Social Network Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$tr = array(
	'com:ossn:invite' => 'Davet et',			
	'com:ossn:invite:friends' => 'Arkadaşlarını Davet Et',
	'com:ossn:invite:friends:note' => 'Davet etmek istediğiniz arkadaşlarınızın e-posta adresini girin. Arkadaşlarınız davetinizi içeren bir e-posta alacaktır.',
	'com:ossn:invite:emails:note' => 'E-posta Adresi (, ile ayırarak yazınız)',
	'com:ossn:invite:emails:placeholder' => 'ahmet@örnek.com, mehmet@örnek.com',
	'com:ossn:invite:message' => 'Mesajınız',
		
    	'com:ossn:invite:mail:subject' => '%s davetine katıl',	
    	'com:ossn:invite:mail:message' => '%s tarafından %s ye katılmaya davet edildiniz. Aşağıda yazanlar sizi davet edenin mesajıdır:

%s

Katılmak için aşağıdaki bağlantıya tıklayın:

%s

Kullanıcının Profili: %s
',	
	'com:ossn:invite:mail:message:default' => 'Merhaba,

%s katılmak üzere davet edildiniz..

Kullanıcının Profili: %s

Saygılarımızla.
%s',
	'com:ossn:invite:sent' => 'Arkadaşların davet edildi. Gönderilen davetler: %s.',
	'com:ossn:invite:wrong:emails' => 'Şu e-posta adresleri geçersiz: %s.',
	'com:ossn:invite:sent:failed' => 'Şu e-posta adresleri davet edilemedi: %s.',
	'com:ossn:invite:already:members' => 'Şu e-posta adresleri zaten üye: %s',
	'com:ossn:invite:empty:emails' => 'Lütfen en az bir e-posta adresi ekleyiniz',
);
ossn_register_languages('tr', $tr); 
