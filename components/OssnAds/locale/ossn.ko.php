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
$ko = array(
	'ossnads'                       => '광고 관리자',
	'fields:required'               => '모든 필드를 입력해 주세요!',
	'ad:created'                    => '광고가 성공적으로 생성되었습니다!',
	'ad:create:fail'                => '광고를 생성할 수 없습니다!',
	'ad:title'                      => '제목',
	'ad:site:url'                   => '사이트 URL',
	'ad:desc'                       => '설명',
	'ad:browse'                     => '찾아보기',
	'ad:clicks'                     => '클릭 수',
	'sponsored'                     => '추천 광고',
	'ad:deleted'                    => "제목이 '%s'인 광고가 성공적으로 삭제되었습니다.",
	'ad:delete:fail'                => '광고를 삭제할 수 없습니다! 나중에 다시 시도해 주세요.',
	'ad:edited'                     => '광고가 성공적으로 수정되었습니다.',
	'ad:edit:fail'                  => '광고를 수정할 수 없습니다! 나중에 다시 시도해 주세요.',
	'ads:manager'                   => '광고 관리',
	'ads:boost:community'           => '커뮤니티를 활성화하세요. 새로운 광고 캠페인을 생성하거나 기존 캠페인을 관리할 수 있습니다.',
	'ads:create'                    => '광고 생성',

	'ad:placement'                  => '광고 노출 위치',
	'ad:gender:target'              => '인구통계학적 성별 타겟팅',
	'ad:end:date'                   => '캠페인 마감일 (선택 사항)',
	'ad:photo'                      => '배너 광고 이미지',
	'add'                           => '캠페인 생성',

	'ad:placement:newsfeed'         => '활동 뉴스피드 (사이드바)',
	'ad:placement:profile'          => '사용자 프로필 (사이드바)',
	'ad:placement:groups'           => '그룹 페이지 (사이드바)',
	'ad:placement:global'           => '기타 모든 테마 사이드바 (글로벌)',

	'ad:file:choose'                => '광고 이미지를 선택하거나 여기로 드래그하세요...',
	'ad:file:restriction'           => '이미지 파일만 업로드 가능합니다 (PNG, JPG, WebP)',
	'ad:file:remove'                => '이미지 제거',
	'ad:char:left'                  => '%s자 남음',
	'ad:status:expired'             => '만료됨',
	'ad:status:active'              => '활성',
	'ad:views'                      => '조회 수',
	'ad:status'                     => '상태',
	'ad:end:date:infinity'          => '제한 없음',

	//cron
	'ossn:adscron:title'            => '필수 설정: 광고 만료 자동화',
	'ossn:adscron:last:run'         => '최근 Cron 실행:',
	'ossn:adscron:never'            => '실행 기록 없음',
	'ossn:adscron:configure'        => '설정하기',
	'ossn:adscron:description'      => '광고 상태를 자동으로 %s 상태로 전환하려면, 매일 정오(오후 12:00)에 한 번 실행되도록 시스템 cron 작업을 설정해야 합니다.',
	'ossn:adscron:expired'          => '만료됨',
	'ossn:adscron:command:label'    => 'Crontab 명령어',
	'ossn:adscron:path:placeholder' => 'YOUR_SERVER_PHP_PATH',
	'ossn:adscron:warning:title'    => '중요 고지:',
	'ossn:adscron:warning:text'     => '광고가 만료되면 해당 광고는 %s. 광고주는 처음부터 새 광고를 생성해야 합니다.',
	'ossn:adscron:cannot:edit'      => '수정하거나 갱신할 수 없습니다',
);
ossn_register_languages('ko', $ko);