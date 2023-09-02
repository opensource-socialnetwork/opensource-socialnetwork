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

	'group:delete:cover' => 'Kapak resmi sil',
	'group:delete:cover:error' => 'Kapak resmi başarıyla silindi',
	'group:delete:cover:success' => 'Kapak resmi silinirken bir hata oluştu',

	//need translation
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',	
);
ossn_register_languages('tr', $tr); 
