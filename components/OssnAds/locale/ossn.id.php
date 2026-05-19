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
	'ossnads'                       => 'Manajer Iklan',
	'fields:required'               => 'Semua kolom wajib diisi!',
	'ad:created'                    => 'Iklan berhasil dibuat!',
	'ad:create:fail'                => 'Gagal membuat iklan!',
	'ad:title'                      => 'Judul',
	'ad:site:url'                   => 'URL Situs',
	'ad:desc'                       => 'Deskripsi',
	'ad:browse'                     => 'Telusuri',
	'ad:clicks'                     => 'Klik',
	'sponsored'                     => 'SPONSOR',
	'ad:deleted'                    => "Iklan dengan judul '%s' telah berhasil dihapus.",
	'ad:delete:fail'                => 'Gagal menghapus iklan! Silakan coba lagi nanti.',
	'ad:edited'                     => 'Iklan berhasil diubah.',
	'ad:edit:fail'                  => 'Gagal menyunting iklan! Silakan coba lagi nanti.',
	'ads:manager'                   => 'Manajer Periklanan',
	'ads:boost:community'           => 'Tingkatkan komunitas Anda. Buat kampanye iklan baru atau kelola kampanye yang sudah ada.',
	'ads:create'                    => 'Buat Iklan',

	'ad:placement'                  => 'Area Penempatan Tampilan',
	'ad:gender:target'              => 'Target Demografis Jenis Kelamin',
	'ad:end:date'                   => 'Tanggal Berakhir Kampanye (Opsional)',
	'ad:photo'                      => 'Gambar Kreatif Banner',
	'add'                           => 'Buat Kampanye',

	'ad:placement:newsfeed'         => 'Kabar Beranda Aktivitas (Bilah Sisi)',
	'ad:placement:profile'          => 'Profil Pengguna (Bilah Sisi)',
	'ad:placement:groups'           => 'Halaman Grup (Bilah Sisi)',
	'ad:placement:global'           => 'Semua Bilah Sisi Tema Lainnya (Global)',

	'ad:file:choose'                => 'Pilih atau seret gambar iklan ke sini...',
	'ad:file:restriction'           => 'Hanya diperbolehkan file gambar saja (PNG, JPG, WebP)',
	'ad:file:remove'                => 'Hapus Gambar',
	'ad:char:left'                  => 'Tersisa %s karakter',
	'ad:status:expired'             => 'Kedaluwarsa',
	'ad:status:active'              => 'Aktif',
	'ad:views'                      => 'Dilihat',
	'ad:status'                     => 'Status',
	'ad:end:date:infinity'          => 'Tidak Pernah',

	//cron
	'ossn:adscron:title'            => 'Pengaturan Diperlukan: Otomatisasi Masa Kedaluwarsa Iklan',
	'ossn:adscron:last:run'         => 'Eksekusi Cron Terakhir:',
	'ossn:adscron:never'            => 'Tidak Pernah',
	'ossn:adscron:configure'        => 'Konfigurasi',
	'ossn:adscron:description'      => 'Untuk mengubah status iklan secara otomatis menjadi %s, Anda harus mengonfigurasi cron job sistem agar berjalan sekali sehari pada tengah hari (12:00 PM).',
	'ossn:adscron:expired'          => 'Kedaluwarsa',
	'ossn:adscron:command:label'    => 'Perintah Crontab',
	'ossn:adscron:path:placeholder' => 'JALUR_PHP_SERVER_ANDA',
	'ossn:adscron:warning:title'    => 'Pemberitahuan Penting:',
	'ossn:adscron:warning:text'     => 'Setelah iklan kedaluwarsa, iklan tersebut %s. Pengiklan harus membuat iklan baru dari awal.',
	'ossn:adscron:cannot:edit'      => 'tidak dapat disunting atau diperpanjang',
);
ossn_register_languages('id', $id);