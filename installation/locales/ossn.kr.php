<?php
/**
 * Open Source Social Network
 *
 * @package   (openteknik.com).ossn
 * @author    OSSN Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Open Source Social Network License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */


$korean = array(
	'site:settings' => '사이트 설정',
	'ossn:installed' => '설치됨',
	'ossn:installation' => '설치',
	'ossn:check' => '유효',
	'ossn:installed' => '설치됨',
	'ossn:installed:message' => 'Open Source Social Network 를 설치하였습니다.',
    'ossn:prerequisites' => '설치 전 필요사항',
    'ossn:settings' => '서버 설정',
    'ossn:dbsettings' => '데이타베이스',
	'ossn:dbuser' => '데이타베이스 사용자',
	'ossn:dbpassword' => '데이타베이스 암호',
	'ossn:dbname' => '데이타베이스 이름',
	'ossn:dbhost' => '데이타베이스 호스트',
    'ossn:sitesettings' => '웹 사이트',
    'ossn:websitename' => '웹 사이트 이름',
    'ossn:mainsettings' => '경로',
	'ossn:weburl' => 'Ossn 사이트 Url',
	'installation:notes' => 'data 디렉토리는 사용자 파일을 포함하고 있습니다. data 디렉토리는 OSSN 설치 경로 밖에 존재해야 합니다.',
	'ossn:datadir' => 'Data 디렉토리',
	'owner_email' => '사이트 소유자 이메일',
	'notification_email' => '알림 이메일 (noreply@domain.com)',
	'create:admin:account' => '관리자 계정 만들기',
	'ossn:setting:account' => '계정 설정',
	
	'data:directory:invalid' => 'data 디렉토리가 유효하지 않거나 쓸 수 없는 상태입니다.',	
	'data:directory:outside' => 'Data 디렉토리는 설치 경로 밖에 위치해야 합니다.',
	'all:files:required' => '전체 파일이 다 필요합니다! 파일을 점검하세요.',
	
	'ossn:install:php' => 'PHP ',
	'ossn:install:old:php' => " PHP " . PHP_VERSION . " 은 예전 버전입니다.  PHP 7.0 이나 그 이상이 필요합니다.",
	
	'ossn:install:mysqli' => 'MYSQLI 켜짐',
	'ossn:install:mysqli:required' => 'MYSQLI PHP EXTENSION 필요함',
	
	'ossn:install:apache' => 'APACHE 켜짐',
	'ossn:install:apache:required' => 'APACHE 필요함',
	
	'ossn:install:modrewrite' => 'MOD_REWRITE',
	'ossn:install:modrewrite:required' => 'MOD_REWRITE 필요함',
	
	'ossn:install:curl' => 'PHP CURL',
	'ossn:install:curl:required' => 'PHP CURL 필요함',
	
	'ossn:install:gd' => 'PHP GD LIBRARY',
	'ossn:install:gd:required' => 'PHP GD LIBRARY 필요함',
	
	'ossn:install:config' => '쓰기 가능한 설정 디렉토리',
	'ossn:install:config:error' => 'CONFIGURATION DIRECTORY 를 쓸 수 없습니다',
	
	'ossn:install:next' => '다음',
    'ossn:install:install' => '설치',
    'ossn:install:create' => '만들기',
    'ossn:install:finish' => '완료',
	
	'fields:require' => '모든 항목이 다 필요합니다!',
	
	'ossn:install:allowfopenurl' => 'PHP allow_url_fopen 켜짐',
	'ossn:install:allowfopenurl:error' => 'PHP allow_url_fopen 필요함',
	
	'ossn:install:ziparchive' => 'PHP ZipArchive 켜짐',
	'ossn:install:ziparchive:error' => 'PHP ZipArchive EXTENSION 켜짐',
	'ossn:install:cachedir:note:failed' => '아파치 사용자가 파일과 디렉토리를 소유했는지 꼭 확인하세요.',
);

ossn_installation_register_languages($korean);
