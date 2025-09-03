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

$ko = array(
	'ossnnotifications' => '알림',
    'ossn:notifications:comments:post' => "%s 님이 댓글을 달았습니다.",
    'ossn:notifications:like:post' => "%s 님이 글을 좋아합니다.",
    'ossn:notifications:like:annotation' => "%s 님이 댓글을 좋아합니다.",
    'ossn:notifications:like:entity:file:ossn:aphoto' => "%s 님이 사진을 좋아합니다.",
    'ossn:notifications:comments:entity:file:ossn:aphoto' => '%s 님이 사진에 댓글을 달았습니다.',
    'ossn:notifications:wall:friends:tag' => '%s 님이 글에 꼬리를 달았습니다.',
    'ossn:notification:are:friends' => '친구가 되었습니다!',
    'ossn:notifications:comments:post:group:wall' => "%s 님이 동아리 글에 댓글을 달았습니다.",
    'ossn:notifications:like:entity:file:profile:photo' => "%s 님이 인물 소개 사진을 좋아합니다.",
    'ossn:notifications:comments:entity:file:profile:photo' => "%s 님이 인물 소개 사진에 댓글을 달았습니다.",
    'ossn:notifications:like:entity:file:profile:cover' => "%s 님이 인물 소개 표지를 좋아합니다.",
    'ossn:notifications:comments:entity:file:profile:cover' => "%s 님이 인물 소개 표지에 댓글을 달았습니다.",

    'ossn:notifications:like:post:group:wall' => '%s 님이 글을 좋아합니다.',
	
    'ossn:notification:delete:friend' => '친구 요청을 삭제하였습니다!',
    'notifications' => '알림',
    'see:all' => '전부 보기',
    'friend:requests' => '친구 요청',
    'ossn:notifications:friendrequest:confirmbutton' => '수락',
    'ossn:notifications:friendrequest:denybutton' => '거절',
	
    'ossn:notification:mark:read:success' => '모두 읽음으로 표시 완료',
    'ossn:notification:mark:read:error' => '모두 읽음으로 표시할 수 없습니다',
    
    'ossn:notifications:mark:as:read' => '모두 읽음으로 표시',
	'ossn:notifications:admin:settings:close_anywhere:title' => '아무데나 눌러서 알림창 닫기',
	'ossn:notifications:admin:settings:close_anywhere:note' => '<i class="fa fa-info-circle"></i> 화면에 있는 어디를 누르든 어떤 알림 창이라도 닫음<br><br>',
	
	'ossn:notifications:comments:entity:file:profile:photo:someone' => "%s 님이 프로필 사진에 댓글을 달았습니다.",	
    'ossn:notifications:comments:entity:file:profile:cover:someone' => "%s 님이 프로필 표지에 댓글을 달았습니다.",	
	'ossn:notifications:comments:entity:file:ossn:aphoto:someone' => '%s 님이 사진에 댓글을 달았습니다.',		

	'ossn:notifications:admin:settings:checkintervals:title' => '알림 자동 확인 시간 (기본 60초)', 	
);
ossn_register_languages('ko', $ko); 
