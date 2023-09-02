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
$id = array(
	'com:ossn:invite' => 'Undang',			
	'com:ossn:invite:friends' => 'Undang Teman',
	'com:ossn:invite:friends:note' => 'Untuk mengundang teman untuk bergabung di Kuy Social Network, masukkan alamat email dan pesan singkat kepada mereka. Mereka akan menerima email yang berisi undangan Anda.',
	'com:ossn:invite:emails:note' => 'Alamat Email (pisahkan dengan koma jika ingin mengundang banyak orang)',
	'com:ossn:invite:emails:placeholder' => 'spongebob@contoh.com, squarepans@contoh.com',
	'com:ossn:invite:message' => 'Pesan',
		
    	'com:ossn:invite:mail:subject' => 'Undangan untuk bergabung %s',	
    	'com:ossn:invite:mail:message' => 'Anda telah diundang untuk bergabung dengan %s dengan %s. Mereka menyertakan pesan berikut:

%s

Untuk bergabung, klik tautan berikut:

%s

Tautan profil: %s
',	
	'com:ossn:invite:mail:message:default' => 'Halo,

Saya ingin mengundang Anda untuk bergabung bersama saya di %s.

Tautan profil: %s

Salam Hormat.
%s',
	'com:ossn:invite:sent' => 'Temanmu telah di undang. Undangan terkirim: %s.',
	'com:ossn:invite:wrong:emails' => 'Alamat Email berikut tidak valid: %s.',
	'com:ossn:invite:sent:failed' => 'Tidak dapat mengundang alamat email berikut: %s.',
	'com:ossn:invite:already:members' => 'Alamat email berikut sudah menjadi anggota: %s.',
	'com:ossn:invite:empty:emails' => 'Harap tambahkan setidaknya satu alamat email',
);
ossn_register_languages('id', $id); 
