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
		'ossnads'                       => 'Reklam Yöneticisi',
		'fields:required'               => 'Tüm alanların doldurulması zorunludur!',
		'ad:created'                    => 'Reklam başarıyla oluşturuldu!',
		'ad:create:fail'                => 'Reklam oluşturulamadı!',
		'ad:title'                      => 'Başlık',
		'ad:site:url'                   => 'Site Adresi (URL)',
		'ad:desc'                       => 'Açıklama',
		'ad:photo'                      => 'Fotoğraf',
		'ad:browse'                     => 'Gözat',
		'ad:clicks'                     => 'Tıklamalar',
		'sponsored'                     => 'SPONSORLU',
		'ad:deleted'                    => "'%s' başlıklı reklam başarıyla silindi.",
		'ad:delete:fail'                => 'Reklam silinemedi! Lütfen daha sonra tekrar deneyin.',
		'ad:edited'                     => 'Reklam başarıyla düzenlendi.',
		'ad:edit:fail'                  => 'Reklam düzenlenemedi! Lütfen daha sonra tekrar deneyin.',
		'ads:manager'                   => 'Reklam Yönetimi',
		'ads:boost:community'           => 'Topluluğunuzu öne çıkarın. Yeni bir reklam kampanyası oluşturun veya mevcut olanları yönetin.',
		'ads:create'                    => 'Reklam Oluştur',

		'ad:placement'                  => 'Reklam Alanı Konumları',
		'ad:gender:target'              => 'Demografik Cinsiyet Hedefleme',
		'ad:end:date'                   => 'Kampanya Bitiş Tarihi (İsteğe Bağlı)',
		'ad:photo'                      => 'Görsel Banner',
		'add'                           => 'Kampanya Oluştur',

		'ad:placement:newsfeed'         => 'Haber Kaynağı (Yan Menü)',
		'ad:placement:profile'          => 'Kullanıcı Profilleri (Yan Menü)',
		'ad:placement:groups'           => 'Grup Sayfaları (Yan Menü)',
		'ad:placement:global'           => 'Diğer Tüm Tema Yan Menüleri (Genel)',

		'ad:file:choose'                => 'Reklam Görselini Seçin veya Buraya Sürükleyin...',
		'ad:file:restriction'           => 'Yalnızca görsel dosyaları (PNG, JPG, WebP)',
		'ad:file:remove'                => 'Görseli Kaldır',
		'ad:char:left'                  => '%s karakter kaldı',
		'ad:status:expired'             => 'Süresi Doldu',
		'ad:status:active'              => 'Aktif',
		'ad:views'                      => 'Görüntülenmeler',
		'ad:status'                     => 'Durum',
		'ad:end:date:infinity'          => 'Hiçbir Zaman',

		//cron
		'ossn:adscron:title'            => 'Gerekli Kurulum: Süresi Dolan Reklamları Otomatikleştirin',
		'ossn:adscron:last:run'         => 'Son Cron Çalışması:',
		'ossn:adscron:never'            => 'Hiçbir Zaman',
		'ossn:adscron:configure'        => 'Yapılandır',
		'ossn:adscron:description'      => 'Reklam durumlarını otomatik olarak %s moduna geçirmek için, günde bir kez öğlen (12:00 PM) çalışacak bir sistem cron işi (cron job) yapılandırmalısınız.',
		'ossn:adscron:expired'          => 'Süresi Dolmuş',
		'ossn:adscron:command:label'    => 'Crontab Komutu',
		'ossn:adscron:path:placeholder' => 'SUNUCUNUZUN_PHP_YOLU',
		'ossn:adscron:warning:title'    => 'Önemli Not:',
		'ossn:adscron:warning:text'     => 'Bir reklamın süresi dolduğunda, o reklam %s. Reklam verenlerin sıfırdan yeni bir reklam oluşturması gerekir.',
		'ossn:adscron:cannot:edit'      => 'düzenlenemez veya yenilenemez',
);
ossn_register_languages('tr', $tr); 