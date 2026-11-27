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
		'ossnaddressbook:menu'               => '주소록',
		'ossnaddressbook:title'              => '주소록',
		'ossnaddressbook:subtitle:contacts'  => '연락처',
		'ossnaddressbook:subtitle:favorites' => '즐겨찾기',
		'ossnaddressbook:search:placeholder' => '이름, 전화번호, 이메일 또는 회사로 연락처 검색...',
		'ossnaddressbook:add'                => '연락처 추가',
		'ossnaddressbook:add:toggle'         => '새 연락처',
		'ossnaddressbook:name:placeholder'   => '성명 *',
		'ossnaddressbook:phone:placeholder'  => '전화번호 / WhatsApp',
		'ossnaddressbook:email:placeholder'  => '이메일 주소',
		'ossnaddressbook:company:placeholder' => '회사 / 단체',
		'ossnaddressbook:address:placeholder' => '주소 / 도시',
		'ossnaddressbook:note:placeholder'   => '개인 메모 (선택 사항)...',
		'ossnaddressbook:category'           => '그룹',
		'ossnaddressbook:category:all'       => '전체',
		'ossnaddressbook:category:favorites' => '즐겨찾기',
		'ossnaddressbook:category:personal'  => '개인',
		'ossnaddressbook:category:work'      => '직장',
		'ossnaddressbook:category:family'    => '가족',
		'ossnaddressbook:category:other'     => '기타',
		'ossnaddressbook:favorite'           => '즐겨찾기',
		'ossnaddressbook:edit'               => '편집',
		'ossnaddressbook:save'               => '저장',
		'ossnaddressbook:cancel'             => '취소',
		'ossnaddressbook:delete'             => '삭제',
		'ossnaddressbook:delete:all'         => '모두 삭제',
		'ossnaddressbook:delete:all:confirm' => '모든 연락처를 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.',
		'ossnaddressbook:empty'              => '주소록이 비어 있습니다. 위에서 첫 번째 연락처를 추가하세요!',
		'ossnaddressbook:add:error'          => '연락처를 추가할 수 없습니다. 이름을 입력해 주세요.',
		'ossnaddressbook:edit:error'         => '연락처를 업데이트할 수 없습니다.',
		'ossnaddressbook:delete:error'       => '연락처를 삭제할 수 없습니다.',
		'ossnaddressbook:import'             => '가져오기',
		'ossnaddressbook:export:csv'         => 'CSV 내보내기',
		'ossnaddressbook:export:vcf'         => 'vCard 내보내기',
		'ossnaddressbook:import:success'     => '연락처 %s개를 성공적으로 가져왔습니다.',
		'ossnaddressbook:import:error'       => '가져올 CSV 또는 vCard(.vcf) 파일을 선택해 주세요.',
		'ossnaddressbook:import:invalid'     => '지원되지 않는 파일 형식입니다. .csv 및 .vcf 파일만 허용됩니다.',
		'ossnaddressbook:import:empty'       => '업로드한 파일에서 유효한 연락처를 찾을 수 없습니다.',
);
ossn_register_languages('ko', $ko);
