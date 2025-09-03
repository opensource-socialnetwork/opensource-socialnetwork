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
	'ossnnotifications' => 'Notifications',			
    'ossn:notifications:comments:post' => "%s さんが投稿にコメントしました。",
    'ossn:notifications:like:post' => "%s さんが投稿にいいね！しました。",
    'ossn:notifications:like:annotation' => "%s さんがあなたのコメントにいいね！しました。",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s さんがあなたの写真にいいね！しました。",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s さんがあなたの写真にコメントしました。',
    'ossn:notifications:wall:friends:tag' => '%s さんが投稿であなたのタグを付けました。',
    'ossn:notification:are:friends' => 'あなたは今友達です！',
    'ossn:notifications:comments:post:group:wall' => "%s さんがグループの投稿にコメントしました。",
    'ossn:notifications:like:entity:file:profile:photo' => "%s さんはあなたのプロフィール写真にいいね！しました。",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s さんはあなたのプロフィール写真にコメントしました。",
    'ossn:notifications:like:entity:file:profile:cover' => "%s さんがあなたのプロフィールカバーにいいね！しました。",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s さんがあなたのプロフィールカバーにコメントしました。",

    'ossn:notifications:like:post:group:wall' => '%s さんがあなたのグループの投稿にいいね！しました。',
	
    'ossn:notification:delete:friend' => '友達リクエストを削除しました！',
    'notifications' => '通知',
    'see:all' => 'すべてを見る',
    'friend:requests' => '友達リクエスト',
    'ossn:notifications:friendrequest:confirmbutton' => '承認する',
    'ossn:notifications:friendrequest:denybutton' => '承認しない',
	
    'ossn:notification:mark:read:success' => 'すべてを既読としてマークしました',
    'ossn:notification:mark:read:error' => 'すべてを既読にすることができませんでした。',
    
    'ossn:notifications:mark:as:read' => 'すべて既読にする',

	'ossn:notifications:admin:settings:close_anywhere:title' => 'Close notification windows by clicking anywhere',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> closes any notification window by clicking anywhere on the page<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s プロフィール写真にコメントしました。",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s プロフィールカバーにコメントしました。",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s が写真にコメントしました。',

	'ossn:notifications:admin:settings:checkintervals:title' => '通知自動チェック時間（デフォルトは60秒）', 
);
ossn_register_languages('ja', $ja); 
