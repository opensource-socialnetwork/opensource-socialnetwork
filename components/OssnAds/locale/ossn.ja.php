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
$ja = array(
	'ossnads'                       => '広告マネージャー',
	'fields:required'               => 'すべての項目が必須です！',
	'ad:created'                    => '広告が作成されました！',
	'ad:create:fail'                => '広告を作成できませんでした。',
	'ad:title'                      => 'タイトル',
	'ad:site:url'                   => 'サイトURL',
	'ad:desc'                       => '説明',
	'ad:browse'                     => '参照',
	'ad:clicks'                     => 'クリック数',
	'sponsored'                     => 'スポンサー広告',
	'ad:deleted'                    => "タイトル「%s」の広告が正常に削除されました。",
	'ad:delete:fail'                => '広告を削除できませんでした。しばらく時間をおいてから再度お試しください。',
	'ad:edited'                     => '広告が正常に修正されました。',
	'ad:edit:fail'                  => '広告を編集できませんでした。しばらく時間をおいてから再度お試しください。',
	'ads:manager'                   => '広告管理',
	'ads:boost:community'           => 'コミュニティを活性化しましょう。新しい広告キャンペーンを作成するか、既存のキャンペーンを管理します。',
	'ads:create'                    => '広告を作成',

	'ad:placement'                  => '広告の配置エリア',
	'ad:gender:target'              => '性別ターゲティング',
	'ad:end:date'                   => 'キャンペーン終了日 (任意)',
	'ad:photo'                      => 'バナー広告画像',
	'add'                           => 'キャンペーンを作成',

	'ad:placement:newsfeed'         => 'アクティビティ・ニュースフィード (サイドバー)',
	'ad:placement:profile'          => 'ユーザープロフィール (サイドバー)',
	'ad:placement:groups'           => 'グループページ (サイドバー)',
	'ad:placement:global'           => 'その他すべてのテーマ・サイドバー (グローバル)',

	'ad:file:choose'                => '広告画像を選択するか、ここにドラッグしてください...',
	'ad:file:restriction'           => '画像ファイルのみ有効です (PNG, JPG, WebP)',
	'ad:file:remove'                => '画像を削除',
	'ad:char:left'                  => '残り %s 文字',
	'ad:status:expired'             => '期限切れ',
	'ad:status:active'              => 'アクティブ',
	'ad:views'                      => '表示回数',
	'ad:status'                     => 'ステータス',
	'ad:end:date:infinity'          => '無期限',

	//cron
	'ossn:adscron:title'            => '必須設定: 広告の自動期限切れ処理',
	'ossn:adscron:last:run'         => '最終 Cron 実行日時:',
	'ossn:adscron:never'            => '未実行',
	'ossn:adscron:configure'        => '設定する',
	'ossn:adscron:description'      => '広告のステータスを自動的に %s に切り替えるには、1日1回正午 (12:00 PM) に実行されるシステム cron ジョブを設定する必要があります。',
	'ossn:adscron:expired'          => '期限切れ',
	'ossn:adscron:command:label'    => 'Crontab コマンド',
	'ossn:adscron:path:placeholder' => 'サーバーのPHPパスを入力',
	'ossn:adscron:warning:title'    => '重要な注意事項:',
	'ossn:adscron:warning:text'     => '広告の期限が切れると、その広告は %s。広告主は新しい広告を最初から作成し直す必要があります。',
	'ossn:adscron:cannot:edit'      => '編集や更新をすることができなくなります',
);
ossn_register_languages('ja', $ja);