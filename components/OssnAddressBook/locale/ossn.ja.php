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
$ja = array(
		'ossnaddressbook:menu'               => 'アドレス帳',
		'ossnaddressbook:title'              => 'アドレス帳',
		'ossnaddressbook:subtitle:contacts'  => '件の連絡先',
		'ossnaddressbook:subtitle:favorites' => '件のお気に入り',
		'ossnaddressbook:search:placeholder' => '名前、電話番号、メール、会社名で連絡先を検索...',
		'ossnaddressbook:add'                => '連絡先を追加',
		'ossnaddressbook:add:toggle'         => '新しい連絡先',
		'ossnaddressbook:name:placeholder'   => '氏名 *',
		'ossnaddressbook:phone:placeholder'  => '電話番号 / WhatsApp',
		'ossnaddressbook:email:placeholder'  => 'メールアドレス',
		'ossnaddressbook:company:placeholder' => '会社 / 組織',
		'ossnaddressbook:address:placeholder' => '住所 / 市区町村',
		'ossnaddressbook:note:placeholder'   => '個人メモ（任意）...',
		'ossnaddressbook:category'           => 'グループ',
		'ossnaddressbook:category:all'       => 'すべて',
		'ossnaddressbook:category:favorites' => 'お気に入り',
		'ossnaddressbook:category:personal'  => '個人',
		'ossnaddressbook:category:work'      => '仕事',
		'ossnaddressbook:category:family'    => '家族',
		'ossnaddressbook:category:other'     => 'その他',
		'ossnaddressbook:favorite'           => 'お気に入り',
		'ossnaddressbook:edit'               => '編集',
		'ossnaddressbook:save'               => '保存',
		'ossnaddressbook:cancel'             => 'キャンセル',
		'ossnaddressbook:delete'             => '削除',
		'ossnaddressbook:delete:all'         => 'すべて削除',
		'ossnaddressbook:delete:all:confirm' => 'すべての連絡先を削除してもよろしいですか？この操作は元に戻せません。',
		'ossnaddressbook:empty'              => 'アドレス帳は空です。上で最初の連絡先を追加しましょう！',
		'ossnaddressbook:add:error'          => '連絡先を追加できません。名前を入力してください。',
		'ossnaddressbook:edit:error'         => '連絡先を更新できません。',
		'ossnaddressbook:delete:error'       => '連絡先を削除できません。',
		'ossnaddressbook:import'             => 'インポート',
		'ossnaddressbook:export:csv'         => 'CSVをエクスポート',
		'ossnaddressbook:export:vcf'         => 'vCardをエクスポート',
		'ossnaddressbook:import:success'     => '%s 件の連絡先を正常にインポートしました。',
		'ossnaddressbook:import:error'       => 'インポートするCSVまたはvCard（.vcf）ファイルを選択してください。',
		'ossnaddressbook:import:invalid'     => 'サポートされていないファイル形式です。.csv と .vcf ファイルのみ使用できます。',
		'ossnaddressbook:import:empty'       => 'アップロードされたファイルに有効な連絡先が見つかりませんでした。',
);
ossn_register_languages('ja', $ja);
