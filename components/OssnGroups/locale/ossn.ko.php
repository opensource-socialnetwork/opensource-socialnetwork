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
    'groups' => '동아리',
    'add:group' => '동아리 만들기',
    'requests' => '가입 신청',

    'members' => '회원들',
    'member:add:error' => '뭔가 이상합니다! 다시 해 보세요.',
    'member:added' => '가입 요청을 승인하였습니다!',

    'member:request:deleted' => '가입 요청을 거절하였습니다!',
    'member:request:delete:fail' => '가입 요청을 거절할 수 없습니다! 다시 해 보세요.',
    'membership:cancel:succes' => '가입 요청을 취소하였습니다!',
    'membership:cancel:fail' => '가입 요청을 취소할 수 없습니다! 다시 해 보세요.',

    'group:added' => '동아리를 만들었습니다!',
    'group:add:fail' => '동아리를 만들 수 없습니다! 다시 해 보세요.',

    'memebership:sent' => '요청을 보냈습니다!',
    'memebership:sent:fail' => '요청을 보낼 수 없습니다! 다시 해 보세요.',

    'group:updated' => '동아리를 단장하였습니다!',
    'group:update:fail' => '동아리를 단장할 수 없습니다! 다시 해 보세요.',

    'group:name' => '동아리 이름',
    'group:desc' => '동아리 설명',
    'privacy:group:public' => '누구나 이 동아리와 동아리의 글를 볼 수 있습니다. 다만 회원만 이 동아리에 글을 쓸 수 있습니다.',
    'privacy:group:close' => '누구나 이 동아리를 볼 수 있습니다. 다만 회원만이 글을 쓰고 또 글을 볼 수 있습니다.',

    'group:memb:remove' => '내보내기',
    'group:memb:make:owner' => '동아리 주인으로 만들기',
    'group:memb:make:owner:confirm' => '주의하세요! 이러시면  >> %s << 님이 동아리의 새 주인이 됩니다. 동아리 관리자 권한을 잃어도 괜찮으신가요? 진행하시겠습니까?',
    'group:memb:make:owner:admin:confirm' => '주의하세요! 이러시면 >> %s << 님이 동아리의 새 주인이 되고 전 주인은 동아리 관리 권한을 잃게 됩니다. 진행하시겠습니까?',
    'leave:group' => '동아리 떠나기',
    'join:group' => '동아리 들어가기',
    'total:members' => '전체 회원',
    'group:members' => "회원 (%s)",
    'view:all' => '모두 보기',
    'member:requests' => '가입 신청 (%s)',
    'about:group' => '동아리에 대해',
    'cancel:membership' => '동아리 그만두기',

    'no:requests' => '신청 없음',
    'approve' => '승인하기',
    'decline' => '거절하기',
    'search:groups' => '동아리 찾기',

    'close:group:notice' => '이 동아리의 글과 사진 그리고 댓글을 보시려면 가입하세요.',
    'closed:group' => '비밀 동아리',
    'group:admin' => '관리자',
	
	'title:access:private:group' => '동아리 글',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s 님이 %s 동아리에 가입신청하였습니다',
	'ossn:group:by' => '주인:',
	
	'group:deleted' => '동아리와 관련 일체를 삭제하였습니다',
	'group:delete:fail' => '동아리를 삭제할 수 없습니다',

	'group:delete:cover' => '커버 삭제하기',
	'group:delete:cover:error' => '커버 그림을 삭제하는 중에 오류가 발생하였습니다',
	'group:delete:cover:success' => '커버 그림을 삭제하였습니다',

);
ossn_register_languages('ko', $ko); 
