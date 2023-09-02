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
    'groups' => 'Grup',
    'add:group' => 'Buat Grup',
    'requests' => 'Gabung Grup',

    'members' => 'Anggota',
    'member:add:error' => 'Ada yang salah! silahkan coba lagi nanti.',
    'member:added' => 'Permintaan menjadi Anggota Telah Disetujui!',

    'member:request:deleted' => 'Permintaan menjadi Anggota telah Ditolak!',
    'member:request:delete:fail' => 'Tidak dapat menolak permintaan keanggotaan! Silakan coba lagi nanti.',
    'membership:cancel:succes' => 'Permintaan keanggotaan dibatalkan!',
    'membership:cancel:fail' => 'Tidak dapat membatalkan permintaan keanggotaan! Silakan coba lagi nanti.',

    'group:added' => 'Berhasil membuat Grup!',
    'group:add:fail' => 'Tidak dapat membuat grup! Silakan coba lagi nanti.',

    'memebership:sent' => 'Permintaan Anggota berhasil dikirim!',
    'memebership:sent:fail' => 'Tidak bisa mengirim permintaan anggota! Silakan coba lagi nanti.',

    'group:updated' => 'Grup telah diperbarui!',
    'group:update:fail' => 'Tidak dapat memperbarui grup! Silakan coba lagi nanti.',

    'group:name' => 'Nama Grup',
    'group:desc' => 'Deskripsi Grup',
    'privacy:group:public' => 'Setiap orang dapat melihat grup ini dan posnya. Hanya anggota yang dapat memposting ke grup ini.',
    'privacy:group:close' => 'Semua orang dapat melihat grup ini tetapi seseorang tidak bisa melihat isi grup. Hanya anggota yang dapat memposting dan melihat posting.',

    'group:memb:remove' => 'Hapus',
    'group:memb:make:owner' => 'Buat pemilik grup',
    'group:memb:make:owner:confirm' => 'Perhatian! Tindakan ini akan membuat >> %s << pemilik baru grup dan Anda akan kehilangan semua hak istimewa admin grup Anda. Anda yakin akan melanjutkan?',
    'group:memb:make:owner:admin:confirm' => 'Perhatian! Tindakan ini akan membuat >> %s << pemilik baru grup dan pemilik lama akan kehilangan semua hak istimewa admin grupnya. Anda yakin akan melanjutkan?',
    'leave:group' => 'Tinggalkan Grup',
    'join:group' => 'Gabung Grup',
    'total:members' => 'Total Anggota',
    'group:members' => "Anggota (%s)",
    'view:all' => 'Lihat semuanya',
    'member:requests' => 'PERMINTAAN (%s)',
    'about:group' => 'Tentang Grup',
    'cancel:membership' => 'Keanggotaan dibatalkan',

    'no:requests' => 'Tidak ada Permintaan Anggota',
    'approve' => 'Setujui',
    'decline' => 'Tolak',
    'search:groups' => 'Cari Grup',

    'close:group:notice' => 'Bergabunglah dengan grup ini untuk melihat posting, foto, dan komentar.',
    'closed:group' => 'Tutup Grup',
    'group:admin' => 'Admin',
	
	'title:access:private:group' => 'Postingan Grup',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s telah meminta untuk bergabung %s',
	'ossn:group:by' => 'Oleh:',
	
	'group:deleted' => 'Grup dan konten grup dihapus',
	'group:delete:fail' => 'Grup tidak dapat dihapus',

	'group:delete:cover' => 'Hapus Foto Sampul',
	'group:delete:cover:error' => 'Terjadi kesalahan saat menghapus Foto Sampul',
	'group:delete:cover:success' => 'Foto Sampul berhasil dihapus',

);
ossn_register_languages('id', $id); 
