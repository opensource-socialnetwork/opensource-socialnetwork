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

$zh = array(
	'ossnnotifications' => '通知',
    'ossn:notifications:comments:post' => "%s 在你的貼文留言.",
    'ossn:notifications:like:post' => "%s 對你的貼文按讚.",
    'ossn:notifications:like:annotation' => "%s 對你的留言按讚.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s 喜歡你的相片.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s 在你的相片留言.',
    'ossn:notifications:wall:friends:tag' => '%s 標記你在一則貼文.',
    'ossn:notification:are:friends' => '你們現在是好友了!',
    'ossn:notifications:comments:post:group:wall' => "%s 在你的群組貼文留言.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s 在你的大頭貼按了讚.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s 在你的大頭貼留言.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s 在你的封面照片按了讚.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s 在你的封面相片留言.",

    'ossn:notifications:like:post:group:wall' => '%s 在你的貼文按讚.',
	
    'ossn:notification:delete:friend' => '已刪除好友!',
    'notifications' => '通知',
    'see:all' => '檢視全部',
    'friend:requests' => '交友邀請',
    'ossn:notifications:friendrequest:confirmbutton' => '接受',
    'ossn:notifications:friendrequest:denybutton' => '拒絕',
	
    'ossn:notification:mark:read:success' => '已全部標記己讀',
    'ossn:notification:mark:read:error' => '無法標記全部己讀',
    
    'ossn:notifications:mark:as:read' => '全部標記已讀',
	'ossn:notifications:admin:settings:close_anywhere:title' => '點擊任意處關閉訊息視窗',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> 點擊畫面任一處關閉訊息視窗.<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s 评论了个人资料照片。",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s 评论了个人资料封面。",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s 对照片发表了评论。',		
	
	'ossn:notifications:admin:settings:checkintervals:title' => '通知自动检查时间（默认60秒）', 
);
ossn_register_languages('zh', $zh); 
