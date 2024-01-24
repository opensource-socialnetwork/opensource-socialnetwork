<?php
/**
 * Open Source Social Network
 *
 * @package   Open Source Social Network (OSSN)
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */

$id = array(
	'ossnnotifications' => 'Notifikasi',
    'ossn:notifications:comments:post' => "%s Berkomentar di postingan Anda.",
    'ossn:notifications:like:post' => "%s Menyukai Postingan Anda.",
    'ossn:notifications:like:annotation' => "%s Menyukai Komentar Anda.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s Menyukai Foto Anda.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s Berkomentar di Foto Anda.',
    'ossn:notifications:wall:friends:tag' => '%s Menandai anda dalam sebuah Postingan.',
    'ossn:notification:are:friends' => 'Kamu sekarang telah berteman!',
    'ossn:notifications:comments:post:group:wall' => "%s Berkomentar di Postingan Grup",
    'ossn:notifications:like:entity:file:profile:photo' => "%s Menyukai Foto Profil Anda.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s Berkomentar di Foto Profil Anda.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s Menyukai Foto Sampul Anda.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s Berkomentar di Foto Sampul Anda.",

    'ossn:notifications:like:post:group:wall' => '%s Menyukai Postingan Anda.',
	
    'ossn:notification:delete:friend' => 'Permintaan Teman Dihapus!',
    'notifications' => 'Notifikasi',
    'see:all' => 'Lihat Semuanya',
    'friend:requests' => 'Permintaan Pertemanan',
    'ossn:notifications:friendrequest:confirmbutton' => 'Konfirmasi',
    'ossn:notifications:friendrequest:denybutton' => 'Abaikan',
	
    'ossn:notification:mark:read:success' => 'Berhasil menandai semua sebagai telah dibaca',
    'ossn:notification:mark:read:error' => 'Tidak dapat menandai semua sebagai sudah dibaca',
    
    'ossn:notifications:mark:as:read' => 'Tandai Semua Telah Dibaca',
	'ossn:notifications:admin:settings:close_anywhere:title' => 'Tutup jendela Notifikasi dengan mengklik dimana saja',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> menutup jendela pemberitahuan dengan mengklik dimana saja pada halaman<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s mengomentari foto profil.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s mengomentari sampul profil.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s mengomentari foto.',

	'ossn:notifications:admin:settings:checkintervals:title' => 'Waktu pemeriksaan otomatis notifikasi (Default 60 detik)', 
);
ossn_register_languages('id', $id); 
