<?php
/**
 * Open Source Social Network
 *
 * @package Open Source Social Network
 * @author    Open Social Website Core Team <info@softlab24.com>
 * @copyright 2014-2017 SOFTLAB24 LIMITED
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$tr = array(
    'groups' => 'Gruplar',
    'add:group' => 'Grup Ekle',
    'requests' => 'İstekler',

    'members' => 'Üyeler',
    'member:add:error' => 'Bir şetler ters gitti! Lütfen daha sonra tekrar deneyiniz.',
    'member:added' => 'Üyelik talebi onaylandı. ',

    'member:request:deleted' => 'Üyelik talebi reddedildi!',
    'member:request:delete:fail' => 'Üyelik talebi reddedilemedi! Lütfen daha sonra tekrar deneyiniz.',
    'membership:cancel:succes' => 'Üyelik talebi iptal edildi!',
    'membership:cancel:fail' => 'Üyelik talebi iptal edilemedi! Lütfen daha sonra tekrar deneyiniz.',

    'group:added' => 'Grup oluşturuldu!',
    'group:add:fail' => 'Grup oluşturulamadı! Lütfen daha sonra tekrar deneyiniz.',

    'memebership:sent' => 'Talep başarıyla gönderildi!',
    'memebership:sent:fail' => 'Talep gönderilemedi! Lütfen daha sonra tekrar deneyiniz.',

    'group:updated' => 'Grup güncellendi!',
    'group:update:fail' => 'Grup güncellenemedi! Lütfen daha sonra tekrar deneyiniz.',

    'group:name' => 'Grup Adı',
    'group:desc' => 'Grup Açıklaması',
    'privacy:group:public' => 'Herkes grubu, üyelerini ve gönderilerini görebilir.',
    'privacy:group:close' => 'Herkes grubu bulabilir ve üyelerini görebilir. Sadece üyeler gönderileri görebilir.',

    'group:memb:remove' => 'Kaldır',
    'leave:group' => 'Gruptan çık',
    'join:group' => 'Gruba Katıl',
    'total:members' => 'Toplam Üye',
    'group:members' => "Üyeler (%s)",
    'view:all' => 'Hepsini gör',
    'member:requests' => 'İSTEKLER (%s)',
    'about:group' => 'Grup Hakkında',
    'cancel:membership' => 'Üyelik silindi',

    'no:requests' => 'İstek yok',
    'approve' => 'Onayla',
    'decline' => 'Reddet',
    'search:groups' => 'Grup Ara',

    'close:group:notice' => 'Gönderileri görmek ve paylaşımda bulunmak için gruba katıl!',
    'closed:group' => 'Kapalı grup',
    'group:admin' => 'Yönetici',
	
	'title:access:private:group' => 'Grup gönderisi',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s, %s grubuna katılmak istiyor.',
	'ossn:group:by' => 'Ekleyen:',
	
	'group:deleted' => 'Grup silindi',
	'group:delete:fail' => 'Grup silinemedi',	
);
ossn_register_languages('tr', $tr); 
